<?php
session_start();
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 13/06/2016
 * Time: 00:31
 */

if(!$_SESSION['login'])
{
    header("Location:../../gestioneUtente.php");
}

require "../../connessione.php";

$nome_utente = $_SESSION['utente'];

$old_password = filter_input(INPUT_POST,'attuale',FILTER_SANITIZE_STRING);
$new_password = filter_input(INPUT_POST,'nuova',FILTER_SANITIZE_STRING);
$repeat_new_password = filter_input(INPUT_POST,'ripeti',FILTER_SANITIZE_STRING);

$estrai_vecchia_password = "SELECT pass FROM staff WHERE"
    . " username='$nome_utente'";

try
{
    $passA = $connessione->query($estrai_vecchia_password)->fetch(PDO::FETCH_OBJ);

} catch (Exception $ex) {
    echo("Err: ".$ex->getMessage());

}


if(password_verify($old_password, $passA->pass))
{
    if(strcmp($new_password,$repeat_new_password)==0)
    {
        $hash_password = password_hash($new_password, PASSWORD_BCRYPT);
        $modifica_password = "UPDATE staff SET pass='$hash_password'"
            . " WHERE pass='$passA->pass' AND username='$nome_utente'";
        try
        {
            $connessione->exec($modifica_password);
        } catch (Exception $ex) {
            echo("Err: ".$ex->getMessage());

        }

    }
    else
    {
        echo("<script type=\"text/javascript\">"
            . "alert(\"Le due password non corrispondono...\");"
            . "</script>");

    }
}
else
{
    echo("<script type=\"text/javascript\">"
        . "alert(\"La vecchia password non corrisponde...\");"
        . "</script>");

}
echo "<script type='text/javascript'>location.href=\"../gestioneUtente.php\"</script>";
/* Nell Hosting netsons.com header refresh non funziona
header("refresh:0.02;url=../gestioneUtente.php");*/