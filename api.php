<?php

if (!isset($_GET['option']) || trim($_GET['option']) == "") {
    //Bad Request
    echo "bad request";
    exit;
}


$key = $_GET['option'];

$questions = [
    "stomack_and_intestine" => "Mage och tarm",
    "skin" => "Hud",
    "eyes" => "Ögon",
    "respiratory_tract" => "Luftvägar",
    "wound_injuries" => "Sårskador",
    "poisoning" => "Förgiftning",
    "bite" => "Bett",
    "oral_cavity" => "Munhåla",
    "urinary_tract" => "Urinvägar",
    "reproductive_system" => "Reproduktionsorgan",
    "childbirth_pregnancy_running" => "Förlossning, dräktighet, löp",
    "movement_apparatus" => "Rörelseapparat"
];

$subQuestions = [
    'movement_apparatus' => [
        [
            'name' => 'general_condition',
            'title' => 'Allmäntillstånd',
            'options' => [
                'good' => 'Gott',
                'worried' => 'Dämpad/orolig',
                'very_worried' => 'Ligger mest/mycket orolig',
                'screaming' => 'Piper/gnäller/skriker',
            ]
        ],
        [
            'name' => 'appetite',
            'title' => 'Aptit',
            'options' => [
                'yes' => 'Ja',
                'no' => 'Nej'
            ]
        ],
        [
            'name' => 'clear_lameness',
            'title' => 'Tydlig hälta',
            'options' => [
                'no' => 'Nej',
                'yes' => 'Ja',
            ]
        ],
        [
            'name' => 'poop_pee',
            'title' => 'Bajsar/kissar',
            'options' => [
                'Yes_no_problem' => 'Ja-utan problem',
                'Yes_with_some_difficulty' => 'Ja-med viss svårighet',
                'No_wants_can_not_go_out_for_a_break' => 'Nej-vill/kan inte gå ut för rastning',
            ]
        ],
        [
            'name' => 'swelling',
            'title' => 'Svullnad',
            'options' => [
                'no' => 'Nej',
                'yes' => 'Ja',
            ]
        ],
        [
            'name' => 'fever',
            'title' => 'Feber',
            'options' => [
                'no' => 'Nej',
                'yes' => 'Ja',
            ]
        ],
    ]

];


$num = 7;
$htmlOutput = '';
$isFirst = true;
if (isset($subQuestions[$key])) {

    foreach ($subQuestions[$key] as $question) {
        $name = $question['name'];
        $title = $question['title'];
        $nextNum = $num + 1;
        $display = !$isFirst ? 'style = "display: none"' : '';
        $isFirst = false;

        $options = $question['options'];

        $text = <<<HTML
            
            <div id="question_{$num}" {$display}>
                <label for="question_{$num}_select" class="form-label" >{$title}</label>
                <select id="question_{$num}_select"
                    name="{$name}"
                    class="form-select form-select-lg mb-3 question question_{$num} "
                    aria-label=".form-select-lg example"
                    data-next="{$nextNum}">
                <option ></option>
HTML;

        foreach ($options as $key => $option) {
            $text .= <<<HTML
                <option value="{$key}" >{$option}</option>

HTML;
        }


        $text .= <<<HTML
            </select>
    </div>
HTML;

        $htmlOutput .= $text;
        $num++;
    }
}

echo $htmlOutput;
exit;
