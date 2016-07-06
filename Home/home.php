<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include '../Librerie/Base/librerie.php';
        Ll1();
        ?>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <?php
            if (!$_SESSION['login'])
            {
                echo "<script type='text/javascript'>location.href=\"../index.php\"</script>";
            }
            
            require '../ComponentiBase/nav.php';
            navLog($_SERVER['PHP_SELF']);
            ?>

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
                    <!-- Page Heading -->
                    <div class="row">
                        <?php
                        
                        $tipo = $_SESSION['tipo'];
                        require("../ComponentiBase/TipoStaff.php");

                        scegliStaff($tipo);
                        ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
    </body>

</html>

