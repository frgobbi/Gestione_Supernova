<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 25/05/2016
 * Time: 13:10
 */
$evento = $_GET['evento'];
$b = 0;
include "../../../connessione.php";
try{
    foreach($connessione->query("SELECT * FROM serata WHERE chiusura = 0 and id_evento = $evento") as $row ){
        $b = 1;
    }
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;

echo $b;