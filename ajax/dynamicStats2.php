<?php
session_start();

$file = "../open_stats_coronavirus.json";
$data = file_get_contents($file);
$array = json_decode($data, true);

$casArray = [];
$decesArray = [];
$moisArray = [];

$listePays = ["france", "italie", "uk", "espagne", "allemagne", "suisse", "belgique", "nl", "canada", "usa", "coree", "maroc", "russie", "japon", "algerie", "tunisie", "australie", "nouvelle-zelande", "argentine", "mexique",
    "equateur", "colombie", "irlande", "islande", "inde", "pakistan", "bangladesh", "singapour", "suede", "norvege", "finlande", "danemark", "cameroun", "burkina_fasso", "afrique_du_sud", "cote_d_ivoir", "sri_lanka", "israel", "arabie_saoudite", "egypte", "uae", "liban",
    "turquie", "laos", "indonesie", "vietnam", "bresil", "portugal", "grece", "thailande", "chili", "perou", "ukraine", "bielorussie", "pologne", "iran", "estonie", "lettonie", "luxembourg", "taiwan",
    "Saint-Martin", "Wallis et Futuna", "Polynésie française", "Nouvelle-Calédonie"];

foreach ($array as $value) {

    $date = date_parse($value['date']);
    $jour = $date['day'];
    $mois = $date['month'];
    $annee = $date['year'];

    if (isset($_SESSION['pays']) && isset($_SESSION['annee'])) {

        // echo $_SESSION['pays'] . "<br>";

        // echo $mois . "<br>";

        if ($value['nom'] == $_SESSION['pays'] && $annee == $_SESSION['annee']) {

            for ($i = 1; $i <= 12; $i++) {

                if ($mois == $i) {

                    $totalCas[$i] = intval($value["cas"]);
                    $totalDeces[$i] = intval($value["deces"]);
                    // $moisArray[$i] = $mois;

                }

            }

        }

    }

}

for ($i = 1; $i <= 12; $i++) {

    if (isset($totalCas[$i])) {

        // if ($moisArray[$i] == $i) {

            // echo 

            array_push($casArray,$totalCas[$i]);
            array_push($decesArray,$totalDeces[$i]);
            array_push($moisArray,$i);

        // }

    }

}

// echo $totalCas[3];

echo json_encode($moisArray)."/".json_encode($casArray)."/".json_encode($decesArray);

// echo json_encode($_SESSION['annee'])."/".json_encode($_SESSION['pays']);

exit();

?>