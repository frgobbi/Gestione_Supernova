<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 06/06/2016
 * Time: 09:15
 */
include "../../connessione.php";
$id =$_GET['id_g'];
$sql = "SELECT * FROM giocatore INNER JOIN squdra ON id_squadra = id_sq WHERE id_g = $id";
try{
    foreach ($connessione->query($sql) as $row){
        $id = $row['id_g'];
        $nome = $row['nome'];
        $cognome = $row['cognome'];
        $data = $row['d_nascita'];
        $luogo = $row['Luogo_n'];
        $cod = $row['CodiceFiscale'];
        $via = $row['Res'];
        $idS = $row['id_sq'];
        $nomeS = $row['nomeSQ'];
    }
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}

$connessione = null;

echo json_encode(
    array(
        "id"=>$id,
        "nome"=>$nome,
        "cognome"=>$cognome,
        "data"=>$data,
        "luogo"=>$luogo,
        "codice"=>$cod,
        "Res"=>$via,
        "id_s"=>$idS,
        "nomeS"=>$nomeS)
);