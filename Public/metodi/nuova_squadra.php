<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 16/05/2016
 * Time: 14:31
 */
$evento =1;
$nome_ref = filter_input(INPUT_POST, "nomeR", FILTER_SANITIZE_STRING);
$nome_S = filter_input(INPUT_POST, "nomeS", FILTER_SANITIZE_STRING);
$email_ref = filter_input(INPUT_POST, "emailR", FILTER_SANITIZE_STRING);
$numero_ref = filter_input(INPUT_POST, "telR", FILTER_SANITIZE_NUMBER_INT);

include "../../connessione.php";
try{
if($_FILES['input-file-preview']['tmp_name']=="")
{
    if(strcmp($numero_ref, "") == 0){
        $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`, `srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
            ." (NULL, '$nome_S', '$nome_ref', '$email_ref', NULL, NULL, '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

    } else {
        $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`,`srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
            ." (NULL, '$nome_S', '$nome_ref', '$email_ref', '$numero_ref', NULL, '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

    }
} else {

    $nomeF = $_FILES['input-file-preview']['name'];

    $tmpNome = $_FILES['input-file-preview']['tmp_name'];
    move_uploaded_file($tmpNome, "../../ImmaginiApp/Squadre/" . $nomeF);
    $percorso = "ImmaginiApp/Squadre/" . $nomeF;
    if(strcmp($numero_ref, "") == 0){
        $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`, `srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
            ." (NULL, '$nome_S', '$nome_ref', '$email_ref', NULL, '$percorso' , '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

    } else {
        $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`,`srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
            ." (NULL, '$nome_S', '$nome_ref', '$email_ref', '$numero_ref', '$percorso', '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

    }
}


$sql = "SELECT * FROM squadra WHERE nomeSQ = '$nome_S'";

    foreach($connessione->query($sql) as $row){
        $id_SQ = $row['id_sq'];
    }


$numero_G = filter_input(INPUT_POST, "Nsquadra", FILTER_SANITIZE_NUMBER_INT);

for($i=0;$i<$numero_G;$i++){
    $Knome = "nomeG".$i;
    $Kcognome = "cognomeG".$i;
    $Kdata = "dateG".$i;
    $Kcod = "codG".$i;
    $Kres = "resG".$i;
    $Kres = "resG".$i;
    $Kluogo = "LuogoG".$i;


    $nome = filter_input(INPUT_POST, $Knome, FILTER_SANITIZE_STRING);
    $cognome = filter_input(INPUT_POST, $Kcognome, FILTER_SANITIZE_STRING);
    $data = filter_input(INPUT_POST, $Kdata, FILTER_SANITIZE_STRING);
    $cod = filter_input(INPUT_POST, $Kcod, FILTER_SANITIZE_STRING);
    $cod = strtoupper($cod);
    $res = filter_input(INPUT_POST, $Kres, FILTER_SANITIZE_STRING);
    $Luogo = filter_input(INPUT_POST, $Kluogo, FILTER_SANITIZE_STRING);

    $keyF = "file".$i;
    if ($_FILES[$keyF]['name'] != "") {

        $nomeF = $_FILES[$keyF]['name'];
        $estensione = $_FILES[$keyF]['type'];

        $app = explode("/", $estensione);
        $ex = $app[1];

        $foto = "immaginiApp/Giocatori/" . $nome . "_" . $cognome . "." . $ex;
        $tmpNome = $_FILES[$keyF]['tmp_name'];
        move_uploaded_file($tmpNome, "../../" . $foto);

    } else {
        $foto = "immaginiApp/Giocatori/profiloU.jpg";

    }
    $sql = "INSERT INTO `giocatore`(`id_g`, `nome`, `cognome`, `d_nascita`, `Luogo_n`, `CodiceFiscale`, `Res`, `foto`, `gol`, `c_gialli`, `c_rossi`, `id_squadra`) "
        ." VALUES (NULL, '$nome', '$cognome', '$data', '$Luogo', '$cod', '$res', '$foto', '0', '0', '0', '$id_SQ');";

        $connessione->exec($sql);

}
} catch (PDOException $e){
    echo "error:".$e->getMessage();
    echo "<script>
    alert('qualcosa è andato storto, per favore riprovare!');
   </script>";
    header('Refresh:0,5; url=../Iscrizione.php');
}
$connessione = null;
header('Location:../iscritto.php');

