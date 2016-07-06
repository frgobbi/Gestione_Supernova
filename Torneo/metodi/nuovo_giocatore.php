<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 04/06/2016
 * Time: 13:04
 */
    $Knome = "nomeG";
    $Kcognome = "cognomeG";
    $Kdata = "dateG";
    $Kcod = "codG";
    $Kres = "resG";
    $Kres = "resG";
    $Kluogo = "LuogoG";
    $Ksq = "sq";


    $nome = filter_input(INPUT_POST, $Knome, FILTER_SANITIZE_STRING);
    $cognome = filter_input(INPUT_POST, $Kcognome, FILTER_SANITIZE_STRING);
    $data = filter_input(INPUT_POST, $Kdata, FILTER_SANITIZE_STRING);
    $cod = filter_input(INPUT_POST, $Kcod, FILTER_SANITIZE_STRING);
    $cod = strtoupper($cod);
    $res = filter_input(INPUT_POST, $Kres, FILTER_SANITIZE_STRING);
    $Luogo = filter_input(INPUT_POST, $Kluogo, FILTER_SANITIZE_STRING);
    $SQ = filter_input(INPUT_POST, $Ksq, FILTER_SANITIZE_STRING);


    $keyF = "file";
    if ($_FILES[$keyF]['name'] != "") {

        $nomeF = $_FILES[$keyF]['name'];
        $estensione = $_FILES[$keyF]['type'];

        $app = explode("/", $estensione);
        $ex = $app[1];

        $foto = "ImmaginiApp/Giocatori/" . $nome . "_" . $cognome . "." . $ex;
        $tmpNome = $_FILES[$keyF]['tmp_name'];
        move_uploaded_file($tmpNome, "../../" . $foto);

    } else {
        $foto = "ImmaginiApp/Giocatori/profiloG.png";

    }
include "../../connessione.php";
try{
    $sql = "INSERT INTO `giocatore`(`id_g`, `nome`, `cognome`, `d_nascita`, `Luogo_n`, `CodiceFiscale`, `Res`, `foto`, `id_squadra`) "
        ." VALUES (NULL, '$nome', '$cognome', '$data', '$Luogo', '$cod', '$res', '$foto', '$SQ');";

    $connessione->exec($sql);

} catch (PDOException $e){
    //echo "error:".$e->getMessage();
    echo "<script>
    alert('qualcosa &egrave andato storto, per favore riprovare!');
   </script>";
    echo "<script type='text/javascript'>location.href=\"../giocatori.php\"</script>";
}
$connessione = null;
header('Location:../giocatori.php');

