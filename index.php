<?php

if (isset($_GET['debug'])) {
    session_start();
    $_SESSION['debug'] = 1;
} else {
    $_SESSION['debug']=0;
    session_abort();
}


?><html>

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
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-8">-->
<!--            <form action="/save.php" method="POST">-->
<!--                <div id="question_list" style="">-->
<!---->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--        <div class="col-4">-->
<!--            <form action="/saveNumber.php" method="POST">-->
<!--                <div>-->
<!--                    <label for="number">Number:</label>-->
<!--                    <input id="number" type="number" placeholder="Type number here" name="number" required>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <input type="submit">-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="container">-->
<!--    <div class="mb-3">-->
<!--        -->
<!--    </div>-->
<!--</div>-->




<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="images/logo.jpg" alt="" width="175">
        <h2>2288 support page</h2>
        <p class="lead">Below you can find support functionalities for 2288.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">NEW space</span>
            </h4>
<!--            <ul class="list-group mb-3">-->
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">-->
<!--                    <div>-->
<!--                        <h6 class="my-0">Product name</h6>-->
<!--                        <small class="text-muted">Brief description</small>-->
<!--                    </div>-->
<!--                    <span class="text-muted">$12</span>-->
<!--                </li>-->
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">-->
<!--                    <div>-->
<!--                        <h6 class="my-0">Second product</h6>-->
<!--                        <small class="text-muted">Brief description</small>-->
<!--                    </div>-->
<!--                    <span class="text-muted">$8</span>-->
<!--                </li>-->
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">-->
<!--                    <div>-->
<!--                        <h6 class="my-0">Third item</h6>-->
<!--                        <small class="text-muted">Brief description</small>-->
<!--                    </div>-->
<!--                    <span class="text-muted">$5</span>-->
<!--                </li>-->
<!--                <li class="list-group-item d-flex justify-content-between bg-light">-->
<!--                    <div class="text-success">-->
<!--                        <h6 class="my-0">Promo code</h6>-->
<!--                        <small>EXAMPLECODE</small>-->
<!--                    </div>-->
<!--                    <span class="text-success">-$5</span>-->
<!--                </li>-->
<!--                <li class="list-group-item d-flex justify-content-between">-->
<!--                    <span>Total (USD)</span>-->
<!--                    <strong>$20</strong>-->
<!--                </li>-->
<!--            </ul>-->

            <form action="/saveNumber.php" method="POST" class="card p-2">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Number">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Question list</h4>
            <form action="/save.php" method="POST">
                <div id="question_list" style="">

                </div>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2288</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
</body>

</html>
