<?php
session_start();
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 04/06/2016
 * Time: 12:19
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    <script src="Javascript/controlla.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
          href="../Librerie/bootstrap-material-datetimepicker-gh-pages/css/bootstrap-material-datetimepicker.css"/>
    <link rel="stylesheet" href="../Public/CSS/input-file.css"/>
    <link rel="stylesheet" href="../Librerie/Elementi/Lista.css"/>

    <!--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript"
            src="../Librerie/bootstrap-material-datetimepicker-gh-pages/js/bootstrap-material-datetimepicker.js"></script>

    <script type="text/javascript" src="../Librerie/file/bootstrap-filestyle.js"></script>
    <script type="text/javascript" src="Javascript/metodiGiocatori.js"></script>
    <style type="text/css">
        #contact-list {
            height: 900px;
            overflow-y: auto;
        }
    </style>

    <script type="text/javascript">
        /* Prima parte script DATE */

        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-60343429-1', 'auto');
        ga('send', 'pageview');

    </script>

    <script type="text/javascript">

        $(function () {
            /* BOOTSNIPP FULLSCREEN FIX */
            if (window.location == window.parent.location) {
                $('#back-to-bootsnipp').removeClass('hide');
            }


            $('[data-toggle="tooltip"]').tooltip();

            $('#fullscreen').on('click', function (event) {
                event.preventDefault();
                window.parent.location = "http://bootsnipp.com/iframe/4l0k2";
            });
            $('a[href="#cant-do-all-the-work-for-you"]').on('click', function (event) {
                event.preventDefault();
                $('#cant-do-all-the-work-for-you').modal('show');
            })

            $('[data-command="toggle-search"]').on('click', function (event) {
                event.preventDefault();
                $(this).toggleClass('hide-search');

                if ($(this).hasClass('hide-search')) {
                    $('.c-search').closest('.row').slideUp(100);
                } else {
                    $('.c-search').closest('.row').slideDown(100);
                }
            })

            $('#contact-list').searchable({
                searchField: '#contact-list-search',
                selector: 'li',
                childSelector: '.col-xs-12',
                show: function (elem) {
                    elem.slideDown(100);
                },
                hide: function (elem) {
                    elem.slideUp(100);
                }
            })
        });


    </script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php
    if ($_SESSION['login'] == TRUE) {
    } else {
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
                        Torneo Supernova
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <!-- Page Heading -->
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading c-list">
                            <span class="title">Contacts</span>
                            <ul class="pull-right c-controls">
                                <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip"
                                       data-placement="top" title="Toggle Search"><i class="fa fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="row" style="display: none;">
                            <div class="col-xs-12">
                                <div class="input-group c-search">
                                    <input type="search" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span
                                        class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group" id="contact-list">
                            <?php
                            include "../connessione.php";
                            try {
                                $id_e = $_SESSION['id_evento'];
                                foreach ($connessione->query("SELECT *,DATE_FORMAT(d_nascita,'%d/%m/%Y') as Nascita FROM `giocatore` INNER JOIN squadra ON squadra.id_sq = giocatore.id_squadra WHERE id_evento = $id_e") as $row) {
                                    $foto = $row['foto'];
                                    $id_giocatore = $row['id_g'];
                                    $idS = $row['id_squadra'];
                                    echo "<li id=\"giocatore$id_giocatore\" class=\"list-group-item\">";
                                    echo "<div class=\"col-xs-12 col-sm-3\">";
                                    echo "<img src=\"../$foto\" style='width: 180px; height: 180px;' alt=\"Scott Stevens\" class=\"img-responsive img-circle\"/>";
                                    echo "</div>";
                                    echo "<div id='nome$id_giocatore' class=\"col-xs-12 col-sm-8\">";
                                    echo "<span class=\"name\">" . $row['cognome'] . " " . $row['nome'] . "</span><br/>";
                                    echo "<div class=\"row\">";
                                    echo "<div id='dati$id_giocatore' class=\"col-xs-12 col-sm-6\">";
                                        echo "<span><strong>Cognome: &nbsp;</strong></span><span>" . $row['cognome'] . "</span>"
                                            . "<span><strong>&nbsp;&nbsp;Nome: &nbsp;</strong></span><span>" . $row['nome'] . "</span><br/>"
                                            . "<span><strong>Data di nascita: &nbsp;</strong></span><span>" . $row['Nascita'] . "</span><br/>"
                                            . "<span><strong>Luogo nascita: &nbsp;</strong></span><span>" . $row['Luogo_n'] . "</span><br/>"
                                            . "<span><strong>Codice Fiscale: &nbsp;</strong></span><span>" . $row['CodiceFiscale'] . "</span><br/>"
                                            . "<span><strong>Residenza: &nbsp;</strong></span><span>" . $row['Res'] . "</span><br/>"
                                            . "<span><strong>Squadra: &nbsp;</strong></span><span>" . $row['nomeSQ'] . "</span><br/>";
                                    echo "</div>";
                                    echo "<div class=\"col-xs-12 col-sm-6\">";
                                        echo"<div class='table-responsive'>";
                                            echo "<table class=\"table table-bordered table-hover\">";
                                                echo"<thead>"
                                                    ."<tr>"
                                                    ."<th>Numero Gol</th>"
                                                    ."<th>Cartellini Gialli</th>"
                                                    ."<th>Cartellini Rossi</th>"
                                                    ."</tr>"
                                                    ."</thead>";

                                                $gol = $connessione->query("SELECT COUNT(*) AS GOL FROM `partita_giocatore` WHERE id_giocatore = $id_giocatore AND Gol = 1")->fetch(PDO::FETCH_OBJ);
                                                $CartG = $connessione->query("SELECT COUNT(*) AS cart_G FROM `partita_giocatore` WHERE id_giocatore = $id_giocatore AND Cartellino_G = 1")->fetch(PDO::FETCH_OBJ);
                                                $CartR= $connessione->query("SELECT COUNT(*) AS cart_R FROM `partita_giocatore` WHERE id_giocatore = $id_giocatore AND Cartellino_R = 1")->fetch(PDO::FETCH_OBJ);
                                                echo"<tbody>"
                                                    ."<tr>"
                                                    ."<td>$gol->GOL</td>"
                                                    ."<td>$CartG->cart_G</td>"
                                                    ."<td>$CartR->cart_R</td>"
                                                    ."</tr>"
                                                    ."</tbody>";
                                    echo "</table>";
                                        echo"</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div id='button".$id_giocatore."' class=\"col-xs-12 col-sm-1\">";
                                    echo "<br>";
                                    echo "<button class=\"btn btn-primary btn-lg btn-block\" onclick='modifica(\"$id_giocatore\")'><i class='fa fa-pencil'></i></button>";

                                    echo "<br>";
                                    echo "<button class=\"btn btn-danger btn-lg btn-block\" onclick='elimina($id_giocatore, $idS)'><i class='fa fa-trash'></i></button>";
                                    echo "</div>";
                                    echo "<div class=\"clearfix\"></div>";
                                    echo "</li>";
                                    echo "";
                                    echo "";
                                }
                            } catch (PDOException $e) {
                                echo "error:" . $e->getMessage();
                            }
                            $connessione = null;
                            ?>


                            <!--dati-->


                        </ul>
                    </div>


                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4>Nuovo Giocatore</h4></div>
                        <div class="panel-body">
                            <form method="post" action="metodi/nuovo_giocatore.php">
                                <div id="DGnomeG" class='form-group'>
                                    <label for="nomeG">Nome Giocatore<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" onblur="controlla('nomeG')" id="nomeG"
                                           name="nomeG" required>
                                    <span id="GnomeG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGcognomeG" class='form-group'>
                                    <label for="cognomeG">Cognome Giocatore<i
                                            class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="cognomeG" onblur="controlla('cognomeG')"
                                           name="cognomeG" required>
                                    <span id="GcognomeG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGdateG" class='form-group'>
                                    <label for="dateG">Data di Nascita<i class="fa fa-asterisk text-danger"></i></label>
                                    <input type="text" id="dateG" name="dateG" class="form-control floating-label"
                                           placeholder="Date" required>
                                    <span id="GdateG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGLuogoG" class='form-group'>
                                    <label for="LuogoG">Luogo di Nascita<i
                                            class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="LuogoG" onblur="controlla('LuogoG')"
                                           name="LuogoG" required>
                                    <span id="GLuogoG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGcodG" class='form-group'>
                                    <label for="codG">Codice Fiscale<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="codG"
                                           onkeyup="this.style.textTransform='uppercase'" onblur="controlla('codG')"
                                           name="codG" required>
                                    <span id="GcodG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGresG" class='form-group'>
                                    <label for="resG">Residenza<i class="fa fa-asterisk text-danger"></i>
                                        <small>(ES. Via mauro rossi 7 Perugia)</small>
                                    </label>
                                    <input class="form-control" type="text" id="resG" onblur="controlla('resG')"
                                           name="resG" required>
                                    <span id="GresG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>

                                <div class="form-group">
                                    <label for="sel1">Squadra Giocatore<i
                                            class="fa fa-asterisk text-danger"></i></label>
                                    <select class="form-control" id="sel1" name="sq" required>
                                        <option value="0">Scegli squdra...</option>
                                        <?php
                                        include "../connessione.php";
                                        $sql = "SELECT id_sq, nomeSQ FROM squadra";
                                        foreach ($connessione->query($sql) as $row) {
                                            $id = $row['id_sq'];
                                            echo "<option value=\"$id\">" . $row['nomeSQ'] . "</option>";
                                        }
                                        $connessione = null;
                                        ?>
                                    </select>
                                </div>

                                <div class='form-group'>
                                    <label for="file">Foto Giocatore
                                        <small>(facoltativa)</small>
                                    </label>
                                    <input type="file" id="file" class="filestyle" data-buttonText="Find file">
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Nuovo Giocatore</button>
                            </form>
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

<!-- jQuery -->
<script type="text/javascript">
    var key = "#dateG";
    $(key).bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });

    $(":file").filestyle({buttonText: "Find file"});
</script>

</body>

</html>