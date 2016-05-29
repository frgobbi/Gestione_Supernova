<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 26/05/2016
 * Time: 20:50
 */
$b =0;
$data = date("Y-m-d");
//$data = $_GET['data'];
include "../../../connessione.php";

foreach ($connessione->query("SELECT * FROM `serata` WHERE serata.d_ord = '$data'") as $row){
    $b = 1;
}

$connessione = null;
echo $b;
