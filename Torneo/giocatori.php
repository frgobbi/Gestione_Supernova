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
    <link rel="stylesheet" href="../Librerie/bootstrap-material-datetimepicker-gh-pages/css/bootstrap-material-datetimepicker.css"/>
    <link rel="stylesheet" href="../Public/CSS/input-file.css"/>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="../Librerie/bootstrap-material-datetimepicker-gh-pages/js/bootstrap-material-datetimepicker.js"></script>

    <script type="text/javascript" src="../Librerie/file/bootstrap-filestyle.js"></script>


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

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4>Nuovo Giocatore</h4></div>
                        <div class="panel-body">
                            <form method="post" action="metodi/nuovo_giocatore.php">
                                <div id="DGnomeG" class='form-group'>
                                    <label for="nomeG">Nome Giocatore<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" onblur="controlla('nomeG')" id="nomeG" name="nomeG" required>
                                    <span id="GnomeG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGcognomeG" class='form-group'>
                                    <label for="cognomeG">Cognome Giocatore<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="cognomeG" onblur="controlla('cognomeG')" name="cognomeG" required>
                                    <span id="GcognomeG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGdateG" class='form-group'>
                                    <label for="dateG">Data di Nascita<i class="fa fa-asterisk text-danger"></i></label>
                                    <input type="text" id="dateG" name="dateG" class="form-control floating-label" placeholder="Date" required>
                                    <span id="GdateG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGLuogoG" class='form-group'>
                                    <label for="LuogoG">Luogo di Nascita<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="LuogoG" onblur="controlla('LuogoG')" name="LuogoG"  required>
                                    <span id="GLuogoG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none"  aria-hidden="true"></span>
                                </div>

                                <div id="DGcodG" class='form-group'>
                                    <label for="codG">Codice Fiscale<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="codG" onkeyup="this.style.textTransform='uppercase'" onblur="controlla('codG')" name="codG" required>
                                    <span id="GcodG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none" aria-hidden="true"></span>
                                </div>

                                <div id="DGresG" class='form-group'>
                                    <label for="resG">Residenza<i class="fa fa-asterisk text-danger"></i>
                                        <small>(ES. Via mauro rossi 7 Perugia)</small></label>
                                    <input class="form-control" type="text" id="resG" onblur="controlla('resG')" name="resG" required>
                                    <span id="GresG" class="glyphicon glyphicon-remove form-control-feedback" style="display: none" aria-hidden="true"></span>
                                </div>

                                <div class="form-group">
                                    <label for="sel1">Squadra Giocatore<i class="fa fa-asterisk text-danger"></i></label>
                                    <select class="form-control" id="sel1" name="sq" required>
                                        <option value="0">Scegli squdra...</option>
                                        <?php
                                            include "../connessione.php";
                                                $sql = "SELECT id_sq, nomeSQ FROM squadra";
                                                foreach ($connessione->query($sql) as $row){
                                                    $id = $row['id_sq'];
                                                    echo "<option value=\"$id\">".$row['nomeSQ']."</option>";
                                                }
                                            $connessione = null;
                                        ?>
                                    </select>
                                </div>

                                <div class='form-group'>
                                    <label for="file">Foto Giocatore <small>(facoltativa)</small></label>
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