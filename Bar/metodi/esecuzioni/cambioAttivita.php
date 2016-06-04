<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 31/05/2016
 * Time: 00:26
 */
$id_p = $_GET['id_p'];
$attivita = $_GET['attivita'];


include "../../../connessione.php";
try{
    if(strcmp($attivita,"attivo")==0){
        $connessione->exec("UPDATE `prodotto` SET `vendita` = '1' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    } else {
        $connessione->exec("UPDATE `prodotto` SET `vendita` = '0' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    }

} catch (PDOException $e){
    echo "error: ".$e;
}
$connessione = null;