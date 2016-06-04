<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 30/05/2016
 * Time: 20:21
 */
$id_p = $_GET['id_p'];
$nome = $_GET['nome'];
$prezzo = $_GET['prezzo'];
$cat = $_GET['cat'];
$disp = $_GET['disp'];

include "../../../connessione.php";
try{
    $connessione->exec("UPDATE `prodotto` SET `nome_p` = '$nome' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    $connessione->exec("UPDATE `prodotto` SET `prezzo` = '$prezzo' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    $connessione->exec("UPDATE `prodotto` SET `id_cat` = '$cat' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    if(strcmp($disp,"null")==0){
        $connessione->exec("UPDATE `prodotto` SET `disp` = NULL WHERE `prodotto`.`id_prodotto` = '$id_p'");
    } else {
        $connessione->exec("UPDATE `prodotto` SET `disp` = '$disp' WHERE `prodotto`.`id_prodotto` = '$id_p'");
    }
    
} catch (PDOException $e){
    echo "error: ".$e;
}
$connessione = null;