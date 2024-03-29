<?php
//Show all type errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/visionFlowService.php";

//if (isset($_GET['debug'])) {
//    session_start();
//    $_SESSION['debug'] = 1;
//} else {
//    $_SESSION['debug']=0;
//    session_abort();
//}

session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//Standard answers code part
$host = 'localhost';
$db = 'support';
$user = 'support';
$password = 'password';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);
if ($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM standard");
    $stmt->execute();
    $standard = $stmt->fetch();
}
$standard = explode(',', $standard['data']);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // CODE PART FOR TICKET
    if (isset($_POST["ticket"])) {
        if (empty(trim($_POST["ticket"]))) {
            $ticket_err = "Please enter ticket number.";
        }
        $ticket = trim($_POST["ticket"]);
        if (empty($ticket_err)) {
            try {
                $client = login();
                $result = findProjectIssues($client, $ticket);
                $result = json_decode(json_encode($result), true);
                if (empty($result)){
                    $_SESSION["ticket_error"] = true;
                } else {
                    $_SESSION["ticket_primaryKey"] = $result['return']['primaryKey'];
                    $_SESSION["ticket_data"] = $result;
                    $_SESSION["ticket"] = $ticket;
                    $_SESSION["ticket_error"] = false;
                }
            } catch (Exception $ex) {
                //Log Exception
                var_dump($ex->getMessage());
            }
        }
    }

    // CODE PART FOR TICKET REBOOT
    if (isset($_POST["rebootTicket"])) {
        try {
            unset ($_SESSION["ticket"]);
            unset ($_SESSION["ticket_data"]);
            unset ($_SESSION["ticket_error"]);
            unset ($_SESSION["ticket_points"]);
        } catch (Exception $ex) {
            //Log Exception
            var_dump($ex->getMessage());
        }
    }
}


?>

<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script type="text/javascript">
        // var url = '/apiv1.php';
        var url = '/apiv2.php';
        $(document).ready(function () {
            $.get(url, function (res) {
                console.log(res);
                $("#question_list").append(res);
            });

            $("#btnNumberArea").click(function () {
                $("#numberArea").toggle();
                $("#btnNumberArea").hide();
            });
        });

        $(document).on("change", "select.question", function () {
            $(this).css('pointer-events','none');
            $(this).css('font-weight','bold');
            var selected_value = $(this).children("option:selected").val();
            var question_id = $(this).data('question');

            $(this).parent('div').nextAll('div').remove();

            $.get(url + '?option=' + selected_value + '&question_id=' + question_id, function (res) {
                console.log(res);
                $("#question_list").append(res);
                var pointsCurrent = res.substr(res.indexOf("data-point=") + 12, 2);
                if ( (pointsCurrent+"").match(/^\d+$/) ) {
                    var currentValue = $('#points').text();
                    var latest = parseInt(currentValue) + parseInt(pointsCurrent);
                    $('#points').text(latest);
                    if (latest <= 50) {
                        var text = 'Går bra att avvakta hemma, Rådgivning från 2288';
                    }else if (latest > 50 && latest <= 200){
                        var text = 'Kontakta Firstvet';
                    } else if (latest > 200) {
                        var text = 'Åk till klinik';
                    }
                    $('#besluts').text(text);
                }
            });

            $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
        });



    </script>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?= $_SESSION["username"]; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="standard.php">Standard questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search">
        </form>
    </div>
</nav>
<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="images/logo.jpg" alt="" width="175">
        <h2>2288 support page</h2>
        <p class="lead">Below you can find support functionalities for 2288.</p>
    </div>

    <div class="row">
        <div class="col-md-6 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between text-center mb-3">
                <span class="text-muted">Beslutsstödets svar</span>
            </h4>
            <p id='besluts' class="lead"></p>
            <p id='points' class="mb-4 lead" hidden>0</p>
        </div>
        <div class="col-md-6 order-md-1 text-center">
            <?php if (isset($_SESSION["ticket_points"])) { ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mb-4">
                    <input type="hidden" class="form-control" name="rebootTicket">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Want to delete old ticket number and input new one? Click here.</button>
                    </div>
                </form>
                <h4 class="mb-4 lead">Ticket Number: ID-<?= $_SESSION["ticket"]; ?></h4>
                <hr>
            <?php } else { ?>
                <?php if (!isset($_SESSION["ticket"])) { ?>
                <button type="button" id="btnNumberArea" class="btn btn-primary btn-rounded mb-4">Starta nytt beslutsstöd</button>
                <div id="numberArea" style="display:none">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mb-4">
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Number" name="ticket">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Spara</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    if(!empty($_SESSION["ticket_error"])){
                        echo '<div class="alert alert-danger">Ticket number does not exist in Visionflow</div>';
                    }
                } else { ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mb-4">
                        <input type="hidden" class="form-control" name="rebootTicket">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Want to delete old ticket number and input new one? Click here.</button>
                        </div>
                    </form>
                    <h4 class="mb-4 lead">Ticket Number: <?= $_SESSION["ticket"]; ?></h4>
                    <hr>
                    <form action="/save.php" method="POST" class="mb-4">
                        <div id="question_list" style="">

                        </div>
                        <div><button type="submit">Save</button></div>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <div class="sticky-bottom">
        <h4 class="d-flex justify-content-between text-center mb-3">
            <span class="text-muted">Standard questions</span>
        </h4>
        <ul class="list-group list-group-flush">
            <?php foreach($standard as $one){
                echo '<li class="list-group-item">' .$one. '</li>';
            } ?>
        </ul>
    </div>
    <br>
    <br>
</div>
</body>

</html>
