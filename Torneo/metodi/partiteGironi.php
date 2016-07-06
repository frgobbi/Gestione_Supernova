<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 16/06/2016
 * Time: 01:10
 */
session_start();
$id_evento = $_SESSION['id_evento'];
$controllo = 0;
$SQ = array();
include "../../connessione.php";
try {
    foreach ($connessione->query("SELECT * FROM squadra WHERE id_evento = $id_evento") as $row) {
        if ($row['id_girone'] == NULL) {
            $controllo = 1;
        }
    }
} catch (PDOException $e) {
    echo "error:" . $e->getMessage();
}
if ($controllo == 1) {
    echo "<script type='text/javascript'>"
        . "alert(\"Prima Assegna i gironi\");"
        . "document.location.href=\"../Partite.php\";"
        . "</script>";
}
try {
    foreach ($connessione->query("SELECT id_girone FROM `squadra` WHERE id_evento = '$id_evento' GROUP BY (id_girone)") as $row) {
        //Recupero Squadre per girone
        $girone = $row['id_girone'];
        $sql= "SELECT * FROM `squadra` NATURAL JOIN girone WHERE id_girone = $girone AND id_evento = '$id_evento'";
        foreach ($connessione->query($sql) as $riga) {
            $SQ[] = array($riga['id_sq']);
        }

        for ($i = 0; $i < (count($SQ)-1); $i++) {
            $squadra1 = $SQ[$i][0];
            for ($j = ($i+1); $j <count($SQ); $j++) {
                $squadra2 = $SQ[$j][0];
                $connessione->exec("INSERT INTO `partita` (`id_partita`, `giorno`, `ora`, `finish`, `fase_finale`) VALUES (NULL, NOW(), NOW(), '0', '0')");
                $partita = $connessione->query("SELECT * FROM `partita` ORDER BY(id_partita) DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
                $connessione->exec("INSERT INTO `sq_partita` (`id`, `id_sq`, `id_p`, `esito`) VALUES (NULL, '$squadra1', '$partita->id_partita', '0')");
                $connessione->exec("INSERT INTO `sq_partita` (`id`, `id_sq`, `id_p`, `esito`) VALUES (NULL, '$squadra2', '$partita->id_partita', '0')");
            }
        }
        $SQ = array();
    }
} catch (PDOException $e) {
    echo "error:" . $e->getMessage();
}

$connessione = null;
header("Location:../Partite.php");
