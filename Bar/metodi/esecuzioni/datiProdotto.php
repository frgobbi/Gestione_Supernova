<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 31/05/2016
 * Time: 21:43
 */
include "../../../connessione.php";
$id =$_GET['id_P'];
$sql = "SELECT * FROM prodotto INNER JOIN categoria ON prodotto.id_cat = categoria.id_cat WHERE id_prodotto = $id ORDER BY(prodotto.id_cat)";
try{
    foreach ($connessione->query($sql) as $row){
        $id = $row['id_prodotto'];
        $nome = $row['nome_p'];
        $prezzo = $row['prezzo'];
        $id_cat = $row['id_cat'];
        $nome_cat = $row['tipo_cat'];
        if($row['disp']==NULL){
            $disp = "Nessun Vincolo";
        }else{
            $disp = $row['disp'];
        }
        $vendita = $row['vendita'];
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
        "prezzo"=>$prezzo,
        "id_cat"=>$id_cat,
        "nome_cat"=>$nome_cat,
        "disp"=>$disp,
        "vendita"=>$vendita,
        "colore"=>$colore)
);