<?php session_start();
$_SESSION['login'] = FALSE;
$cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_STRING);
$cod = strtoupper($cod);
include "../../connessione.php";
try {
    $sql = "SELECT * FROM `staff` WHERE `cod` = '$cod' ";
    foreach ($connessione->query($sql) as $row) {
        //if (($row['username'] == $us) && ($row['password'] == $pw)) {
        $utente = $row['nome'] . " " . $row['cognome'];
        $_SESSION['login'] = TRUE;
        $_SESSION['utente'] = $row['username'];
        $_SESSION['nome'] = $utente;
        $_SESSION['sesso'] = $row['sesso'];
        $_SESSION['tipo'] = $row['id_staff'];
        $_SESSION['id_evento'] = $row['id_evento'];
        $connessione = null;
    }
    $connessione = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$connessione = null;

if ($_SESSION['login'] != TRUE) {
?>
</html>
<!DOCTYPE html>
<html lang="it">
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" type="image/x-icon" href="../../ImmaginiApp/Loghi/favicon.ico">
<title>Torneo Supernova</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link href="../../Librerie/CSS/sb-admin.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    #page-wrapper{
        height: 800px;
    }
    footer{
        padding: 0;
        background-color: #fff;
    }

    .carousel-inner > .item > img,
    .carousel-inner > .item > img{
        width: 70%;
        margin: auto;
    }
    .login {
        margin-top:27px;
    }
    .set-logo {
        background:#fff;
        color:#ddd;
        border-radius:500%;
        padding:11px;
        font-size:104px;
        border: solid #ddd 14px;
    }
    .logo {
        margin-top:27px;
        margin-bottom:54px;
    }

    .last-row {
        margin-bottom:0px;
    }

    .checklabel {
        font-weight:100;
    }
    .login {
        margin-top:27px;
    }
    .set-logo {
        background:#fff;
        color:#ddd;
        border-radius:500%;
        padding:15px;
        font-size:108px;
        border: solid #ddd 14px;
    }
    .logo {
        margin-top:27px;
        margin-bottom:54px;
    }

    .last-row {
        margin-bottom:0px;
    }

    .checklabel {
        font-weight:100;
    }
    .form-signin-heading
    {
        margin-bottom: 10px;
    }
    .form-signin-error
    {
        margin-bottom: 10px;
        color: red;
    }
</style>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<div id="page">

    <script>
    alert("Codice Errato!!!!!")
    </script>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">

                <a class="navbar-brand" href="../../index.php">Torneo Supernova</a>
            </div>
            <ul class="nav navbar-right top-nav">

                <form class="navbar-form navbar-right" id="login" role="form" method="post" action="../login.php">
                    <div class="form-group">
                        <input type="text"  name="user"placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" placeholder="Password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Sign in</button>
                    <button id="badje" class="btn btn-success" type="button" onclick="window.location.href = '../badge.php'"> Sign in with Badje </button>
                </form>
            </ul>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Supernova 3.0
                            <small>dal 11 luglio al 17 luglio 2016</small>
                        </h1>
                    </div>
                </div>

                <div class="container">
                    <div class="row login">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
                            <form role="form" method="post" action="logB.php">
                                <div class="form-group text-center">
                                    <div class="logo">
                                        <span class="glyphicon glyphicon-flash set-logo"></span>
                                    </div>
                                </div>
                                <center><h4 class="form-signin-error">*Codice Staff errato</h4></center>
                                <center><h3 class="form-signin-heading">Passa il badje o inserisci il tuo codice</h3></center>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                    <input type="password" class="form-control input-lg" id="cod" name="cod" placeholder="Username" autofocus>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-lg btn-block btn-success">Entra</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>&copy; Company 2015</p>
        </footer>
</body>
</html>
        <?php
    } else {
        header('Location:../../Home/home.php');
    }
?>

