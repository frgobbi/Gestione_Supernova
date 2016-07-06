<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 12/06/2016
 * Time: 11:54
 */
include "../../connessione.php";

$nome = $_GET['nomeG'];
$b=0;
try{
    $sql = "SELECT * FROM girone WHERE nome_g = '$nome'";
    foreach ($connessione->query($sql) as $row){
        $b=1;
    }
} catch (PDOException $e){
    echo "error:".$e->getMessage();
}

echo $b;