<?php
$file = "open_stats_coronavirus.json";
$data = file_get_contents($file);
$array = json_decode($data,true);

$listePays = ["france","italie","uk","espagne","allemagne","suisse","belgique","nl","canada","usa","coree","maroc","russie","japon","algerie","tunisie","australie","nouvelle-zelande","argentine","mexique",
"equateur","colombie","irlande","islande","inde","pakistan","bangladesh","singapour","suede","norvege","finlande","danemark","cameroun","burkina_fasso","afrique_du_sud","cote_d_ivoir","sri_lanka","israel","arabie_saoudite","egypte","uae","liban",
"turquie","laos","indonesie","vietnam","bresil","portugal","grece","thailande","chili","perou","ukraine","bielorussie","pologne","iran","estonie","lettonie","luxembourg","taiwan","La Réunion","Saint-Barthélemy",
"Saint-Martin","Wallis et Futuna","Polynésie française","Nouvelle-Calédonie"];

// STATS DU MONDE

$mondeCas = 0;
$mondeDeces = 0;
$mondeGuerisons = 0;
$totalCasPays = [];
$totalDecesPays = [];
$totalGuerisonsPays = [];
$lieuActuel = "";
$lieux = [];

foreach($array as $value){

    if($lieuActuel == "") {

        foreach($listePays as $pays) {

            if($value['nom'] == $pays) {

                $lieuActuel = $value['nom'];
                $totalCasP = intval($value['cas']);
                // var_dump($totalCasP);
                $totalDecesP = intval($value['deces']);
                $totalGuerisonsP = intval($value['guerisons']);

                // echo "lieu : " .$lieuActuel ." Cas : " .$totalCasP ."<br/>";

            }

        }

    }
    else if($lieuActuel == $value['nom']) {

        $totalCasP = intval($value['cas']);
        $totalDecesP = intval($value['deces']);
        $totalGuerisonsP = intval($value['guerisons']);

        // echo "lieu : " .$lieuActuel ." Cas : " .$totalCasP ."<br/>";

    }
    else if($lieuActuel != $value['nom']) {

        foreach($listePays as $pays) {

            if($value['nom'] == $pays) {

                array_push($totalCasPays,$totalCasP);
                array_push($totalDecesPays,$totalDecesP);
                array_push($totalGuerisonsPays,$totalGuerisonsP);
                array_push($lieux,$lieuActuel);

                $lieuActuel = $value['nom'];
                $totalCasP = intval($value['cas']);
                $totalDecesP = intval($value['deces']);
                $totalGuerisonsP = intval($value['guerisons']);

                // echo "lieu : " .$lieuActuel ." Cas : " .$totalCasP ."<br/>";

            }

        }

    }
    else {

    }

}

// var_dump($listePays);
// var_dump($totalCasPays);
// var_dump($lieux);

$mondeCas = array_sum($totalCasPays);
$mondeDeces = array_sum($totalDecesPays);
$mondeGuerisons = array_sum($totalGuerisonsPays);

?>

<div class="container-fluid p-0 m-0">

    <div class="home col-12 p-0 d-flex align-items-center justify-content-center text-center">
        <div class="main_text">
            <h1 class="main_first_text"><i class="fas fa-virus"></i> Covid Tracker <i class="fas fa-virus"></i></h1>
            <h3 class="main_third_text mt-5">Statistiques du Covid-19</h3>
        </div>
        <div class="img_shadow"></div>
    </div>

    <div class="container-fluid p-0 world-container mb-4">

        <div class="row p-0 m-0 w-100">

            <div class="col-12 mt-4 d-flex flex-column flex-md-row justify-content-center align-items-center align-middle">
                
                <span class="mr-0 mr-md-4">
                    <i class="fas fa-globe"></i>
                </span>
                <h2 class="text-compteur font-weight-bold text-center mt-4 mt-md-0">
                    Statistiques Mondiales 
                </h2>

            </div>

        </div>

        <div class="row world-compteur mt-5 pb-5">

            <div class="col-12 d-flex flex-column flex-md-row justify-content-around text-center">

                <div class="d-flex flex-column">

                    <div>Nombre de cas :</div>

                    <div class="font-weight-bold">
                        <?= number_format($mondeCas, 2, '.', ',') ?>
                    </div>

                </div>

                <div class="d-flex flex-column">

                    <div>Nombre de décès :</div>

                    <div class="font-weight-bold">
                        <?= number_format($mondeDeces, 2, '.', ',') ?>
                    </div>

                </div>

                <div class="d-flex flex-column">

                    <div>Nombre de guérisons :</div>
                    <div class="font-weight-bold">
                        <?= number_format($mondeGuerisons, 2, '.', ',') ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container-md p-0">
    
        <div class="row m-0 p-0 pb-4 filtres">

            <div class="col-12 col-md-12">

                <!-- * FILTRES -->
            
                <h5 class="font-weight-bold"><i class="far fa-chart-line"></i> Filtres :</h5>

                <form action="" method="post" class="">

                    <!-- <label for="lieu-select">Choisir un lieu :</label> -->

                    <select name="lieu" id="lieu-select">

                        <?php

                        $lieuActuel = "";

                        foreach($array as $value){

                            if($lieuActuel != $value['nom']) {

                                foreach($listePays as $pays) {

                                    if($value['nom'] == $pays) {

                                        $lieuActuel = $value['nom'];

                                        ?>

                                        <option value="<?= $value['nom'] ?>"><?= $value['nom'] ?></option>

                                        <?php

                                    }

                                }
                                
                            }

                        ?>

                        <?php
                        }
                        ?>

                    </select>

                    <!-- <label class="mt-3" for="annee-select">Choisir une année :</label> -->

                    <select name="annee" id="annee-select">

                        <option value="2020">2020</option>
                        <option value="2021">2021</option>

                    </select>

                    <input class="mt-4 ml-3" type="submit" name="submit" value="Rafraichir" />

                </form>

            </div>

        </div>

        <div class="row p-0 m-0">

            <div class="col-12 mt-5 mb-5">
                
                <?php
                if(isset($_POST['lieu']) && isset($_POST['annee'])) {

                    ?>

                    <h2 class="mb-5 text-center"><?php echo $_POST['lieu'] ." / " .$_POST['annee']?></h2>

                    <?php

                }

                else {

                    ?>

                    <h2 class="mb-5 text-center">Belgique / 2020</h2>

                    <?php

                }

                ?>

                <canvas id="myChart"></canvas>

            </div>

            <div class="col-12 mt-5 mb-5 text-center">

                <table class="table table-striped table-bordered">

                    <thead class="thead-dark">

                        <tr>
                            <th scope="col">Mois</th>
                            <th scope="col">Cas</th>
                            <th scope="col">Décès</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    foreach($array as $value){

                        $date = date_parse($value['date']);
                        $jour = $date['day'];
                        $mois = $date['month'];
                        $annee = $date['year'];

                        if(isset($_POST['lieu']) && isset($_POST['annee'])){

                            if($value['nom'] == $_POST['lieu'] && $annee == $_POST['annee']){

                                for($i=1;$i<=12;$i++){

                                    if($mois == $i) {

                                        $totalCas[$i] = $value["cas"];
                                        $totalDeces[$i] = $value["deces"];

                                    }

                                }

                            }

                        }
                        else if($value['nom'] == "belgique" && $annee == '2020') {
                            
                            for($i=1;$i<=12;$i++){

                                if($mois == $i) {

                                    $totalCas[$i] = $value["cas"];
                                    $totalDeces[$i] = $value["deces"];

                                }

                            }

                        }

                    }

                    for($i=1;$i<=12;$i++){

                        if(isset($totalCas[$i])) {
    
                            ?>
    
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $totalCas[$i] ?></td>
                                <td><?= $totalDeces[$i] ?></td>
                            </tr>
    
                            <?php
                        }

                    }

                    ?>

                    </tbody>

                </table>

            </div>

            <?php
            include "covid.php";
            ?>
        
        </div>
    
    </div>

</div>

<script>

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>