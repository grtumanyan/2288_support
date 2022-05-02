<?php
//Show all type errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/pointsCountingService.php";

$host = '127.0.0.1';
$db = 'support';


$user = 'support_user';



$password = '1mRp+yAy0#$%';


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

//debug(__LINE__);
function debug($line, $message = '', $res = [])
{
    if (isset($_SESSION['debug']) && $_SESSION['debug'] == 1) {

        echo $line . ' ' . $message . '<br>';

        if (!empty($res)) {
            var_dump($res);
        }
    }
}

function getByParentIdAnswerNumberLevel(?int $parentId = null, string $answer, int $number, int $level)
{
    global $dsn, $user, $password;
    $pdo = new PDO($dsn, $user, $password);

//    if (!$parentId || trim($parentId) == '') {
//        $parentId = null;
//    }

    if ($pdo) {
        $query = "SELECT * FROM questions WHERE " . (is_null($parentId) ? 'parent_id is NULL ' : "parent_id='$parentId'") . "
                          AND number='$number' AND level='$level'
                          AND parent_answer='$answer'";
        debug(__LINE__, $query);

        $stmt = $pdo->query($query);
        return $stmt->fetchObject();
    }
    return false;
}

function getByQuestionId(int $id)
{
    global $dsn, $user, $password;
    $pdo = new PDO($dsn, $user, $password);
    $currentQuery = "SELECT * FROM questions WHERE id='$id'";
    if ($pdo) {
        $stmt = $pdo->query($currentQuery);
        $currentQuestion = $stmt->fetchObject();
        return $currentQuestion;
    }
    return false;
}

try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {

        $currentQuery = "SELECT * FROM questions WHERE id='$questionId'";
        $stmt = $pdo->query($currentQuery);
        $currentQuestion = $stmt->fetchObject();

        $parentQuery = "SELECT * FROM questions WHERE id='$currentQuestion->parent_id'";
        $stmt = $pdo->query($parentQuery);
        $parentQuestion = $stmt->fetchObject();

        if($parentQuestion){
            if(isset($_SESSION["ticket_djurslag"])) {
                $points = countPoints($currentQuestion->question, $option, $_SESSION["ticket_djurslag"]);

                if(!isset($_SESSION["ticket_points"])) {
                    $_SESSION["ticket_points"] = 0;
                }
                $_SESSION["ticket_points"] = $_SESSION["ticket_points"] + $points;
                if($option = 'KattTrubbNos'){
                    var_dump($_SESSION["ticket_points"]);exit;
                }
            }
        }elseif($option){
            $_SESSION["ticket_djurslag"] = $option;
        }

        if (is_null($option)) {
            $query = "SELECT * FROM questions WHERE level='$level' AND number='$number'";
            $stmt = $pdo->query($query);
            $res = $stmt->fetchObject();

            debug(__LINE__, $query);

        } else {

            $query = "SELECT * FROM questions WHERE parent_id='$questionId' AND parent_answer='$option' AND number=1";

            $stmt = $pdo->query($query);
            $res = $stmt->fetchObject();
            debug(__LINE__, $query, $res);

            if (!$res) {

                $num = $currentQuestion->number + 1;
                $level = $currentQuestion->level;

                debug(__LINE__);

                $currentId = $currentQuestion->id;
                $res = getByParentIdAnswerNumberLevel($currentQuestion->parent_id, $currentQuestion->parent_answer, $num, $level);

                if (!$res) {
                    while ($level > 0 && !is_null($currentQuestion->parent_id)) {

                        $currentQuestion = getByQuestionId($currentId);
                        $parentQuestion = getByQuestionId($currentQuestion->parent_id);
                        $currentId = $parentQuestion->id;
                        $num = $parentQuestion->number + 1;
                        $level = $parentQuestion->level;
                        $answer = $parentQuestion->parent_answer;

                        $res = getByParentIdAnswerNumberLevel($parentQuestion->parent_id, $answer, $num, $level);

                        if (!$res) {
                            debug(__LINE__);
                            $level--;
                        } else {
                            break;
                        }

                    }
                }


            }

        }
        if ($res) {

            debug(__LINE__, ' ', $res->options);
            $options = str_replace('{', '[', $res->options);
            $options = str_replace('}', ']', $options);
            $options = json_decode($options);

            $text = <<<HTML

            <div>
                <label for="{$res->question}" class="form-label">{$res->question}</label>
                <select
                    name="{$res->question}"
                    class="form-select form-select-sm mb-3 question"
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
        }
//        else {
//            $text = '  <div><button type="submit">Save</button></div>';
//        }

        echo $text;
        exit;

//        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($res);
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
