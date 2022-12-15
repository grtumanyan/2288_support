<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/pointsCountingService.php";

// DB values
$host = 'localhost';
$db = 'support';
$dbuser = 'support';
$dbpassword = 'password';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

$pointsData =
    ['Hund' =>
        [
            'Ras Hund' => [
                "HundTrubbNos" => 10
            ],
            'Ras Katt' => [
                "KattTrubbNos" => 10
            ],
            'Ålder' => [
                "Valp/kattunge (0-6mån)" => 50,
                "6 mån-2 år" => 10,
                "över 6 år" => 10,
            ],
            'Vikt' => [
                "0,5-2 kg" => 50,
                "2-4 kg" => 40, //HUND
                "över 40 kg" => 10,
            ],
            'Allmäntillstånd' => [
                "Dämpad/orolig" => 10,
                "Ligger mest/mycket orolig" => 40,
                "Piper/gnäller/skriker" => 50,
            ],
            'Bajsar/kissar' => [
                "Ja-med viss svårighet" => 40,
                "Nej-vill/kan inte gå ut för rastning" => 50,
            ],
            'Aptit' => [
                "Nej" => 10,
            ],
            'Tydlig hälta' => [
                "Ja" => 50,
            ],
            'Svullnad' => [
                "Ja" => 20,
            ],
            'Feber' => [
                "Ja" => 50,
            ],
            'Allmäntillstånd ' => [
                "Lite trött" => 10,
                "Mycket trött" => 40,
            ],
            'Dygn i dräktigheten' => [
                "<60" => 30,
                ">70" => 30,
            ],
            'Historik av dystoki' => [
                "Ja-behandlad medicinskt" => 20,
                "Ja-snittad" => 40,
            ],
            'Har det gjorts bilddiagnostik' => [
                "Nej" => 10,
                "Ja-ultraljud" => 5,
            ],
            'Tempsänkning' => [
                "Ja" => 10,
            ],
            'Vattenavgång' => [
                "Ja" => 10,
            ],
            'Tid sedan vattenavgång' => [
                "30 min-1,5h sedan" => 30,
                "2-3h sedan" => 50,
            ],
            'Värkar' => [
                "Ja" => 30,
            ],
            'Intensitet' => [
                "Inte så kraftiga" => 20,
                "Mycket kraftiga" => 50,
            ],
            'Hur länge' => [
                "Börjat nyss" => 10,
                "Mer än 30 min" => 50,
                "1-4 h" => 100,
            ],
            'Var bor ni i förhållande till lämplig klinik' => [
                "30min-1h till klinik" => 20,
                "1-2h till klinik" => 30,
                ">2h till klinik" => 40,
            ],
            'Har det kommit några ungar' => [
                "Ja" => 10,
                "Nej" => 30,
            ],
            'Levande' => [
                "Några levande och några döda/mycket svaga" => 30,
                "Nej" => 10,
            ],
            'När kom senaste ungen' => [
                "1-2h sedan" => 40, //HUND
                ">2h sedan" => 50, //HUND
            ],
            'Syns fosterblåsa/foster' => [
                "Ja" => 30,
            ],
            'Flytning' => [
                "Ja" => 10,
            ],
            'Färg' => [
                "Brunröd" => 10,
                "Grön" => 100,
            ],
            'Tid förlupen sedan start på förlossning' => [
                "0-6h" => 20,//HUND
                "6-12h" => 50,//HUND
                "12-18h" => 100,//HUND
                "24h eller mer" => 100,//HUND
            ],
        ],
    'Katt' =>
            [
                'Ras Hund' => [
                    "HundTrubbNos" => 10
                ],
                'Ras Katt' => [
                    "KattTrubbNos" => 10
                ],
                'Ålder' => [
                    "Valp/kattunge (0-6mån)" => 50,
                    "6 mån-2 år" => 10,
                    "över 6 år" => 10,
                ],
                'Vikt' => [
                    "0,5-2 kg" => 50,
                    "över 40 kg" => 10,
                ],
                'Allmäntillstånd' => [
                    "Dämpad/orolig" => 10,
                    "Ligger mest/mycket orolig" => 40,
                    "Piper/gnäller/skriker" => 50,
                ],
                'Bajsar/kissar' => [
                    "Ja-med viss svårighet" => 40,
                    "Nej-vill/kan inte gå ut för rastning" => 50,
                ],
                'Aptit' => [
                    "Nej" => 10,
                ],
                'Tydlig hälta' => [
                    "Ja" => 50,
                ],
                'Svullnad' => [
                    "Ja" => 20,
                ],
                'Feber' => [
                    "Ja" => 50,
                ],
                'Allmäntillstånd ' => [
                    "Lite trött" => 10,
                    "Mycket trött" => 40,
                ],
                'Dygn i dräktigheten' => [
                    "<60" => 30,
                    ">70" => 30,
                ],
                'Historik av dystoki' => [
                    "Ja-behandlad medicinskt" => 20,
                    "Ja-snittad" => 40,
                ],
                'Har det gjorts bilddiagnostik' => [
                    "Nej" => 10,
                    "Ja-ultraljud" => 5,
                ],
                'Tempsänkning' => [
                    "Ja" => 10,
                ],
                'Vattenavgång' => [
                    "Ja" => 10,
                ],
                'Tid sedan vattenavgång' => [
                    "30 min-1,5h sedan" => 30,
                    "2-3h sedan" => 50,
                ],
                'Värkar' => [
                    "Ja" => 30,
                ],
                'Intensitet' => [
                    "Inte så kraftiga" => 20,
                    "Mycket kraftiga" => 50,
                ],
                'Hur länge' => [
                    "Börjat nyss" => 10,
                    "Mer än 30 min" => 50,
                    "1-4 h" => 100,
                ],
                'Var bor ni i förhållande till lämplig klinik' => [
                    "30min-1h till klinik" => 20,
                    "1-2h till klinik" => 30,
                    ">2h till klinik" => 40,
                ],
                'Har det kommit några ungar' => [
                    "Ja" => 10,
                    "Nej" => 30,
                ],
                'Levande' => [
                    "Några levande och några döda/mycket svaga" => 30,
                    "Nej" => 10,
                ],
                'Syns fosterblåsa/foster' => [
                    "Ja" => 30,
                ],
                'Flytning' => [
                    "Ja" => 10,
                ],
                'Färg' => [
                    "Brunröd" => 10,
                    "Grön" => 100,
                ],
                'Tid förlupen sedan start på förlossning' => [
                    "12-18h" => 20,//KATT
                    "24h eller mer" => 50,//KATT
                ],
            ]
    ];

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

        if($currentQuestion->question == 'Djurslag'){
            $_SESSION["ticket_djurslag"] = $option;
            session_write_close();
        }

        $points = $pointsData[$_SESSION["ticket_djurslag"]][$currentQuestion->question][$option];

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
                    data-question="{$res->id}"
                    data-point="{$points}">
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


