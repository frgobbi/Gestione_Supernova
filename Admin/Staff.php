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
    <script type="text/javascript" src="java-script/metodi.js"></script>

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

    <style type="text/css">
        #contact-list {
            height: 900px;
            overflow-y: auto;
        }

        .btn span.glyphicon {
            opacity: 0;
        }
        .btn.active span.glyphicon {
            opacity: 1;
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
                                <li><a onclick="eliminazioneMultipla()"><i class="fa fa-trash"></i></a></li>
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
                            $sql = "SELECT * FROM staff NATURAL JOIN tipo_staff NATURAL JOIN evento WHERE 1";
                            include '../connessione.php';

                            try {
                                foreach ($connessione->query($sql) as $row) {
                                    $id_Staff = $row['username'];
                                    $foto = $row['foto'];
                                    $nome = $row['nome'];
                                    $cognome = $row['cognome'];
                                    echo("<li id=\"L$id_Staff\" class=\"list-group-item\">");
                                    echo("<div class=\"col-xs-12 col-sm-12 col-md-1\">");
                                    echo("<br>");
                                    echo("<div class=\"btn-group\" data-toggle=\"buttons\">");
                                    echo("<label class=\" btn btn-default\">");
                                    echo("<input class='spunta' name=\"Check$id_Staff\" type=\"checkbox\" autocomplete=\"off\">");
                                    echo("<span class=\" icoSpunta glyphicon glyphicon-ok\"></span>");
                                    echo("</label>");
                                    echo("</div>");
                                    echo("</div>");
                                    echo("<div class=\"col-xs-12 col-sm-12 col-md-3\">");
                                    echo("<img style='width: 150px; height: 150px' src=\"../$foto\" alt=\"$nome $cognome\" class=\"img-responsive img-thumbnail img-circle\" />");
                                    echo("</div>");
                                    echo("<div class=\"col-xs-12 col-sm-12 col-md-8\">");
                                    echo("<span class=\"name\">$nome $cognome</span>");
                                    echo("<div class=\"row\">");
                                    echo("<div class=\"col-md-7\">");
                                    echo("<strong><span></span>Data: </span></strong>&nbsp<span class=\"testo\">" . $row['data_nascita'] . "</span><br>");
                                    echo("<strong><span></span>Sesso: </span></strong>&nbsp<span class=\"testo\">" . $row['sesso'] . "</span>&nbsp<br>");
                                    echo("<strong><span></span>User: </span></strong>&nbsp<span class=\"testo\">" . $row['username'] . "</span>&nbsp<br>");
                                    echo("<strong><span></span>email: </span></strong>&nbsp<span class=\"testo\">" . $row['email'] . "</span>&nbsp<br>");
                                    echo("<strong><span></span>Evento: </span></strong>&nbsp<span class=\"testo\">" . $row['nome_evento'] . "</span>&nbsp<br>");
                                    echo("<strong><span></span>Tipo Staff: </span></strong>&nbsp<span class=\"testo\">" . $row['descrizione'] . "</span>&nbsp<br>");
                                    echo("</div>");
                                    echo("<div class=\" col-xs-12 col-sm-12 col-md-1 col-md-offset-2 button\">");
                                    echo("<button type=\"button\" href=\"#\" class=\"btn btn-md btn-danger\" onclick=\"eliminaStaff('$id_Staff')\"><i class=\"fa fa-trash\"></i></button><br><br>");
                                    echo("<button type=\"button\" href=\"#\" class=\"btn btn-md btn-primary\" onclick=\"attivaModifica('$id_Staff')\"><i class=\"fa fa-pencil\"></i></button>");
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
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="panel panel-yellow">
                        <div class="panel-heading"><h4>Aggiungi STAFF</h4></div>
                        <div class="panel-body">
                            <form role="form" method="post" action="metodi/IscrizioneStaff.php"
                                  enctype="multipart/form-data" id="form">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <label for="nome">Nome:</label>
                                            <input placeholder="Nome" type="text" class="form-control" id="name" required name="nome"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="cognome">Cognome:</label>
                                            <input placeholder="Cognome" type="text" class="form-control" id="cognome" required name="cognome"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Data di nascita:</label>
                                            <input type="text" id="date" name="date" class="form-control floating-label" placeholder="Data" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail:</label>
                                            <input placeholder="e-mail" type="email" class="form-control" id="email" name="email" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="user">Username:<small>(Solo lettere e numeri)</small></label>
                                            <input placeholder="username" pattern="[A-Za-z0-9]+"  type="text" class="form-control" id="user" name="user" required title="solo lettere e numeri"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass">Password:</label>
                                            <input placeholder="password" type="password" class="form-control" id="pass" name="pass" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Sesso:</label><br/>
                                    &nbsp; Maschio &nbsp;&nbsp;&nbsp; <input type="radio" name="sesso" value="maschio"/><br/>
                                    &nbsp; Femmina &nbsp; <input type="radio" name="sesso" value="femmina"/><br/>
                                </div>
                                <div class='form-group'>
                                    <label for="img">Foto Profilo:</label>
                                    <input type="file" id="img" name="img" class="filestyle" data-buttonText="Find file">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var key = "#date";
    $(key).bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true
    });

    $(":file").filestyle({buttonText: "Find file"});
</script>
</body>
</html>