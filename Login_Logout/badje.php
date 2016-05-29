<!DOCTYPE html>
<html lang="it">

    <head>
        <?php
        include '../Librerie/Base/librerie.php';
        Ll1();
        ?>
        
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
        </style>
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
                            <input type="text"  name="user"placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                        <button id="badje" class="btn btn-success" type="button" onclick="window.location.href = 'badje.php'"> Sign in with Badje </button>
                    </form>        
                </ul>
            </nav>

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

                    <div class="container">
                        <div class="row login">
                            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
                                <form role="form" method="post" action="metodi/logB.php">
                                    <div class="form-group text-center">
                                        <div class="logo">
                                            <span class="glyphicon glyphicon-user set-logo"></span>
                                        </div>
                                    </div>
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

                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <footer>
            <p>&copy; Company 2015</p>
        </footer>
    </body>

</html>

