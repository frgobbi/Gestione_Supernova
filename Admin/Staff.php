<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        session_start();
        include '../librerie/Base/librerie.php';
        Ll1();
        ?>
        <script src="java-script/metodi.js" type="text/javas">
            <script type="text/javascript">cript"></script>
        <link rel="stylesheet" href="css/cssStaff.css">
        <script type="text/javascript">
            // CLEARABLE INPUT
            function tog(v) {
                return v ? 'addClass' : 'removeClass';
            }
            $(document).on('input', '.clearable', function () {
                $(this)[tog(this.value)]('x');
            }).on('mousemove', '.x', function (e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
            }).on('touchstart click', '.onX', function (ev) {
                ev.preventDefault();
                $(this).removeClass('x onX').val('').change();
            });

// $('.clearable').trigger("input");
// Uncomment the line above if you pre-fill values from LS or server
        </script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php
            if ($_SESSION['login'] == TRUE) {
                
            } else {
                header("Location:../index.php");
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
                        <div class="col-md-12">
                            <div class="row" id="base">

                                <div class="col-md-2 col-md-offset-1">
                                    <button type="button" href="#" class="btn btn-lg btn-danger">Cancella Selezione</button>
                                </div>
                                <div class="col-md-4 col-md-offset-5">
                                    <!-- barra laterale -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <div class="panel panel-default contSTAFF">

                                <div class="panel-heading c-list">
                                    <span class="title">STAFF SUPERNOVA</span>
                                </div>
                                <ul class="list-group" id="contact-list">

                                    <?php
                                    $sql = "SELECT * FROM staff NATURAL JOIN tipo_staff NATURAL JOIN evento WHERE 1";
                                    include '../connessione.php';

                                    try {
                                        foreach ($connessione->query($sql) as $row) {

                                            echo("<li id=\"" . $row['username'] . "\" class=\"list-group-item\">");
                                            echo("<div class=\"col-xs-12 col-md-1\">");
                                            echo("<br><br><br><br>");
                                            echo("<div class=\"btn-group\" data-toggle=\"buttons\">");
                                            echo("<label class=\"btn btn-default\">");
                                            echo("<input nema=\"S" . $row['username'] . "\" type=\"checkbox\" autocomplete=\"off\">");
                                            echo("<span class=\"glyphicon glyphicon-ok\"></span>");
                                            echo("</label>");
                                            echo("</div>");
                                            echo("</div>");
                                            echo("<div class=\"col-xs-12 col-md-3\">");
                                            echo("<img src=\"../" . $row['foto'] . "\" alt=\"" . $row['nome'] . " " . $row['cognome'] . "\" class=\"img-responsive img-thumbnail img-circle\" />");
                                            echo("</div>");
                                            echo("<div class=\"col-xs-12 col-md-8\">");
                                            echo("<span class=\"name\">" . $row['nome'] . " " . $row['cognome'] . "</span><br/>");
                                            echo("<div class=\"row\">");
                                            echo("<div class=\"col-md-7\">");
                                            echo("<span class=\"testo grassetto\">Data: </span>&nbsp<span class=\"testo\">" . $row['data_nascita'] . "</span><br>");
                                            echo("<span class=\"testo grassetto\">Sesso: </span>&nbsp<span class=\"testo\">" . $row['sesso'] . "</span>&nbsp<br>");
                                            echo("<span class=\"testo grassetto\">User: </span>&nbsp<span class=\"testo\">" . $row['username'] . "</span>&nbsp<br>");
                                            echo("<span class=\"testo grassetto\">email: </span>&nbsp<span class=\"testo\">" . $row['email'] . "</span>&nbsp<br>");
                                            echo("</div>");
                                            echo("<div class=\" col-xs-12 col-md-1 col-md-offset-2 button\">");
                                            echo("<button type=\"button\" href=\"#\" class=\"btn btn-md btn-danger\"><i class=\"fa fa-trash\"></i></button>");
                                            echo("<button type=\"button\" href=\"#\" class=\"btn btn-md btn-success\"><i class=\"fa fa-pencil\"></i></button>");
                                            echo("</div>");
                                            echo("</div>");

                                            //echo("<span  class=\"testo grassetto\">Password: </span>&nbsp<span class=\"testo\">" . $row['pass'] . "</span>&nbsp<br>");

                                            echo("</div>");
                                            echo("<div class=\"clearfix\"></div>");
                                            echo("</li>");
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading c-list">
                                            <span class="title">New Staff with Excell</span>
                                        </div>

                                        <div class="row" style="display: none;">
                                            <div class="col-xs-12">
                                                
                                            </div>
                                        </div>

                                        <ul class="list-group" id="contact-list">
                                            <li class="list-group-item">
                                                <form role="form" action="metodi/newStaffExcell.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <a href="../File/nuovi_iscritti.xlsx"> Dowload file base </a><br>
                                                        
                                                        <input type="file" class="form-control" id="file" name="file">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </form>

                                        </ul>
                                    </div>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading c-list">
                                            <span class="title">New Staff</span>
                                        </div>
                                        <ul class="list-group formI" id="contact-list">
                                            <li class="list-group-item">
                                                <form role="form" method="post" action="metodi/IscrizioneStaff.php" enctype="multipart/form-data" id="form">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <div class="form-group">
                                                                <label for="nome">Nome:</label> <input placeholder="Nome" type="text" class="form-control" id="name" name="nome" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cognome">Cognome:</label> <input placeholder="Cognome" type="text" class="form-control" id="cognome" name="cognome" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">E-mail:</label> <input placeholder="e-mail" type="email" class="form-control" id="email" name="email" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="user">Username:</label> <input placeholder="username" type="text" class="form-control" id="user" name="user" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pass">Password:</label> <input placeholder="password" type="password" class="form-control" id="pass" name="pass" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sesso:</label><br />
                                                        &nbsp; Maschio &nbsp;&nbsp;&nbsp; <input type="radio" name="sesso" value="maschio" /><br />
                                                        &nbsp; Femmina &nbsp; <input type="radio" name="sesso" value="femmina" /><br />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Foto del Profilo:</label> 
                                                        <input type="file" id="img" name="img" />
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-xs-8">
                                                            <select name="tipo" class="form-control">
                                                                <option>Scegli tipo staff...</option>
                                                                <?php
                                                                include "../connessione.php";
                                                                try {
                                                                    foreach ($connessione->query("SELECT * FROM tipo_staff WHERE 1") as $row) {
                                                                        echo("<option value=\"" . $row['id_staff'] . "\">" . $row['descrizione'] . "</option>");
                                                                    }
                                                                } catch (PDOException $e) {
                                                                    echo "Error: " . $e->getMessage();
                                                                }
                                                                $connessione = null;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br/><br/>
                                                    <div class="form-group">
                                                        <div class="col-xs-8">
                                                            <select name="Sevento" class="form-control">
                                                                <option>Scegli evento...</option>
                                                                <?php
                                                                include "../connessione.php";
                                                                try {
                                                                    foreach ($connessione->query("SELECT * FROM evento WHERE 1") as $row) {
                                                                        echo("<option value=\"" . $row['id_evento'] . "\">" . $row['nome_evento'] . "</option>");
                                                                    }
                                                                } catch (PDOException $e) {
                                                                    echo "Error: " . $e->getMessage();
                                                                }
                                                                $connessione = null;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/>
                                                    <button type="submit" class="btn btn-primary">Iscrivi</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

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
    </body>
</html>