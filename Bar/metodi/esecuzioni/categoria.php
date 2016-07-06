<?php

$nome = $_POST['nome'];
$nome = strtoupper($nome);
$color = $_POST['colore'];
$_POST['nome_categoria'] = "";
$_POST['color'] = "";
include '../../../connessione.php';
try{
    $sql="INSERT INTO `categoria` (`id_cat`, `tipo_cat`, `colore`) VALUES (NULL, '$nome', '$color');";
    $connessione->exec($sql);
    echo("<script>".
         "alert(\"Nuova categira di prodotto Creata\");".
         "</script>");
    echo "<script type='text/javascript'>location.href=\"../../Gprodotto.php\"</script>";
} catch (PDOException $e) {
    echo("error: ".$e->getMessage());
}
