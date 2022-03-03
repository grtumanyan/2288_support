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
        var url = '/api.php';
        $(document).ready(function () {
            $("#animal_type").change(function () {
                var animal_type = $(this).children("option:selected").val();

                $(".question_2").parent().hide();
                $("#" + animal_type + "_case").show();
            });

            // $("#problem_area_options").bind("click", function (event) {
            //     var next_num = $(this).data('next');
            //
            //     console.log($(this).html(), event, event.target, event.target.options);
            //
            //
            //     $(this).next(".question").parent().hide();
            //     $(this).next(".opt-question").parent().hide();
            //
            //     $(".question_" + next_num).parent().show();
            //
            // });

            $(document).on("change", "select.question" , function() {
                // alert("sadasd");
                // // $(this).parent().remove();

                var next_num = $(this).data('next');

                if (next_num != -1) {
                    $(this).next(".question").parent().hide();
                    $(this).next(".opt-question").parent().hide();

                    $(".question_" + next_num).parent().show();
                } else {
                    var selected_val = $(this).children("option:selected").val();

                    $.get(url + '?option=' + selected_val, function (res) {
                        $("#problem_area_options").html(res);
                    });
                }

            });
            });

            $(".question").on('change', function () {


        });


    </script>
</head>
<body>

<div class="container">
    <div class="mb-3">
        <label for="animal_type" class="form-label">Djurslag</label>
        <select id="animal_type"
                name="animal_type"
                class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option></option>
            <option value="dog">Hund</option>
            <option value="cat">Katt</option>
        </select>

        <div id="dog_case" style="display: none">
            <label for="dog_case_select" class="form-label">Ras Hund</label>
            <select id="dog_case_select"
                    name="ras_dog"
                    class="form-select form-select-lg mb-3 question_2 question" data-next="3"
                    aria-label=".form-select-lg example">
                <option></option>
                <option value="dog">Hund</option>
                <option value="cat">Katt</option>
            </select>
        </div>

        <div id="cat_case" style="display: none">
            <label for="cat_case_select" class="form-label">Ras Katt</label>
            <select id="cat_case_select"
                    name="ras_cat"
                    class="form-select form-select-lg mb-3 question_2 question" data-next="3"
                    aria-label=".form-select-lg example">
                <option></option>
                <option value="dog">Hund</option>
                <option value="cat">Katt</option>
            </select>
        </div>

        <div id="question_3" style="display: none">
            <label for="question_3_select" class="form-label">Ålder</label>
            <select id="question_3_select"
                    name="age"
                    class="form-select form-select-lg mb-3 question question_3 "
                    aria-label=".form-select-lg example"
                    data-next="4">
                <option></option>
                <option value="dog">Valp (0-6mån)</option>
                <option value="cat">6 mån-2 år</option>
                <option value="cat">2-6 år</option>
                <option value="cat">över 6 år</option>
            </select>
        </div>

        <div id="question_4" style="display: none">
            <label for="question_4_select" class="form-label">Kön</label>
            <select id="question_4_select"
                    name="sex"
                    class="form-select form-select-lg mb-3 question question_4 "
                    aria-label=".form-select-lg example"
                    data-next="5">
                <option></option>
                <option value="dog">Hane</option>
                <option value="cat">Hane kastrerad</option>
                <option value="cat">Tik</option>
                <option value="cat">Tik steriliserad</option>
            </select>
        </div>
        <div id="question_5" style="display: none">
            <label for="question_5_select" class="form-label">Vikt</label>
            <select id="question_5_select"
                    name="weight"
                    class="form-select form-select-lg mb-3 question question_5 "
                    aria-label=".form-select-lg example"
                    data-next="6">
                <option></option>
                <option value="dog">Hane</option>
                <option value="cat">Hane kastrerad</option>
                <option value="cat">Tik</option>
                <option value="cat">Tik steriliserad</option>
            </select>
        </div>

        <div id="question_6" style="display: none">
            <label for="question_6_select" class="form-label">Problemområde</label>
            <select id="question_6_select"
                    name="problem_area"
                    class="form-select form-select-lg mb-3 question question_6 "
                    aria-label=".form-select-lg example"
                    data-next="-1">
                <option></option>
                <option value="stomack_and_intestine">Mage och tarm</option>
                <option value="skin">Hud</option>
                <option value="eyes">Ögon</option>
                <option value="respiratory_tract">Luftvägar</option>
                <option value="wound_injuries">Sårskador</option>
                <option value="poisoning">Förgiftning</option>
                <option value="bite">Bett</option>
                <option value="oral_cavity">Munhåla</option>
                <option value="urinary_tract">Urinvägar</option>
                <option value="reproductive_system">Reproduktionsorgan</option>
                <option value="childbirth_pregnancy_running">Förlossning, dräktighet, löp</option>
                <option value="movement_apparatus">Rörelseapparat</option>
            </select>
        </div>
        <div id="problem_area_options" style="/*display: none */">
        </div>

    </div>
</div>
</body>

</html>