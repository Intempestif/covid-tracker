<?php
session_start();


$file = "../open_stats_coronavirus.json";

$data = file_get_contents($file);

$array = json_decode($data, true);


$casArray = [];

$decesArray = [];

$moisArray = [];



foreach ($array as $value) {



    $date = date_parse($value['date']);

    $jour = $date['day'];

    $mois = $date['month'];

    $annee = $date['year'];



    if (isset($_POST['pays']) && isset($_POST['annee'])) {



        if ($value['nom'] == $_POST['pays'] && $annee == $_POST['annee']) {



            for ($i = 1; $i <= 12; $i++) {



                if ($mois == $i) {



                    $totalCas[$i] = intval($value["cas"]);

                    $totalDeces[$i] = intval($value["deces"]);



                }



            }



        }



    }



}

for ($i = 1; $i <= 12; $i++) {

    if (isset($totalCas[$i])) {



        array_push($casArray,$totalCas[$i]);

        array_push($decesArray,$totalDeces[$i]);

        array_push($moisArray,$i);



    }

}

echo json_encode($moisArray)."/".json_encode($casArray)."/".json_encode($decesArray);

exit();

?>