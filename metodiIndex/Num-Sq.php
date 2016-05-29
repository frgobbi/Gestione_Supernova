<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 25/05/2016
 * Time: 09:51
 */
$i = $_GET['id'];
include "../connessione.php";
foreach ($connessione->query("SELECT COUNT(*) AS numeroSQ FROM squadra WHERE  id_evento = $i") as $row){
    $num = $row['numeroSQ'];
}
$connessione = null;

echo ($num);
