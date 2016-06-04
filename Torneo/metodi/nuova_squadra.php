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
try {
    if ($_FILES['input-file-preview']['tmp_name'] == "") {
        if (strcmp($numero_ref, "") == 0) {
            $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`, `srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
                . " (NULL, '$nome_S', '$nome_ref', '$email_ref', NULL, NULL, '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

        } else {
            $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`,`srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
                . " (NULL, '$nome_S', '$nome_ref', '$email_ref', '$numero_ref', NULL, '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

        }
    } else {

        $nomeF = $_FILES['input-file-preview']['name'];

        $tmpNome = $_FILES['input-file-preview']['tmp_name'];
        move_uploaded_file($tmpNome, "../../ImmaginiApp/Squadre/" . $nomeF);
        $percorso = "ImmaginiApp/Squadre/" . $nomeF;
        if (strcmp($numero_ref, "") == 0) {
            $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`, `srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
                . " (NULL, '$nome_S', '$nome_ref', '$email_ref', NULL, '$percorso' , '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

        } else {
            $sql = "INSERT INTO `squadra` (`id_sq`, `nomeSQ`,`Nome_Ref` , `mail`, `Numero`,`srcF`, `p_vINTe`, `p_perse`, `p_pareggio`, `punti`, `gol_f`, `gol_s`, `id_girone`, `id_evento`, `attiva`) VALUES"
                . " (NULL, '$nome_S', '$nome_ref', '$email_ref', '$numero_ref', '$percorso', '0', '0', '0', '0', '0', '0', NULL, $evento, 1)";

            $connessione->exec($sql);

        }
    }
}catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
$connessione = null;
header('Location:../squadre.php');

