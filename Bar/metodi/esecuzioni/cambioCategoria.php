<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 29/05/2016
 * Time: 23:39
 */

$id = $_GET['id_cat'];
$value = $_GET['color'];

include "../../../connessione.php";

try{
    $connessione->exec("UPDATE `categoria` SET `colore` = '$value' WHERE `categoria`.`id_cat` = '$id'");
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;