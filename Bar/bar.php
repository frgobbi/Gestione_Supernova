<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        session_start();
        if($_SESSION['login']!=TRUE){
            header("Location:../index.php" );
        }
        
        include '../librerie/Base/librerie.php';
        Ll1();
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php
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
                    <div class="row">
                        <?php
                            //require '../ComponentiBase/sottolink.php';
                            $vet = risorse(1);
                            for($i=0;$i<count($vet);$i++){
                                $percorso = $vet[$i][0];
                                $class = $vet[$i][2];
                                $icona = $vet[$i][3];
                                $nome = $vet[$i][1];
                                echo("<div class=\"col-lg-3 col-md-6\">");
                                echo("<a href=\"../$percorso\">");
                                echo("<div class=\"panel $class\">");
                                echo("<div class=\"panel-heading\">");
                                echo("<div class=\"row\">");
                                echo("<div class=\"col-xs-3\">");
                                echo("<i class=\"fa $icona fa-5x\"></i>");
                                echo("</div>");
                                echo("<div class=\"col-xs-9 text-right\">");
                                echo("<div class=\"huge\">$nome</div>");

                                echo("</div>");
                                echo("</div>");
                                echo("</div>");

                                echo("<div class=\"panel-footer\">");
                                echo("<span class=\"pull-left\"></span>");
                                echo("<span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>");
                                echo("<div class=\"clearfix\"></div>");
                                echo("</div>");

                                echo("</div>");
                                echo("</a>");
                                echo("</div>");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
     </body>
</html>

