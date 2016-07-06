<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if ($_SESSION['login'] == TRUE) {
    } else {
        echo "<script type='text/javascript'>location.href=\"../.php\"</script>";
    }
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <script type="text/javascript" src="../Librerie/file/bootstrap-filestyle.js"></script>
    <style type="text/css">
        /* Profile container */
        .profile {
            margin: 20px 0;
        }

        /* Profile sidebar */
        .profile-sidebar {
            padding: 20px 0 10px 0;
            background: #fff;
        }

        .profile-userpic img {
            float: none;
            margin: 0 auto;
            width: 50%;
            height: 50%;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }

        .profile-usertitle {
            text-align: center;
            margin-top: 20px;
        }

        .profile-usertitle-name {
            color: #5a7391;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .profile-usertitle-job {
            text-transform: uppercase;
            color: #5b9bd1;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .profile-userbuttons {
            text-align: center;
            margin-top: 10px;
        }

        .profile-userbuttons .btn {
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 15px;
            margin-right: 5px;
        }

        .profile-userbuttons .btn:last-child {
            margin-right: 0px;
        }

        .profile-usermenu {
            margin-top: 30px;
        }

        .profile-usermenu ul li {
            border-bottom: 1px solid #f0f4f7;
        }

        .profile-usermenu ul li:last-child {
            border-bottom: none;
        }

        .profile-usermenu ul li a {
            color: #93a3b5;
            font-size: 14px;
            font-weight: 400;
        }

        .profile-usermenu ul li a i {
            margin-right: 8px;
            font-size: 14px;
        }

        .profile-usermenu ul li a:hover {
            background-color: #fafcfd;
            color: #5b9bd1;
        }

        .profile-usermenu ul li.active {
            border-bottom: none;
        }

        .profile-usermenu ul li.active a {
            color: #5b9bd1;
            background-color: #f6f9fb;
            border-left: 2px solid #5b9bd1;
            margin-left: -2px;
        }

        /* Profile Content */
        .profile-content {
            padding: 20px;
            background: #fff;
            min-height: 460px;
        }
    </style>
</head>

<body>

<div id="wrapper">
    <!-- Navigation -->
    <?php
    require '../ComponentiBase/nav.php';
    navLog($_SERVER['PHP_SELF']);
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Torneo Supernova
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-red">
                        <div class="panel-heading">Dati Utente</div>
                        <div class="panel-body">
                            <?php
                            include ("../connessione.php");
                            $id_utente=$_SESSION['utente'];
                            $query="SELECT * FROM staff NATURAL JOIN evento NATURAL JOIN tipo_staff WHERE username = '$id_utente'";

                            try
                            {
                                $oggettoU = $connessione->query($query)->fetch(PDO::FETCH_OBJ);
                            } catch (Exception $ex) {
                                echo("Err: ".$ex->getMessage());
                            }
                            $connessione=null;

                            echo"<div class=\"row\">";
                                echo"<div class=\"col-xs-12 col-sm-12 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1\">"
                                    ."<img src=\"../$oggettoU->foto\" class=\"img-circle\" alt=\"Cinque Terre\" style='width: 200px; height: 200px;'\">"
                                ."</div>"
                                ."<div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">";

                                    echo("<div class=\"form-group\">");
                                    echo("<label for=\"id_utente\">Nome utente: </label>");
                                    echo("<input type=\"text\" id=\"id_utente\" class=\"form-control\" readonly value=\"$oggettoU->username\"/>");
                                    echo("</div>");
                                    echo("<div class=\"form-group\">");
                                    echo("<label for=\"nome\">Nome: </label>");
                                    echo("<input type=\"text\" id=\"nome\" class=\"form-control\" readonly value=\"$oggettoU->nome\"/>");
                                    echo("</div>");
                                    echo("<div class=\"form-group\">");
                                    echo("<label for=\"cognome\">Cognome: </label>");
                                    echo("<input type=\"text\" id=\"cognome\" class=\"form-control\" readonly value=\"$oggettoU->cognome\"/>");
                                    echo("</div>");
                                echo("</div>");

                                echo("<div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">");
                                echo("<div class=\"form-group\">");
                                echo("<label for=\"id_utente\">e-mail: </label>");
                                echo("<input type=\"text\" id=\"email\" class=\"form-control\" readonly value=\"$oggettoU->email\"/>");
                                echo("</div>");
                                echo("<div class=\"form-group\">");
                                echo("<label for=\"nome\">Tipo staff: </label>");
                                echo("<input type=\"text\" id=\"tipostaff\" class=\"form-control\" readonly value=\"$oggettoU->descrizione\"/>");
                                echo("</div>");
                                echo("<div class=\"form-group\">");
                                echo("<label for=\"cognome\">Evento: </label>");
                                echo("<input type=\"text\" id=\"evento\" class=\"form-control\" readonly value=\"$oggettoU->nome_evento\"/>");
                                echo("</div>");
                                echo("</div>");
                                    ?>

                            </div>
                        </div>
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#mail">Cambio Mail</a>
                                </h4>
                            </div>
                            <div id="mail" class="panel-collapse collapse">
                                <div class="panel-body"><form role="form" method="POST" action="metodi/change_mail.php" enctype="multipart/form-data" id="form">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <?php
                                                echo("<div class=\"form-group\">");
                                                echo("<label for=\"cognome\">Mail attuale: </label>");
                                                echo("<input type=\"text\" id=\"email\" class=\"form-control\" value=\"$oggettoU->email\" readonly/>");
                                                echo("</div>");
                                                echo("<div class=\"form-group\">");
                                                echo("<label for=\"cognome\">Nuova mail: </label>");
                                                echo("<input type=\"text\" name=\"email\" id=\"email\" class=\"form-control\" value=\"$oggettoU->email\" required/>");
                                                echo("</div>");
                                                ?>
                                                <button type="submit" class="btn btn-primary">Cambia indirizzo</button>
                                            </div>
                                        </div>
                                    </form></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#pass">Cambio Password</a>
                                </h4>
                            </div>
                            <div id="pass" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form role="form" method="POST" action="metodi/change_password.php" enctype="multipart/form-data" id="form">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <?php
                                                echo("<div class=\"form-group\">");
                                                echo("<label for=\"attuale\">Password attuale: </label>");
                                                echo("<input type=\"password\" name=\"attuale\" id=\"attuale\" class=\"form-control\"/ >");
                                                echo("</div>");
                                                echo("<div class=\"form-group\">");
                                                echo("<label for=\"nuova\">Nuova Password: </label>");
                                                echo("<input type=\"password\" name=\"nuova\" id=\"nuova\" class=\"form-control\"/ required>");
                                                echo("</div>");
                                                echo("<div class=\"form-group\">");
                                                echo("<label for=\"ripeti\">Ripeti Password: </label>");
                                                echo("<input type=\"password\" name=\"ripeti\" id=\"ripeti\" class=\"form-control\"/ required>");
                                                echo("</div>");
                                                ?>
                                                <button type="submit" class="btn btn-danger">Cambia password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#immagine">Cambio immagine profilo</a>
                                </h4>
                            </div>
                            <div id="immagine" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form role="form" method="POST" action="metodi/change_image.php" enctype="multipart/form-data" id="form">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <input type="file" name="foto_profilo" class="filestyle" data-buttonText="Find file" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Carica immagine</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Heading -->

            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->

<script type="text/javascript">
    $(":file").filestyle({buttonText: "Find file"});
</script>
</body>

</html>

