<?php
session_start();

$paysSelected = $_POST["pays"];

$anneeSelected = $_POST["annee"];

echo "$paysSelected,$anneeSelected";

?>