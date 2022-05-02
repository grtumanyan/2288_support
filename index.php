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
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
          crossorigin="anonymous">

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

            var selected_value = $(this).children("option:selected").val();
            var question_id = $(this).data('question');

            $(this).parent('div').nextAll('div').remove();

            $.get(url + '?option=' + selected_value + '&question_id=' + question_id, function (res) {
                console.log(res);
                $("#question_list").append(res);
                <?php if (isset($_SESSION["ticket_points"])) {var_dump($_SESSION["ticket_points"]);} ?>
                // $('#points').text(points);
            });

            $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
        });



    </script>
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?= $_SESSION["username"]; ?></a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="images/logo.jpg" alt="" width="175">
        <h2>2288 support page</h2>
        <p class="lead">Below you can find support functionalities for 2288.</p>
    </div>

    <p id='points' class="mb-4 lead">0</p>
    <div class="row">
        <div class="col-md-6 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between text-center mb-3">
                <span class="text-muted">Beslutsstödets svar</span>
            </h4>
            <?php if (isset($_SESSION["ticket_points"])) { ?>
                <?php if ($_SESSION["ticket_points"] < 50) { ?>
                    <p class="lead">Går bra att avvakta hemma, Rådgivning från 2288</p>
                <?php } elseif ($_SESSION["ticket_points"] >= 50 && $_SESSION["ticket_points"] <= 200) { ?>
                    <p class="lead">Kontakta Firstvet</p>
                <?php } elseif ($_SESSION["ticket_points"] > 200) { ?>
                    <p class="lead">Åk till klinik</p>
                <?php } ?>
            <?php } ?>
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
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
    <br>
    <br>
</div>
</body>

</html>
