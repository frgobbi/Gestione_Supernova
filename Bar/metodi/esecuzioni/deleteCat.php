<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 29/05/2016
 * Time: 23:54
 */

$id = $_GET['id_cat'];


include "../../../connessione.php";

try{
    $connessione->exec("DELETE FROM prodotto WHERE id_cat = '$id'");
    $connessione->exec("DELETE FROM categoria WHERE categoria.id_cat = '$id'");

} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;