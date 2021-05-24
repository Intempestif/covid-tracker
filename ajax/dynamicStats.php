<?php
session_start();

$paysSelected = $_POST["pays"];
$_SESSION['pays'] = $paysSelected;

$anneeSelected = $_POST["annee"];
$_SESSION['annee'] = $anneeSelected;

echo "$paysSelected,$anneeSelected";

exit();

?>