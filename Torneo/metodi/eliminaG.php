<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 14/06/2016
 * Time: 02:26
 */
include "../../connessione.php";
try {
    $connessione->exec("UPDATE `squadra` SET `id_girone` = NULL");
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
$connessione = null;
echo "<script type='text/javascript'>location.href=\"../Gironi.php\"</script>";
