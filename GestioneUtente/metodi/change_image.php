<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 13/06/2016
 * Time: 00:41
 */
session_start();
$usernameStaff = $_SESSION['utente'];
include "../../connessione.php";
if(isset($_FILES['foto_profilo']) && $_FILES['foto_profilo']['size']) {
    try {
        $utente = $connessione->query("SELECT * FROM staff WHERE username = '$usernameStaff'")->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
    //$nomeFoto = $utente->nome."_".$utente->cognome;

    $fotoEsistente = explode("/",$utente->foto);
    if(strcmp($fotoEsistente[(count($fotoEsistente)-1)],"profiloU.jpg") !=0){
        if (is_file("../../".$utente->foto)) {
            unlink("../../".$utente->foto);
        }
    }

    $nomeF = $_FILES['foto_profilo']['name'];
    $estensione = $_FILES['foto_profilo']['type'];

    $app = explode("/", $estensione);
    $ex = $app[1];


    //$nomeF =$matricola.".".$estensione;
    $foto = "ImmaginiApp/Profilo/" . $utente->nome . "_" . $utente->cognome . "." . $ex;
    $tmpNome = $_FILES['foto_profilo']['tmp_name'];
    move_uploaded_file($tmpNome, "../../" . $foto);

    try {
        $connessione->exec("UPDATE `staff` SET `foto` = '$foto' WHERE `staff`.`username` = '$usernameStaff';");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}


$connessione = null;


echo "<script type='text/javascript'>location.href=\"../gestioneUtente.php\"</script>";