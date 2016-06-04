<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 30/05/2016
 * Time: 00:32
 */

$id = $_GET['id_p'];


include "../../../connessione.php";

try{
    $connessione->exec("DELETE FROM prodotto WHERE id_prodotto = '$id'");
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;