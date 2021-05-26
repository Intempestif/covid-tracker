<?php
$file = "open_stats_coronavirus.json";
$data = file_get_contents($file);
$array = json_decode($data,true);

// $listePays sert à afficher dans le select du form uniquement les lieux choisis

$listePays = ["france","italie","uk","espagne","allemagne","suisse","belgique","nl","canada","usa","coree","maroc","russie","japon","algerie","tunisie","australie","nouvelle-zelande","argentine","mexique",
"equateur","colombie","irlande","islande","inde","pakistan","bangladesh","singapour","suede","norvege","finlande","danemark","cameroun","burkina_fasso","afrique_du_sud","cote_d_ivoir","sri_lanka","israel","arabie_saoudite","egypte","uae","liban",
"turquie","laos","indonesie","vietnam","bresil","portugal","grece","thailande","chili","perou","ukraine","bielorussie","pologne","iran","estonie","lettonie","luxembourg","taiwan",
"Saint-Martin","Wallis et Futuna","Polynésie française","Nouvelle-Calédonie"];

// * STATS DU MONDE
// toute cette première partie sert à récupérer tous les cumuls de cas, deces et guerisons et les additionne pour les afficher sous le hero header

$mondeCas = 0;
$mondeDeces = 0;
$mondeGuerisons = 0;
$totalCasPays = [];
$totalDecesPays = [];
$totalGuerisonsPays = [];
$lieuActuel = "";
$lieux = [];

foreach($array as $value){
    // parcours de toutes les entrees du fichier corona json
    
    if($lieuActuel == "") {
        // si lieu actuel vide et nom du lieu trouvé dans listPays, alors on cumul les cas, deces et guerisons

        foreach($listePays as $pays) {

            if($value['nom'] == $pays) {

                $lieuActuel = $value['nom'];
                $totalCasP = intval($value['cas']);
                $totalDecesP = intval($value['deces']);
                $totalGuerisonsP = intval($value['guerisons']);

            }

        }

    }
    else if($lieuActuel == $value['nom']) {
        // si lieu actuel est égal au lieu de cette entrée json, alors on continue à cumuler

        $totalCasP = intval($value['cas']);
        $totalDecesP = intval($value['deces']);
        $totalGuerisonsP = intval($value['guerisons']);

    }
    else if($lieuActuel != $value['nom']) {
        // si lieu n'est plus égal au nouveau lieu de l'entrée alors on arrête le cumul, on stock les données dans les tableaux précédemment créés

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

            }

        }

    }

}

// les sommes finales à afficher dans le bandeau

$mondeCas = array_sum($totalCasPays);
$mondeDeces = array_sum($totalDecesPays);
$mondeGuerisons = array_sum($totalGuerisonsPays);

?>

<!-- // * HERO HEADER -->

<div class="container-fluid p-0 m-0">

    <div class="home col-12 p-0 d-flex align-items-center justify-content-center text-center">
        <div class="main_text">
            <h1 class="main_first_text"><i class="fas fa-virus"></i> Covid Tracker <i class="fas fa-virus"></i></h1>
            <h3 class="main_third_text mt-5">Statistiques du Covid-19</h3>

            <?php

            // $json est l'array qui contient le time-check.json dans stats-recup.php
            $data = json_decode($json, true);

            foreach ($data as $value) {
                $lastCheck = $value['time'];
            }

            ?>

            <!-- $lastCheck est maintenant égal à la dernière date entrée de time-check.json -->
            <div>dernière m.a.j : <?= $lastCheck ?></div>

        </div>
        <div class="img_shadow"></div>
    </div>

    <!-- Bandeau des stats mondiales -->

    <div class="container-fluid p-0 world-container">

        <div class="row p-0 m-0 w-100">

            <div class="col-12 mt-4 d-flex flex-column flex-md-row justify-content-center align-items-center align-middle">
                
                <span class="mr-0 mr-md-4">
                    <i class="fas fa-globe"></i>
                </span>
                <h2 class="text-compteur font-weight-bold text-center mt-4 mt-md-0">
                    Statistiques Mondiales *
                </h2>

            </div>

        </div>

        <div class="row world-compteur mt-5 pb-5">

            <div class="col-12 d-flex flex-column flex-md-row justify-content-around text-center">

                <div class="d-flex flex-column">

                    <div>Nombre de cas :</div>

                    <div class="font-weight-bold">
                        <?php 
                        // echo number_format($mondeCas, 2, '.', ',');
                        // var_dump(number_format($mondeCas, 2, '.', ','));
                        
                        $stringOri = number_format($mondeCas, 2, '.', ',');
                        $stringNew = substr($stringOri, 0, -3);
                        // var_dump($test);
                        echo $stringNew;

                        ?>
                    </div>

                </div>

                <div class="d-flex flex-column">

                    <div>Nombre de décès :</div>

                    <div class="font-weight-bold">
                        <?php 
                        
                        $stringOri = number_format($mondeDeces, 2, '.', ',');
                        $stringNew = substr($stringOri, 0, -3);
                        // var_dump($test);
                        echo $stringNew;
                        
                        ?>
                    </div>

                </div>

                <div class="d-flex flex-column">

                    <div>Nombre de guérisons :</div>
                    <div class="font-weight-bold">
                        <?php 
                        
                        $stringOri = number_format($mondeGuerisons, 2, '.', ',');
                        $stringNew = substr($stringOri, 0, -3);
                        // var_dump($test);
                        echo $stringNew;
                        
                        ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bandeau pays et année actuellement sélectionnés -->

    <div class="row w-100 m-0 p-0">
    
        <div class="col-12 p-5 bande1">
            
            <?php
            if(isset($_SESSION['pays']) && isset($_SESSION['annee'])) {

                ?>

                <h2 class="text-center" id="paysH2"></h2>

                <?php

            }

            else {

                ?>

                <h3 class="text-center">Veuillez rafraichir la page une première fois pour set une session</h3>

                <?php

            }

            ?>
        
        </div>

    </div>

    <div class="container-md p-0">
    
        <div class="row w-100 m-0 p-0 filtres">

            <div class="col-12 p-3">

                <!-- // * FILTRES -->
            
                <h5 class="font-weight-bold"><i class="fas fa-exchange-alt"></i> Changer</h5>

                <span id="changeSuccess"></span>

                <form action="" method="post" class="m-0 p-0 d-flex flex-column flex-md-row justify-content-center align-items-center">

                    <select class="mb-2 mt-2 mt-md-0 mb-md-0" name="lieu" id="lieu-select">

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

                    <select class="ml-3 mb-2 mb-md-0" name="annee" id="annee-select">

                        <option value="2020">2020</option>
                        <option value="2021">2021</option>

                    </select>

                    <!-- <input id="buttonRefresh" class="ml-3 btn btn-primary m-0 align-middle" type="button" name="submit" value="Changer" /> -->

                </form>

            </div>

        </div>

        <!-- SCRIPTS AJAX pour affichage dynamique -->

        <script>

            window.onload = function() {

                // $('#buttonRefresh').on('click', function() {
                //     refreshStats();
                // });

                $('#lieu-select').on('change', function() {
                    refreshStats();
                });

                $('#annee-select').on('change', function() {
                    refreshStats();
                });

                var GlobalCas = [];
                var GlobalDeces = [];
                var GlobalMois = [];

                refreshStats();

            };

            function refreshStats() {

                var annee = "2020";
                var annee = $('#annee-select option:selected').val();
                var pays = "france";
                var pays = $('#lieu-select option:selected').val();

                $.ajax({
                    url: "ajax/dynamicStats.php",
                    method: "POST",
                    data: { pays: pays, annee: annee },
                    success: function(html){
                        
                        var ajaxArray = html.split(',');
                        // document.getElementById("changeSuccess").innerHTML = "Changement effectué pour " + ajaxArray[0] + " en " + ajaxArray[1];
                        $('#paysH2').text(ajaxArray[0] + " en " + ajaxArray[1]);

                    }
                });

                $.ajax({
                    url: "ajax/dynamicStats2.php",
                    // * je mets async: false car sans ça je n'arrive pas à ecrire dans mes array GlobalCas etc
                    async: false,
                    method: "POST",
                    data: { },
                    success: function(html){

                        // html est la réponse donné par le echo dans dynamicStats2.php

                        // split sépare la chaine de caractères html en un tableau ou les trois entrées seront dans l'ordre les mois, les cas et les décès
                        var ajaxArray2 = html.split('/');

                        // cas

                        var ajaxArray2Cas = ajaxArray2[1].split(',');
                        // ces traitement servent à enlever le crochet de début et celui de fin
                        ajaxArray2Cas[0] = ajaxArray2Cas[0].substring(1,ajaxArray2Cas[0].length);
                        ajaxArray2Cas[ajaxArray2Cas.length-1] = ajaxArray2Cas[ajaxArray2Cas.length-1].slice(0,-1);
                        
                        GlobalCas = ajaxArray2Cas;

                        // deces

                        var ajaxArray2Deces = ajaxArray2[2].split(',');
                        ajaxArray2Deces[0] = ajaxArray2Deces[0].substring(1,ajaxArray2Deces[0].length);
                        ajaxArray2Deces[ajaxArray2Deces.length-1] = ajaxArray2Deces[ajaxArray2Deces.length-1].slice(0,-1);

                        GlobalDeces = ajaxArray2Deces;

                        // mois

                        var ajaxArray2Mois = ajaxArray2[0].split(',');
                        ajaxArray2Mois[0] = ajaxArray2Mois[0].substring(1,ajaxArray2Mois[0].length);
                        ajaxArray2Mois[ajaxArray2Mois.length-1] = ajaxArray2Mois[ajaxArray2Mois.length-1].slice(0,-1);

                        GlobalMois = ajaxArray2Mois;

                        // remplissage du tableau de cas et deces en javascript / jquery

                        var cible = 0;

                        $('.totalCas').each(function( index ) {

                            for(let i=1;i<=12;i++){
                                if($(this).attr("id") == "totalCas"+i) {

                                    if(ajaxArray2Mois[cible] == i) {
                                        
                                        this.innerHTML = ajaxArray2Cas[cible];
                                        cible = cible + 1;

                                    }
                                    else {
                                        this.innerHTML = "pas de données"
                                    }

                                }
                                
                            }
                        });

                        var cible = 0;

                        $('.totalDeces').each(function( index ) {

                            for(let i=1;i<=12;i++){
                                if($(this).attr("id") == "totalDeces"+i) {


                                    if(ajaxArray2Mois[cible] == i) {
                                        
                                        this.innerHTML = ajaxArray2Deces[cible];
                                        cible = cible + 1;

                                    }
                                    else {
                                        this.innerHTML = "pas de données"
                                    }

                                }
                                
                            }
                        });

                    }
                });

                function verif1(mois,cas,deces){

                    console.log(mois + "\\" + cas + "\\" + deces);

                }

                generateChart();

            }
            function generateChart(){

                // configuration du graphique chart.js

                const labels = GlobalMois;

                const data = {
                labels: labels,
                datasets: [
                {
                    label: 'nombre de cas',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: GlobalCas,
                },
                {
                    label: 'nombre de décès',
                    backgroundColor: 'rgb(149, 224, 108)',
                    borderColor: 'rgb(149, 224, 108)',
                    data: GlobalDeces,
                },
                ]
                };

                const config = {
                type: 'line',
                data,
                options: {}
                };

                if($('#myChart').display == "none") {

                    var myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );

                    console.log(myChart);

                }
                else {

                    document.getElementById('canvasParent').innerHTML = "";
                    document.getElementById('canvasParent').innerHTML = "<canvas id='myChart' style='min-height: 200px;'></canvas>";
                
                    var myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );

                    // console.log(myChart);

                    // myChart.update();
                    
                }

            }
            
        </script>

        <div class="row p-0 m-0">

            <div id="canvasParent" class="col-12 mt-5 mb-5">

                <!-- CANVAS DU GRAPHIQUE CHARTS.JS -->
                <!-- je mets un display none pour pouvoir cibler le canvas juste au dessus à la vérification en javascript -->

                <canvas id="myChart" style="display: none;"></canvas>

            </div>

            <div id="tableStats" class="col-12 mt-5 mb-5 text-center">

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
                    
                    for($i=1;$i<=12;$i++){
                        
                        ?>

                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td class="totalCas" id="totalCas<?= $i ?>">test</td>
                            <td class="totalDeces" id="totalDeces<?= $i ?>">test</td>
                        </tr>

                        <?php

                    }

                    ?>

                    </tbody>

                </table>

            </div>
        
        </div>
    
    </div>

</div>