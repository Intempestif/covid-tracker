<!-- Données sources -->
<!-- https://www.coronavirus-statistiques.com/corostats/openstats/open_stats_coronavirus.json -->

<?php

// récupération de l'heure actuelle en France

$date = date('d-m-y h:i:s');
// echo $date;

// manipulation du fichier json time-check.json

// echo "<br/>";

$json = file_get_contents("time-check.json");

$data = json_decode($json, true);

foreach ($data as $value) {
    $lastCheck = $value['time'];
}

// echo "last check = " .$lastCheck;

// maintenant vérifier si la dernière date est au moins inférieur à 1h de $date

$firstDate = new \DateTime($date);
$secondDate = new \DateTime($lastCheck);

$diff = $firstDate->diff($secondDate);
$diffHours = $diff->h;

// diff in hours (don't worry about different years, it's taken into account)
$diffInHours = $diffHours + ($diff->days * 24);

// more than 1 hour diff
// var_dump($diffInHours >= 1);

// faire la mise à jour du fichier seulement si ($diffInHours >= 1)

if($diffInHours >= 1){

    // ecrire $lastCheck dans le fichier json maintenant

    $newEntry = ['time'=>$date];

    array_push($data, $newEntry);

    // maintenant il faut enregistré $data comme fichier json sur le serveur

    $fp = fopen('time-check.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);

    // Initialize a file URL to the variable
    $url = 'https://www.coronavirus-statistiques.com/corostats/openstats/open_stats_coronavirus.json';
    
    // Use basename() function to return the base name of file 
    $file_name = basename($url);

    // echo "<br />";
    
    // Use file_get_contents() function to get the file
    // from url and use file_put_contents() function to
    // save the file by using base name

    if(file_put_contents( $file_name,file_get_contents($url))) {
        // echo "File downloaded successfully";
    }
    else {
        echo "Il y a eu une erreur avec le téléchargement de la nouvelle source, veuillez contacter l'administrateur de ce site.";
    }

}
  
?>