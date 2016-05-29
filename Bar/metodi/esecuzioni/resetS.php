<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 26/05/2016
 * Time: 16:09
 */
$b =0;
$evento = $_GET['evento'];
$data = $_GET['data'];
include "../../../connessione.php";
try{
    $connessione->beginTransaction();

    $connessione->exec("UPDATE serata SET incasso = '0' WHERE serata.d_ord = '$data' AND serata.id_evento = $evento");
    $connessione->exec("UPDATE serata SET chiusura = '0' WHERE serata.d_ord = '$data' AND serata.id_evento = $evento");
    $connessione->exec("UPDATE serata SET n_ordini = '0' WHERE serata.d_ord = '$data' AND serata.id_evento = $evento");

    $connessione->commit();
} catch (PDOException $e){
    $connessione->rollBack();
}
$connessione = null;