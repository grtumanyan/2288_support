<?php

$host = 'support_db';
$db = 'support';
$user = 'support';
$password = 'password';


$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";


//if (!isset($_GET['option']) || trim($_GET['option']) == "") {
//    //Bad Request
//    echo "bad request";
//    exit;
//}


$number = $_GET['number'] ?? 1;
$option = $_GET['option'] ?? null;
$level = $_GET['level'] ?? 1;
$questionId = $_GET['question_id'] ?? null;


try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {

        $currentQuery = "SELECT * FROM questions WHERE id='$questionId'";
        $stmt = $pdo->query($currentQuery);
        $currentQuestion = $stmt->fetchObject();

        $parentQuery = "SELECT * FROM questions WHERE id='$currentQuestion->parent_id'";
        $stmt = $pdo->query($parentQuery);
        $parentQuestion = $stmt->fetchObject();

        if (is_null($option)) {
            $query = "SELECT * FROM questions WHERE level='$level' AND number='$number'";
            $stmt = $pdo->query($query);
            $res = $stmt->fetchObject();
        } else {
            $query = "SELECT * FROM questions WHERE parent_id='$questionId' AND parent_answer='$option' AND number=1";

            $stmt = $pdo->query($query);
            $res = $stmt->fetchObject();

            if (!$res) {

                $num = $currentQuestion->number + 1;
                $level = $currentQuestion->level;

                $query = "SELECT * FROM questions WHERE parent_id='$currentQuestion->parent_id' 
                          AND number='$num' AND level='$level' 
                          AND parent_answer='$currentQuestion->parent_answer'";

                $stmt = $pdo->query($query);
                $res = $stmt->fetchObject();

                if (!$res) {
                    $num = $parentQuestion->number + 1;

                    $pparentQuery = "SELECT * FROM questions WHERE id='$parentQuestion->parent_id'";
                    $stmt = $pdo->query($pparentQuery);
                    $pparentQuestion = $stmt->fetchObject();


                    $level = $level - 1;
                    if ($level == 0) {
                        $level = 1;
                        $num = $currentQuestion->number + 1;
                    } elseif ($currentQuestion->level == 3) {
                        $level = 1;
                        $num = $pparentQuestion->number + 1;
                    }


                    $query = "SELECT * FROM questions WHERE number='$num' AND level='$level'";

                    $stmt = $pdo->query($query);
                    $res = $stmt->fetchObject();

                    if (!$res) {
                        $num = $pparentQuestion->number + 1;
                        $level = $pparentQuestion->level;
                        $query = "SELECT * FROM questions WHERE number='$num' AND level='$level' ";
                        $stmt = $pdo->query($query);
                        $res = $stmt->fetchObject();
                        if (!$res) {
                            $res = 'finish';
                        }
                    }

                }
            }
        }

        if ($res != 'finish') {
            $options = str_replace('{', '[', $res->options);
            $options = str_replace('}', ']', $options);
            $options = json_decode($options);

            $text = <<<HTML
            
            <div>
                <label for="question_select" class="form-label" >{$res->question}</label>
                <select
                    name=""
                    class="form-select form-select-lg mb-3 question"
                    aria-label=".form-select-lg example"
                    data-question="{$res->id}">
                <option ></option>
HTML;

            foreach ($options as $option) {
                $text .= <<<HTML
                <option value="{$option}" >{$option}</option>

HTML;
            }


            $text .= <<<HTML
            </select>
    </div>
HTML;
        } else {
            $text = '  <div><button type="submit">Save</button></div>';
        }

        echo $text;
        exit;

//        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($res);
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
