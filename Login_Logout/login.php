<?php
session_start();
$_SESSION['login'] = FALSE;
$us = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
$pw = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);

include "../connessione.php";
try {
    $sql = "SELECT * FROM `staff` WHERE username = '$us'";
    foreach ($connessione->query($sql) as $row) {
        if (password_verify($pw, $row['pass'])) {
            $utente = $row['nome'] . " " . $row['cognome'];
            $_SESSION['login'] = TRUE;
            $_SESSION['utente'] = $us;
            $_SESSION['nome'] = $utente;
            $_SESSION['sesso'] = $row['sesso'];
            $_SESSION['tipo'] = $row['id_staff'];
            $_SESSION['id_evento'] = $row['id_evento'];
            $connessione = null;
        }
        $connessione = null;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$connessione = null;

if ($_SESSION['login'] != TRUE) {
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <?php
        session_start();
        include '../Librerie/Base/librerie.php';
        Lesterne();
        ?>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .login {
                margin-top: 27px;
            }

            .set-logo {
                background: #fff;
                color: #ddd;
                border-radius: 500%;
                padding: 11px;
                font-size: 104px;
                border: solid #ddd 14px;
            }

            .logo {
                margin-top: 27px;
                margin-bottom: 54px;
            }

            .last-row {
                margin-bottom: 0px;
            }

            .checklabel {
                font-weight: 100;
            }

            .login {
                margin-top: 27px;
            }

            .set-logo {
                background: #fff;
                color: #ddd;
                border-radius: 500%;
                padding: 15px;
                font-size: 108px;
                border: solid #ddd 14px;
            }

            .logo {
                margin-top: 27px;
                margin-bottom: 54px;
            }

            .form-signin-error {
                color: #d43f3a;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>

    <div id="page">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <a class="navbar-brand" href="../index.php">Supernova 3.0</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <form class="navbar-form navbar-right" id="login" role="form" method="post" action="login.php">
                    <div class="form-group">
                        <input type="text" name="user" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" placeholder="Password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Sign in</button>
                    <button id="badje" class="btn btn-success" type="button"
                            onclick="window.location.href = 'badje.php'">
                        Sign in with Badje
                    </button>
                </form>
            </ul>
        </nav>
        <div id=\"page-wrapper\">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <h1 class=\"page-header\">
                            Torneo Supernova
                            <small> dal 11 luglio al 17 luglio 2016</small>
                        </h1>
                    </div>
                </div>
                <div class="container">
                    <div class="row login">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
                            <form role="form" method="post" action="login.php">
                                <div class="form-group text-center">
                                    <div class="logo">
                                        <span class="glyphicon glyphicon-user set-logo"></span>
                                    </div>
                                </div>
                                <center><h4 class="form-signin-error">* Username o Password errati</h4></center>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control input-lg" id="user" name="user"
                                           placeholder="Username">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control input-lg" id="pass" name="pass"
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-lg btn-block btn-success">Entra
                                    </button>
                                </div>
                            </form>
                        </div>
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
    header('Location:../Home/home.php');
}
?>
