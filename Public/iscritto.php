<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include '../Librerie/Base/librerie.php';
    LPubbliche();
    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>



    <style type="text/css">
        .jumbotron{
            height: 600px;
        }
    </style>

</head>
<body>
<div id="page">
    <?php
    require '../ComponentiBase/nav.php';
    navUnlogPublic();
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- ----------------------------------------------------------------------------------------------------------------------
             -- Intestazione della pagina -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Supernova 3.0
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-4 col-md-offset-4 col-sm-12 col-xs-12 jumbotron">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
                            <img src="../ImmaginiApp/Loghi/superman_logo.png" class="img-rounded img-responsive" alt="Cinque Terre" width="300" height="300">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                            <h2 class="text-success text-center"> Siete Ufficilmente Iscritti al Torneo Supernova</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                            <h2 class="text-primary text-center">Per info Consulta l'evento su facebook</h2>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" onclick="window.location.href='#'">Evento facebook <i class="fa fa-facebook" aria-hidden="true"></i></button>
                            <br>
                        </div>
                        <div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
                            <button class="btn btn-info btn-lg btn-block" onclick="window.location.href='../index.php'">Home Page</button>
                            <br>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>