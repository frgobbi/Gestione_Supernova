<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 09/06/2016
 * Time: 16:20
 */
include "../../connessione.php";
$user = $_GET['id'];
$SQL = "SELECT * FROM staff NATURAL JOIN tipo_staff NATURAL JOIN evento WHERE username = '$user'";
try{
    $ogg = $connessione->query($SQL)->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;

echo json_encode(
    array(
        "username"=>$ogg->username,
        "nome"=>$ogg->nome,
        "cognome"=>$ogg->cognome,
        "data_n"=>$ogg->data_nascita,
        "sesso"=>$ogg->sesso,
        "email"=>$ogg->email,
        "foto"=>$ogg->foto,
        "evento"=>$ogg->id_evento,
        "nome_evento"=>$ogg->nome_evento,
        "tipo"=>$ogg->id_staff,
        "nome_tipo"=>$ogg->descrizione,
        "pass"=>$ogg->pass)
);