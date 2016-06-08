<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../Librerie/bootstrap-material-datetimepicker-gh-pages/css/bootstrap-material-datetimepicker.css"/>
    <link rel="stylesheet" href="../Public/CSS/input-file.css"/>

    <!--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
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
                    <h1 class="page-header">Supernova 3.0
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                            <div class="panel panel-default">
                                <div class="panel-heading c-list">
                                    <span class="title">Contacts</span>
                                    <ul class="pull-right c-controls">
                                        <li><a href="#cant-do-all-the-work-for-you" data-toggle="tooltip" data-placement="top" title="Add Contact"><i class="glyphicon glyphicon-plus"></i></a></li>
                                        <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip" data-placement="top" title="Toggle Search"><i class="fa fa-ellipsis-v"></i></a></li>
                                    </ul>
                                </div>

                                <div class="row" style="display: none;">
                                    <div class="col-xs-12">
                                        <div class="input-group c-search">
                                            <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-group" id="contact-list">
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/men/49.jpg" alt="Scott Stevens" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Scott Stevens</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5842 Hillcrest Rd"></span>
                                            <span class="visible-xs"> <span class="text-muted">5842 Hillcrest Rd</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(870) 288-4149"></span>
                                            <span class="visible-xs"> <span class="text-muted">(870) 288-4149</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="scott.stevens@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">scott.stevens@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/men/97.jpg" alt="Seth Frazier" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Seth Frazier</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="7396 E North St"></span>
                                            <span class="visible-xs"> <span class="text-muted">7396 E North St</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(560) 180-4143"></span>
                                            <span class="visible-xs"> <span class="text-muted">(560) 180-4143</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="seth.frazier@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">seth.frazier@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/women/90.jpg" alt="Jean Myers" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Jean Myers</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="4949 W Dallas St"></span>
                                            <span class="visible-xs"> <span class="text-muted">4949 W Dallas St</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(477) 792-2822"></span>
                                            <span class="visible-xs"> <span class="text-muted">(477) 792-2822</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="jean.myers@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">jean.myers@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/men/24.jpg" alt="Todd Shelton" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Todd Shelton</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5133 Pecan Acres Ln"></span>
                                            <span class="visible-xs"> <span class="text-muted">5133 Pecan Acres Ln</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(522) 991-3367"></span>
                                            <span class="visible-xs"> <span class="text-muted">(522) 991-3367</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="todd.shelton@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">todd.shelton@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/women/34.jpg" alt="Rosemary Porter" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Rosemary Porter</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5267 Cackson St"></span>
                                            <span class="visible-xs"> <span class="text-muted">5267 Cackson St</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(497) 160-9776"></span>
                                            <span class="visible-xs"> <span class="text-muted">(497) 160-9776</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="rosemary.porter@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">rosemary.porter@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/women/56.jpg" alt="Debbie Schmidt" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Debbie Schmidt</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="3903 W Alexander Rd"></span>
                                            <span class="visible-xs"> <span class="text-muted">3903 W Alexander Rd</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(867) 322-1852"></span>
                                            <span class="visible-xs"> <span class="text-muted">(867) 322-1852</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="debbie.schmidt@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">debbie.schmidt@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-xs-12 col-sm-3">
                                            <img src="http://api.randomuser.me/portraits/women/76.jpg" alt="Glenda Patterson" class="img-responsive img-circle" />
                                        </div>
                                        <div class="col-xs-12 col-sm-9">
                                            <span class="name">Glenda Patterson</span><br/>
                                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5020 Poplar Dr"></span>
                                            <span class="visible-xs"> <span class="text-muted">5020 Poplar Dr</span><br/></span>
                                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(538) 718-7548"></span>
                                            <span class="visible-xs"> <span class="text-muted">(538) 718-7548</span><br/></span>
                                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="glenda.patterson@example.com"></span>
                                            <span class="visible-xs"> <span class="text-muted">glenda.patterson@example.com</span><br/></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
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
                                            <label for="user">Username:</label>
                                            <input placeholder="username" type="text" class="form-control" id="user" name="user" required/>
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