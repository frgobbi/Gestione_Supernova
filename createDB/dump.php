<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../connessione.php";

$sql = "INSERT INTO categoria (id_cat, tipo_cat, colore) VALUES"
        . "(1, 'Bibite', 'success'),"
        . "(2, 'Gelati', 'info')";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump categoria: ".$ex->getMessage());
}

$sql = "INSERT INTO `evento` (`id_evento`, `nome_evento`) VALUES"
        . "(1, 'Torneo Supernova 2016')";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump evento: ".$ex->getMessage());
}

$sql = "INSERT INTO `funzione` (`id_funzione`, `nome_funzione`, `descrizione`, `color`, `icona`, `src`) VALUES "
        . "(1, 'Bar', ' food management', 'panel-yellow', 'fa-shopping-cart', 'Bar/bar.php'),"
        . "(2, 'Torneo', ' tournament management', 'panel-green', 'fa fa-futbol-o', 'Torneo/torneo.php'),"
        . "(3, 'Foto', ' photo management', 'panel-info', 'fa fa-camera', 'Foto/foto.php'),"
        . "(4, 'Admin', ' administrator', 'panel-red', 'fa fa-lock', 'Admin/admin.php')";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump funzione: ".$ex->getMessage());
}

$sql = "INSERT INTO `tipo_staff` (`id_staff`, `descrizione`) VALUES"
        . "(1, 'admin'),"
        . "(2, 'bar'),(3, 'torneo'),"
        . "(4, 'foto'),"
        . "(5, 'bar+torneo'),"
        . "(6, 'bar+foto'),"
        . "(7, 'torneo+foto'),"
        . "(8, 'bar+torneo+foto')";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump tipo_staff: ".$ex->getMessage());
}

$sql = "INSERT INTO `funzioni_staff` (`id_staff`, `id_funzione`) VALUES (1, 1),"
        . "(1, 2),"
        . "(1, 3),"
        . "(1, 4),"
        . "(2, 1),"
        . "(3, 2),"
        . "(4, 3),"
        . "(5, 1),"
        . "(5, 2),"
        . "(6, 1),"
        . "(6, 3),"
        . "(7, 2),"
        . "(7, 3),"
        . "(8, 1),"
        . "(8, 2),"
        . "(8, 3)";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump funzioni_staff: ".$ex->getMessage());
}

$sql = "INSERT INTO prodotto (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES "
        . "(1, 'Coca-cola', 1.50, 1, 1500, 1, 1)";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump prodotto: ".$ex->getMessage());
}

$sql = "INSERT INTO `funzioni_staff` (`id_staff`, `id_funzione`) VALUES (1, 1),"
        . "(1, 2),"
        . "(1, 3),"
        . "(1, 4),"
        . "(2, 1),"
        . "(3, 2),"
        . "(4, 3),"
        . "(5, 1),"
        . "(5, 2),"
        . "(6, 1),"
        . "(6, 3),"
        . "(7, 2),"
        . "(7, 3),"
        . "(8, 1),"
        . "(8, 2),"
        . "(8, 3)";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump funzioni_staff: ".$ex->getMessage());
}
/*
$sql = "INSERT INTO prodotto (`id_prodotto`, `nome_p`, `prezzo`, `id_cat`, `disp`, `vendita`, `button`) VALUES "
        . "(1, 'Coca-cola', 1.50, 1, 1500, 1, 1)";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump prodotto: ".$ex->getMessage());
}
$sql = "INSERT INTO `staff` (`nome`, `cognome`, `data_nascita`, `email`, `username`, `pass`, `sesso`, `foto`, `cod`, `id_evento`, `id_staff`) VALUES
('David', 'Dormentoni', '1999-06-04', 'rfghjk', 'dormentoni.david', 'ciaomondo', 'maschio', 'immagini/imgStaff/profiloU.jpg', 'DD576CS', 1, 5),
('francesco', 'gobbi', '1997-06-03', 'gobbi97@live.it', 'gobbi-francesco', '$2y$10$tupzUj9x7VQV04H6J3WfhO.NnWRN3h/h3EP8ACm0xoG15dpHqsXXy', 'maschio', 'immaginiApp/Profilo/profiloU.jpg', 'FG5387H', 3, 1),
('Francesco', 'Gobbi', '1997-06-03', 'gobbi03.fg@gmail.com', 'gobbi.francesco', '$2y$10$tupzUj9x7VQV04H6J3WfhO.NnWRN3h/h3EP8ACm0xoG15dpHqsXXy', 'maschio', 'immaginiApp/Profilo/\\francescogobbi.jpg', '0', 1, 1),
('Erica', 'Stefanelli', '1999-04-03', 'ericastefanelli@libero.it', 'stefanelli.erica', 'ericastefanelli.03', 'femmina', 'immagini/imgStaff/profiloD.jpg', '00001', 1, 6)";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("dump staff: ".$ex->getMessage());
}*/
$connessione = null;


