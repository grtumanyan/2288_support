<?php
//Show all type errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/visionFlowService.php";

//TODO: Return to this integration when we will have correct creds
try {
    $result = findProjectIssues();
} catch (Exception $e) {
    var_dump($e->getMessage());
    exit;
}
var_dump($result);exit;

if (isset($_GET['debug'])) {
    session_start();
    $_SESSION['debug'] = 1;
} else {
    $_SESSION['debug']=0;
    session_abort();
}

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
        $ticket = 'ID-' . $ticket;

        if (empty($ticket_err)) {
            try {
                // Store data in session variables
                $_SESSION["ticket"] = $ticket;
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
            });
            $(document).scrollTop($(document).height());
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

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between text-center mb-3">
                <span class="text-muted">Standard questions</span>
            </h4>
            <p class="lead">Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in classical literature,
                "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
        </div>
        <div class="col-md-8 order-md-1 text-center">
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

            <?php } else { ?>
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
                </form>
            <?php } ?>

        </div>
    </div>
</div>
</body>

</html>
