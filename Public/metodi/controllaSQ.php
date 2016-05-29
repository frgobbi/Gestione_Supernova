<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 20/05/2016
 * Time: 11:34
 */
include "../../connessione.php";

$nome = $_GET['nomeS'];
$b=0;
try{
    $sql = "SELECT * FROM squadra WHERE nomeSQ = '$nome'";
    foreach ($connessione->query($sql) as $row){
        $b=1;
    }
} catch (PDOException $e){
    echo "error:".$e->getMessage();
}

echo $b;