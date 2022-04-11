<?php
function countPoints($data) {
    $points =
        ['Hund' =>
            [
                'Ras Hund'  => [
                    "HundTrubbNos" => 10
                ],
                'Ras Katt'  => [
                    "KattTrubbNos" => 10
                ],
                'Ålder'  => [
                    "Valp/kattunge (0-6mån)" => 50,
                    "6 mån-2 år" => 10,
                    "över 6 år" => 10,
                ],
                'Vikt'  => [
                    "0,5-2 kg" => 50,
                    "2-4 kg" => 40, //HUND
                    "över 40 kg" => 10,
                ],
                'Allmäntillstånd'  => [
                    "Dämpad/orolig" => 10,
                    "Ligger mest/mycket orolig" => 40,
                    "Piper/gnäller/skriker" => 50,
                ],
                'Bajsar/kissar'  => [
                    "Ja-med viss svårighet" => 40,
                    "Nej-vill/kan inte gå ut för rastning" => 50,
                ],
                'Aptit'  => [
                    "Nej" => 10,
                ],
                'Tydlig hälta'  => [
                    "Ja" => 50,
                ],
                'Svullnad'  => [
                    "Ja" => 20,
                ],
                'Feber'  => [
                    "Ja" => 50,
                ],
                'Allmäntillstånd '  => [
                    "Lite trött" => 10,
                    "Mycket trött" => 40,
                ],
                'Dygn i dräktigheten'  => [
                    "<60" => 30,
                    ">70" => 30,
                ],
                'Historik av dystoki'  => [
                    "Ja-behandlad medicinskt" => 20,
                    "Ja-snittad" => 40,
                ],
                'Har det gjorts bilddiagnostik'  => [
                    "Nej" => 10,
                    "Ja-ultraljud" => 5,
                ],
                'Tempsänkning'  => [
                    "Ja" => 10,
                ],
                'Vattenavgång'  => [
                    "Ja" => 10,
                ],
                'Tid sedan vattenavgång'  => [
                    "30 min-1,5h sedan" => 30,
                    "2-3h sedan" => 50,
                ],
                'Värkar'  => [
                    "Ja" => 30,
                ],
                'Intensitet'  => [
                    "Inte så kraftiga" => 20,
                    "Mycket kraftiga" => 50,
                ],
                'Hur länge'  => [
                    "Börjat nyss" => 10,
                    "Mer än 30 min" => 50,
                    "1-4 h" => 100,
                ],
                'Var bor ni i förhållande till lämplig klinik'  => [
                    "30min-1h till klinik" => 20,
                    "1-2h till klinik" => 30,
                    ">2h till klinik" => 40,
                ],
                'Har det kommit några ungar'  => [
                    "Ja" => 10,
                    "Nej" => 30,
                ],
                'Levande'  => [
                    "Några levande och några döda/mycket svaga" => 30,
                    "Nej" => 10,
                ],
                'När kom senaste ungen'  => [
                    "1-2h sedan" => 40, //HUND
                    ">2h sedan" => 50, //HUND
                ],
                'Syns fosterblåsa/foster'  => [
                    "Ja" => 30,
                ],
                'Flytning'  => [
                    "Ja" => 10,
                ],
                'Färg'  => [
                    "Brunröd" => 10,
                    "Grön" => 100,
                ],
                'Tid förlupen sedan start på förlossning'  => [
                    "0-6h" => 20,//HUND
                    "6-12h" => 50,//HUND
                    "12-18h" => 100,//HUND
                    "24h eller mer" => 100,//HUND
                ],
            ],
            'Katt' =>
                [
                    'Ras Hund'  => [
                        "HundTrubbNos" => 10
                    ],
                    'Ras Katt'  => [
                        "KattTrubbNos" => 10
                    ],
                    'Ålder'  => [
                        "Valp/kattunge (0-6mån)" => 50,
                        "6 mån-2 år" => 10,
                        "över 6 år" => 10,
                    ],
                    'Vikt'  => [
                        "0,5-2 kg" => 50,
                        "över 40 kg" => 10,
                    ],
                    'Allmäntillstånd'  => [
                        "Dämpad/orolig" => 10,
                        "Ligger mest/mycket orolig" => 40,
                        "Piper/gnäller/skriker" => 50,
                    ],
                    'Bajsar/kissar'  => [
                        "Ja-med viss svårighet" => 40,
                        "Nej-vill/kan inte gå ut för rastning" => 50,
                    ],
                    'Aptit'  => [
                        "Nej" => 10,
                    ],
                    'Tydlig hälta'  => [
                        "Ja" => 50,
                    ],
                    'Svullnad'  => [
                        "Ja" => 20,
                    ],
                    'Feber'  => [
                        "Ja" => 50,
                    ],
                    'Allmäntillstånd '  => [
                        "Lite trött" => 10,
                        "Mycket trött" => 40,
                    ],
                    'Dygn i dräktigheten'  => [
                        "<60" => 30,
                        ">70" => 30,
                    ],
                    'Historik av dystoki'  => [
                        "Ja-behandlad medicinskt" => 20,
                        "Ja-snittad" => 40,
                    ],
                    'Har det gjorts bilddiagnostik'  => [
                        "Nej" => 10,
                        "Ja-ultraljud" => 5,
                    ],
                    'Tempsänkning'  => [
                        "Ja" => 10,
                    ],
                    'Vattenavgång'  => [
                        "Ja" => 10,
                    ],
                    'Tid sedan vattenavgång'  => [
                        "30 min-1,5h sedan" => 30,
                        "2-3h sedan" => 50,
                    ],
                    'Värkar'  => [
                        "Ja" => 30,
                    ],
                    'Intensitet'  => [
                        "Inte så kraftiga" => 20,
                        "Mycket kraftiga" => 50,
                    ],
                    'Hur länge'  => [
                        "Börjat nyss" => 10,
                        "Mer än 30 min" => 50,
                        "1-4 h" => 100,
                    ],
                    'Var bor ni i förhållande till lämplig klinik'  => [
                        "30min-1h till klinik" => 20,
                        "1-2h till klinik" => 30,
                        ">2h till klinik" => 40,
                    ],
                    'Har det kommit några ungar'  => [
                        "Ja" => 10,
                        "Nej" => 30,
                    ],
                    'Levande'  => [
                        "Några levande och några döda/mycket svaga" => 30,
                        "Nej" => 10,
                    ],
                    'Syns fosterblåsa/foster'  => [
                        "Ja" => 30,
                    ],
                    'Flytning'  => [
                        "Ja" => 10,
                    ],
                    'Färg'  => [
                        "Brunröd" => 10,
                        "Grön" => 100,
                    ],
                    'Tid förlupen sedan start på förlossning'  => [
                        "12-18h" => 20,//KATT
                        "24h eller mer" => 50,//KATT
                    ],
                ]
        ];
    $animal = $data['Djurslag'];
    $count = 0;

    foreach ($data as $key=>$value) {
        if (array_key_exists($key, $points[$animal])){
            $point = $points[$animal][$key][$value];
            $count += $point;
        }
    }
    var_dump($count);exit;
    return $count;
}
