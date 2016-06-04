<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 29/05/2016
 * Time: 22:54
 */
include "../../../connessione.php";
$id_cat =$_GET['id_cat'];
$sql = "SELECT * FROM categoria WHERE id_cat = $id_cat";
try{
    foreach ($connessione->query($sql) as $row){
        $id = $row['id_cat'];
        $nome = $row['tipo_cat'];
        $colore = $row['colore'];
    }
} catch (PDOException $e){
    echo "error: ".$e->getMessage();
}

$connessione = null;

echo json_encode(
    array(
        "id"=>$id,
        "nome"=>$nome,
        "colore"=>$colore)
);