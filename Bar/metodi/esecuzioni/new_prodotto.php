<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 28/05/2016
 * Time: 02:06
 */

$nome = filter_input(INPUT_POST, "descrizione", FILTER_SANITIZE_STRING);
$numC = strlen($nome);
$spazi = 13 -$numC;

for($i = 0; $i<$spazi; $i++){
    $nome = $nome . " ";
}
$prezzo = filter_input(INPUT_POST, "prezzo", FILTER_SANITIZE_STRING);
$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
$disponibilita = filter_input(INPUT_POST, "disponibilita", FILTER_SANITIZE_STRING);
$vendita = filter_input(INPUT_POST, "vendita", FILTER_SANITIZE_STRING);

if($vendita != 1){
    $vendita =0;
}

$null = filter_input(INPUT_POST, "nullable", FILTER_SANITIZE_NUMBER_INT);
if($null == 1){
    include "../../../connessione.php";
    $sql = "INSERT INTO `prodotto` (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`) VALUES (NULL, '$nome', '$prezzo', '$categoria', NULL, '$vendita');";
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
    $sql = "INSERT INTO `prodotto` (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`) VALUES (NULL, '$nome', '$prezzo', '$categoria', '$disponibilita', '$vendita');";
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
echo "<script type='text/javascript'>location.href=\"../../Gprodotto.php\"</script>";

