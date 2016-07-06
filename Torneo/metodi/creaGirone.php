<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 12/06/2016
 * Time: 12:00
 */

$nomeG = filter_input(INPUT_POST, "nomeG", FILTER_SANITIZE_STRING);
include "../../connessione.php";
try{
    $connessione->exec("INSERT INTO `girone` (`id_girone`, `nome_g`) VALUES (NULL, '$nomeG')");
} catch (PDOException $e){ echo"error: ".$e->getMessage();}
$connessione = null;
echo "<script type='text/javascript'>location.href=\"../Gironi.php\"</script>";