<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../connessione.php";

$sql = "CREATE TABLE cartella ("
        . " id_cartella INT PRIMARY KEY AUTO_INCREMENT,"
        . " nome_cartella VARCHAR(255),"
        . " colore TEXT "
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella cartella: ".$ex->getMessage());
}

$sql = "CREATE TABLE categoria ("
        . " id_cat INT PRIMARY KEY AUTO_INCREMENT,"
        . " tipo_cat VARCHAR(255),"
        . " colore VARCHAR(255)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella categoria: ".$ex->getMessage());
}

$sql = "CREATE TABLE evento ("
        . " id_evento INT PRIMARY KEY AUTO_INCREMENT,"
        . " nome_evento VARCHAR(255)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella evento: ".$ex->getMessage());
}

$sql = "CREATE TABLE foto ("
        . " id_immagine INT PRIMARY KEY AUTO_INCREMENT,"
        . " nome_immagine VARCHAR(255),"
        . " percorso TEXT, id_cartella INT,"
        . " FOREIGN KEY (id_cartella) REFERENCES cartella(id_cartella)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella foto: ".$ex->getMessage());
}

$sql = "CREATE TABLE funzione ( "
        . "id_funzione INT PRIMARY KEY AUTO_INCREMENT,"
        . " nome_funzione VARCHAR(255),"
        . " descrizione VARCHAR(255),"
        . " color TEXT,"
        . " icona TEXT,"
        . " src TEXT"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella funzione: ".$ex->getMessage());
}

$sql = "CREATE TABLE tipo_staff ( "
        . "id_staff INT PRIMARY KEY AUTO_INCREMENT,"
        . "descrizione VARCHAR(255)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella tipo_staff: ".$ex->getMessage());
}

$sql = "CREATE TABLE girone ("
        . " id_girone INT PRIMARY KEY AUTO_INCREMENT,"
        . " nome_g VARCHAR(255)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella girone: ".$ex->getMessage());
}

$sql = "CREATE TABLE staff ( "
        . "nome VARCHAR(255), "
        . "cognome VARCHAR(255), "
        . "data_nascita date, "
        . "email VARCHAR(255), "
        . "username VARCHAR(255) PRIMARY KEY, "
        . "pass VARCHAR(255), "
        . "sesso VARCHAR(255), "
        . "foto TEXT,  cod VARCHAR(7), "
        . "id_evento INT, "
        . "FOREIGN KEY (id_evento) REFERENCES evento(id_evento), "
        . "id_staff INT, "
        . "FOREIGN KEY (id_staff) REFERENCES tipo_staff (id_staff)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella staff: ".$ex->getMessage());
}

$sql = "CREATE TABLE funzioni_staff ( "
        . "id_staff INT, "
        . "FOREIGN KEY (id_staff) REFERENCES tipo_staff(id_staff),"
        . " id_funzione INT, "
        . "FOREIGN KEY (id_funzione) REFERENCES funzione(id_funzione)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella funzioni_staff: ".$ex->getMessage());
}

$sql = "CREATE TABLE squadra ( id_sq INT PRIMARY KEY AUTO_INCREMENT, "
        . "nomeSQ VARCHAR(255) NOT NULL, "
        . "Nome_Ref VARCHAR(255) NOT NULL,"
        . "mail VARCHAR(255) NOT NULL, "
        . "Numero VARCHAR(20), "
        . "`srcF` TEXT NULL, "
        . "p_vINTe INT NOT NULL DEFAULT '0',"
        . " p_perse INT NOT NULL DEFAULT '0', "
        . "p_pareggio INT NOT NULL DEFAULT '0', "
        . "punti INT NOT NULL DEFAULT '0', "
        . "gol_f INT NOT NULL DEFAULT '0', "
        . "gol_s INT NOT NULL DEFAULT '0', "
        . "id_girone INT DEFAULT NULL, "
        . "FOREIGN KEY (id_girone) REFERENCES girone(id_girone), "
        . "id_evento INT, "
        . "FOREIGN KEY (id_evento) REFERENCES evento(id_evento), "
        . "attiva tinyint(1)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella squdra: ".$ex->getMessage());
}

$sql = "CREATE TABLE giocatore ( id_g INT PRIMARY KEY AUTO_INCREMENT, "
        . "nome VARCHAR(255) NOT NULL, "
        . "cognome VARCHAR(255) NOT NULL, "
        . "d_nascita date NOT NULL, "
        . "foto TEXT,"
        . "gol INT NOT NULL DEFAULT '0', "
        . "c_gialli INT NOT NULL DEFAULT '0', "
        . "c_rossi INT NOT NULL DEFAULT '0', "
        . "id_squadra INT, "
        . "FOREIGN KEY (id_squadra) REFERENCES squadra(id_sq)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella giocatore: ".$ex->getMessage());
}

$sql = "CREATE TABLE prodotto ( id_prodotto INT PRIMARY KEY AUTO_INCREMENT, "
        . "nome_p VARCHAR(255), "
        . "prezzo double(6,2), "
        . "id_cat INT, "
        . "disp INT DEFAULT NULL, "
        . "vendita tinyint(1) NOT NULL DEFAULT '1', "
        . "button tinyint(1) NOT NULL"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella prodotto: ".$ex->getMessage());
}

$sql = "CREATE TABLE serata ( d_ord date ,"
        . " id_evento INT,"
        . " FOREIGN KEY (id_evento) REFERENCES evento(id_evento),"
        . " incasso double(6,2) NOT NULL DEFAULT '0',"
        . " chiusura tinyint(1) NOT NULL DEFAULT '0' ,"
        . " n_ordini INT NOT NULL DEFAULT '0',"
        . " PRIMARY KEY (d_ord, id_evento)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella serata: ".$ex->getMessage());
}

$sql = "CREATE TABLE ordine ( id_ordine INT PRIMARY KEY AUTO_INCREMENT,"
        . "id_prodotto INT, "
        . "FOREIGN KEY (id_prodotto) REFERENCES prodotto(id_prodotto),"
        . "ora time, d_ord date, "
        . "FOREIGN KEY (d_ord) REFERENCES serata(d_ord)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella ordine: ".$ex->getMessage());
}

$sql = "CREATE TABLE ordinev ( "
        . "id_ordine INT PRIMARY KEY AUTO_INCREMENT, "
        . "tipo VARCHAR(255) NOT NULL DEFAULT 'varie', "
        . "ora time, "
        . "d_ord date, "
        . "FOREIGN KEY (d_ord) REFERENCES serata(d_ord)"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella ordinev: ".$ex->getMessage());
}

$sql = "CREATE TABLE partita ( "
        . "id_partita INT PRIMARY KEY AUTO_INCREMENT,"
        . " giorno date DEFAULT NULL,"
        . " ora time DEFAULT NULL,"
        . " finish tinyint(1) DEFAULT '0'"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella partita: ".$ex->getMessage());
}

$sql = "CREATE TABLE sq_partita ( id INT PRIMARY KEY AUTO_INCREMENT, "
        . "id_sq INT, "
        . "FOREIGN KEY (id_sq) REFERENCES squadra(id_sq), "
        . "id_p INT, "
        . "FOREIGN KEY (id_p) REFERENCES partita(id_partita), "
        . "gol INT NOT NULL DEFAULT '0'"
        . ")";
try{
    $connessione->exec($sql);
} catch (Exception $ex) {
    echo("tabella sq_partita: ".$ex->getMessage());
}

$connessione = null;
