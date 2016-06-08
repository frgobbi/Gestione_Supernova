<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 05/06/2016
 * Time: 23:14
 */
$id = $_GET['id'];

include "../../connessione.php";
try{
    $connessione->exec("DELETE FROM partita_giocatore WHERE id_giocatore = $id");
    $connessione->exec("DELETE FROM `giocatore` WHERE id_g = $id");
}catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;