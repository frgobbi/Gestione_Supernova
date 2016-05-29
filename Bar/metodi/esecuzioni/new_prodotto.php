<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 28/05/2016
 * Time: 02:06
 */

$nome = filter_input(INPUT_POST, "descrizione", FILTER_SANITIZE_STRING);
$prezzo = filter_input(INPUT_POST, "prezzo", FILTER_SANITIZE_STRING);
$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
$disponibilita = filter_input(INPUT_POST, "disponibilita", FILTER_SANITIZE_STRING);
$vendita = filter_input(INPUT_POST, "vendita", FILTER_SANITIZE_STRING);
$button = filter_input(INPUT_POST, "button", FILTER_SANITIZE_STRING);

if($vendita != 1){
    $vendita =0;
}

if($button != 1){
    $button =0;
}

$null = filter_input(INPUT_POST, "nullable", FILTER_SANITIZE_NUMBER_INT);
if($null == 1){
    include "../../../connessione.php";
    $sql = "INSERT INTO `prodotto` (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES (NULL, '$nome', '$prezzo', '$categoria', NULL, '$vendita', '$button');";
    echo("<script>".
        "alert(\"Nuovo Prodotto creato\");".
        "</script>");

    try{
        $connessione->exec($sql);
    } catch (PDOException $e) {
        echo("<script>".
            "alert(\"Qualcosa è andato storto\");".
            "</script>");
    }

} else {
    include "../../../connessione.php";
    $sql = "INSERT INTO `prodotto` (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES (NULL, '$nome', '$prezzo', '$categoria', '$disponibilita', '$vendita', '$button');";
    echo("<script>".
        "alert(\"Nuovo Prodotto creato\");".
        "</script>");


    try{
        $connessione->exec($sql);
    } catch (PDOException $e) {
        echo("<script>".
            "alert(\"Qualcosa è andato storto\");".
            "</script>");
    }


}
$connessione = null;
header('Refresh:1; url=../../Gprodotto.php');

