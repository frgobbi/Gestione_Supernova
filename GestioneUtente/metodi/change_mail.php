<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 13/06/2016
 * Time: 00:28
 */
session_start();
if(!$_SESSION['login'])
{
    echo "<script type='text/javascript'>location.href=\"../../index.php\"</script>";
}

$nome_utente=$_SESSION['utente'];
$new_email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);


require "../../connessione.php";

$change_email = "UPDATE `staff` SET `email` = '$new_email' WHERE `staff`.`username` = '$nome_utente';";
try
{
    $connessione->exec($change_email);

} catch (Exception $ex) {
    echo("Err: ".$ex->getMessage());

}
echo "<script type='text/javascript'>location.href=\"../gestioneUtente.php\"</script>";
//header("Location:../gestioneUtente.php");