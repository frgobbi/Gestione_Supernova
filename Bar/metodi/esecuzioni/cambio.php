<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 25/05/2016
 * Time: 20:06
 */
$risultato = 0;
$evento = $_GET['evento'];
$data = $_GET['data'];
$cambio = $_GET['cambio'];
include "../../../connessione.php";

if($cambio == 1){
    try{
        $connessione->exec("UPDATE `serata` SET `chiusura` = '1' WHERE `serata`.`d_ord` = '$data' AND `serata`.`id_evento` = $evento;");
    } catch (PDOException $e){
        $risultato = 1;
    }
}
else{
    try{
        $connessione->exec("UPDATE `serata` SET `chiusura` = '0' WHERE `serata`.`d_ord` = '$data' AND `serata`.`id_evento` = $evento;");
    } catch (PDOException $e){
        $risultato = 1;
    }
}

echo $risultato;