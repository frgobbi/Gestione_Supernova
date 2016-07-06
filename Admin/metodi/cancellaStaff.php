<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 09/06/2016
 * Time: 01:06
 */
include "../../connessione.php";
$user = $_GET['id'];
$SQL = "DELETE FROM staff WHERE username = '$user'";
try{
    $connessione->exec($SQL);
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;
