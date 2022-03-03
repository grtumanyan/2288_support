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
        });


    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-8">
            <form action="/save.php" method="POST">
                <div id="question_list" style="">

                </div>
            </form>
        </div>
        <div class="col-4">
            <form action="/saveNumber.php" method="POST">
                <div>
                    <label for="number">Number:</label>
                    <input id="number" type="number" placeholder="Type number here" name="number" required>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<!--<div class="container">-->
<!--    <div class="mb-3">-->
<!--        -->
<!--    </div>-->
<!--</div>-->
</body>

</html>



