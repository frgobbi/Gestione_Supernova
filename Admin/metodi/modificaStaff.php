<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 11/06/2016
 * Time: 15:08
 */
$usernameStaff = $_GET['user'];
//echo $usernameStaff;

/*chiavi input*/

$keyN = "nome" . $usernameStaff;
$keyC = "cognome" . $usernameStaff;
$keyD = "date" . $usernameStaff;
$keyE = "email" . $usernameStaff;
$keyU = "user" . $usernameStaff;
$keyP = "pass" . $usernameStaff;
$keyS = "sessoS" . $usernameStaff;
$keyT = "tipo" . $usernameStaff;
$keyEv = "evento" . $usernameStaff;
/*Chiave file*/
$keyI = "img" . $usernameStaff;

$nome = filter_input(INPUT_POST, $keyN, FILTER_SANITIZE_STRING);
$cognome = filter_input(INPUT_POST, $keyC, FILTER_SANITIZE_STRING);
$data = filter_input(INPUT_POST, $keyD, FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, $keyE, FILTER_SANITIZE_STRING);
$usernameS = filter_input(INPUT_POST, $keyU, FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, $keyP, FILTER_SANITIZE_STRING);
$sesso = filter_input(INPUT_POST, $keyS, FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, $keyT, FILTER_SANITIZE_STRING);
$evento = filter_input(INPUT_POST, $keyEv, FILTER_SANITIZE_STRING);


include "../../connessione.php";
try {
    $connessione->exec("UPDATE `staff` SET `nome` = '$nome' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `cognome` = '$cognome' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `data_nascita` = '$data' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `email` = '$email' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `username` = '$usernameS' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `sesso` = '$sesso' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `id_evento` = '$evento' WHERE `staff`.`username` = '$usernameStaff';");
    $connessione->exec("UPDATE `staff` SET `id_staff` = '$tipo' WHERE `staff`.`username` = '$usernameStaff';");
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
/*CAMBIO PASSWORD*/
if (strcmp($pass, "") != 0) {
    $hash_password = password_hash($pass, PASSWORD_BCRYPT);

    try {
        $connessione->exec("UPDATE `staff` SET `pass` = '$hash_password' WHERE `staff`.`username` = '$usernameStaff';");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}

//CAMBIO FOTO
if(isset($_FILES[$keyI]) && $_FILES[$keyI]['size']) {
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

    $nomeF = $_FILES[$keyI]['name'];
    $estensione = $_FILES[$keyI]['type'];

    $app = explode("/", $estensione);
    $ex = $app[1];


    //$nomeF =$matricola.".".$estensione;
    $foto = "ImmaginiApp/Profilo/" . $utente->nome . "_" . $utente->cognome . "." . $ex;
    $tmpNome = $_FILES[$keyI]['tmp_name'];
    move_uploaded_file($tmpNome, "../../" . $foto);

    try {
        $connessione->exec("UPDATE `staff` SET `foto` = '$foto' WHERE `staff`.`username` = '$usernameStaff';");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}


$connessione = null;


echo "<script type='text/javascript'>location.href=\"../Staff.php\"</script>";

