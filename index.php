<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>



    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <title>Covid Tracker projet étudiant</title>



    <meta name="description" content="Covid Tracker est un projet étudiant de suivis des statistiques du covid-19 avec graphiques et tableaux du nombres de cas et de décès par pays selon une source donnée en bas de page.">



    <!-- // * FONTAWESOME -->



    <!-- <link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

    <script src="fontawesome/fontawesome.js"></script>



    <!-- // * CHART.js -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.1/chart.min.js"></script>



    <!-- // * Bootstrap -->



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"

    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">



    <link rel="stylesheet" href="style.css">



    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">

    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">

    <link rel="manifest" href="favicon/site.webmanifest">

    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">

    <link rel="shortcut icon" href="favicon/favicon.ico">

    <meta name="msapplication-TileColor" content="#da532c">

    <meta name="msapplication-config" content="favicon/browserconfig.xml">

    <meta name="theme-color" content="#ffffff">



    <script src="jquery-3.6.0.min.js"></script>





</head>

<body>



<?php



include "navbar.php";



include "stats-recup.php";



include "stats.php";



include "modal.php";



include "footer.php";



?>



<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    

</body>

</html>