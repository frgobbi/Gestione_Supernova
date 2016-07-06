<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 01/06/2016
 * Time: 08:13
 */
include "../../../connessione.php";
session_start();
$evento = $_SESSION['id_evento'];
if($connessione->query("SELECT d_ord FROM serata WHERE id_evento = 1 AND chiusura = 0")->rowCount() == 0){
    echo "2";
    exit;
}
$dataS = $connessione->query("SELECT d_ord FROM serata WHERE id_evento = 1 AND chiusura = 0")->fetch(PDO::FETCH_OBJ);


$tipoA = $_GET['tipoA'];
$numP = $_GET['numero'];
$prodotti = array();
$qua = array();
$prezzi = array();
$idProdotti = array();

for($i=0;$i<$numP;$i++){
    $keyN = "nome".$i;
    $keyQ = "quantita".$i;
    $keyP = "prezzo".$i;
    $keyI = "idP".$i;

    $prodotti[] = $_GET[$keyN];
    $qua[] = $_GET[$keyQ];
    $prezzi[] = $_GET[$keyP];
    $idProdotti[] = $_GET[$keyI];
}

if($tipoA == 0){
    for($i=0;$i<$numP;$i++) {
        if (strcmp($idProdotti[$i], "v") != 0) {
            /*Inserimento prodotti*/
            try {
                $prodotto = $connessione->query("SELECT * FROM prodotto WHERE id_prodotto = $idProdotti[$i]")->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }
            if($prodotto->disp != NULL){
                /*Prodotti con vincoli*/
                try{
                    $connessione->beginTransaction();
                        $DispA = $connessione->query("SELECT (disp - COUNT(id_prodotto)) DispAttuale FROM ordine NATURAL JOIN prodotto WHERE id_prodotto = $idProdotti[$i] AND d_ord = '2016-05-27' GROUP BY(id_prodotto)")->fetch(PDO::FETCH_OBJ);
                        if($DispA->DispAttuale > $qua[$i] ){
                            for ($j=0;$j<$qua[$i];$j++){
                                $ora = date("h:i:s");
                                $connessione->exec("INSERT INTO `ordine` (`id_ordine`, `id_prodotto`, `ora`, `d_ord`, `buono`) VALUES (NULL, '$idProdotti[$i]', '$ora', '$dataS->d_ord', '0')");
                            }
                        }
                        else{
                            echo "1";
                            $connessione=null;
                            exit;
                        }
                    $connessione->commit();
                } catch (PDOException $e){
                    $connessione->rollBack();
                }
            } else {
                /*Prodotti senza vincoli*/
                try{
                    $connessione->beginTransaction();
                    for ($j=0;$j<$qua[$i];$j++){
                        $ora = date("h:i:s");
                        $connessione->exec("INSERT INTO `ordine` (`id_ordine`, `id_prodotto`, `ora`, `d_ord`, `buono`) VALUES (NULL, '$idProdotti[$i]', '$ora', '$dataS->d_ord', '0')");
                    }
                    $connessione->commit();
                } catch (PDOException $e){
                    $connessione->rollBack();
                }
            }
        } else {
            try{
                $connessione->beginTransaction();
                for ($j=0;$j<$qua[$i];$j++){
                    $ora = date("h:i:s");
                    $connessione->exec("INSERT INTO `ordinev` (`id_ordine`, `tipo`, `importo`, `ora`, `d_ord`, `buono`) VALUES (NULL, 'varie', '15', '$ora', '$dataS->d_ord', '0')");
                }
                $connessione->commit();
            } catch (PDOException $e){
                $connessione->rollBack();
            }
        }
    }
} else {
    for($i=0;$i<$numP;$i++) {
        if (strcmp($idProdotti[$i], "v") != 0) {
            /*Inserimento prodotti*/
            try {
                $prodotto = $connessione->query("SELECT * FROM prodotto WHERE id_prodotto = $idProdotti[$i]")->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }
            if($prodotto->disp != NULL){
                /*Prodotti con vincoli*/
                try{
                    $connessione->beginTransaction();
                    $DispA = $connessione->query("SELECT (disp - COUNT(id_prodotto)) DispAttuale FROM ordine NATURAL JOIN prodotto WHERE id_prodotto = $idProdotti[$i] AND d_ord = '2016-05-27' GROUP BY(id_prodotto)")->fetch(PDO::FETCH_OBJ);
                    if($DispA->DispAttuale > $qua[$i] ){
                        for ($j=0;$j<$qua[$i];$j++){
                            $ora = date("h:i:s");
                            $connessione->exec("INSERT INTO `ordine` (`id_ordine`, `id_prodotto`, `ora`, `d_ord`, `buono`) VALUES (NULL, '$idProdotti[$i]', '$ora', '$dataS->d_ord', '1')");
                        }
                    }
                    else{
                        echo "1";
                        $connessione=null;
                        exit;
                    }
                    $connessione->commit();
                } catch (PDOException $e){
                    $connessione->rollBack();
                }
            } else {
                /*Prodotti senza vincoli*/
                try{
                    $connessione->beginTransaction();
                    for ($j=0;$j<$qua[$i];$j++){
                        $ora = date("h:i:s");
                        $connessione->exec("INSERT INTO `ordine` (`id_ordine`, `id_prodotto`, `ora`, `d_ord`, `buono`) VALUES (NULL, '$idProdotti[$i]', '$ora', '$dataS->d_ord', '1')");
                    }
                    $connessione->commit();
                } catch (PDOException $e){
                    $connessione->rollBack();
                }
            }
        } else {
            try{
                $connessione->beginTransaction();
                for ($j=0;$j<$qua[$i];$j++){
                    $ora = date("h:i:s");
                    $connessione->exec("INSERT INTO `ordinev` (`id_ordine`, `tipo`, `importo`, `ora`, `d_ord`, `buono`) VALUES (NULL, 'varie', '15', '$ora', '$dataS->d_ord', '1')");
                }
                $connessione->commit();
            } catch (PDOException $e){
                $connessione->rollBack();
            }
        }
    }
}

echo "0";
$connessione= null;
