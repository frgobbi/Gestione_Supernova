<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <script src="javascript/metodi-Gprodotto.js" type="text/javascript"></script>
    <link rel="stylesheet" href="CSS-Bar/CSS.css">

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

    <script type="text/javascript">

        $(function () {
            /* BOOTSNIPP RICERCA */
            if (window.location == window.parent.location) {
                $('#back-to-bootsnipp').removeClass('hide');
            }


            $('[data-toggle="tooltip"]').tooltip();

            $('#fullscreen').on('click', function (event) {
                event.preventDefault();
                window.parent.location = "http://bootsnipp.com/iframe/4l0k2";
            });


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
    <style type="text/css">
        .riquadri {
            padding: 15px;
            border: solid 2px #2e6da4;
            -webkit-border-radius: 45px;
            -moz-border-radius: 45px;
            border-radius: 45px;
        }
    </style>
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
                        Supernova 3.0
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">

                    <div id="panelProdotti" class="panel panel-default">
                        <div class="panel-heading c-list">
                            <span class="title" id="prodotti">Prodotti</span>
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
                                <button class="btn btn-default" type="button"><i class="fa fa-search fa-2x" aria-hidden="true"></i></button>
                            </span>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group" id="contact-list">
                            <?php
                            include "../connessione.php";

                            foreach ($connessione->query("SELECT * FROM `prodotto`INNER JOIN categoria ON prodotto.id_cat = categoria.id_cat ORDER BY(prodotto.id_cat)") as $row) {
                                $idP = $row['id_prodotto'];
                                if ($row['disp'] == NULL) {
                                    $disp = "null";
                                } else {
                                    $disp = $row['disp'];
                                }
                                echo "<li id=\"contenutoP$idP\" class=\"list-group-item\">"
                                    //. "<div class=\"col-xs-12 col-sm-3\">"
                                    //    . "<img src=\"../ImmaginiApp/Loghi/loghicibo/logoCibo.png\" class=\"img-responsive img-circle\" />"
                                    //. "</div>"
                                    . "<div class=\"col-xs-12 col-md-9 col-md-offset-1 col-sm-12\">"
                                    . "<div class=\"col-xs-12 col-md-9 col-sm-12\">"
                                    . "<span class=\"name\">" . $row['nome_p'] . "</span><br/>"
                                    . "<span class=\"testo-grassetto\">Categoria</span><span class=\"testo\">&nbsp; " . $row['tipo_cat'] . "</span><br/>"
                                    . "<span class=\"testo-grassetto\">Prezzo:</span><span class=\"testo\">&nbsp; " . $row['prezzo'] . " €</span><br/>"
                                    . "<span class=\"testo-grassetto\">Disponibilt&agrave;</span>";
                                if ($row['disp'] == NULL) {
                                    echo "<span class=\"testo\">&nbsp; Nessun Vincolo</span><br/>";
                                } else {
                                    echo "<span class=\"testo\">&nbsp; " . $row['disp'] . " €</span><br/>";
                                }

                                echo "</div>"
                                    . "<div class=\"col-xs-12 col-md-2 col-sm-12\"><br>"
                                    . "<button type=\"button\" class=\"btn btn-md btn-danger btn-block\" onclick=\"eliminazione(" . $row['id_prodotto'] . ")\"><i class=\"fa fa-trash\"></i></button><br><br>"
                                    . "<button type=\"button\" href=\"#\" class=\"btn btn-md btn-success btn-block\" onclick=\"modifica('" . $row['id_prodotto'] . "','" . $row['nome_p'] . "','" . $row['id_cat'] . "','" . $row['prezzo'] . "','" . $disp . "')\"><i class=\"fa fa-pencil\"></i></button>"
                                    . "</div>"
                                    . "</div>"
                                    . "<div class=\"clearfix\"><br><br>"
                                            ."<div class=\"form-group\">"
                                                ."<div class=\"material-switch pull-right\">";
                                                if($row['vendita'] == 1){
                                                    echo  "<input type=\"checkbox\" id=\"vendita$idP\" name=\"vendita$idP\" onchange=\"vendita($idP)\" checked/>";
                                                } else{
                                                    echo  "<input type=\"checkbox\" id=\"vendita$idP\" name=\"vendita$idP\" onchange=\"vendita($idP)\"/>";
                                                }
                                                $class = "label-".$row['colore'];
                                                echo "<label for=\"vendita$idP\" class=\"$class\"></label>
                                                </div>
                                            </div>
                                        </div>"
                                    . "</li>";
                            }
                            $connessione = null;
                            ?>


                        </ul>
                    </div>

                </div>
                <div class="col-md-5 col-md-offset-1 col-sm-12 col-xs-12">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse">Caricamento
                                            file .xlsx</span><b class="caret"></b></a>
                                    </h4>
                                </div>
                                <div id="collapse" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-group formI" id="excel">
                                            <li class="list-group-item">
                                                <label>Scarica modello...</label><br>
                                                <button class="btn btn-primary btn-block"
                                                    onClick="window.location.href='../File/Modello_prodotti.xlsx'"><i class="fa fa-download"></i>
                                                </button>
                                                <form role="form" method="post"
                                                      action="metodi/esecuzioni/caricamento_excell.php"
                                                      enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="xls">File input</label>
                                                        <input class="form-control" type="file" id="xls"
                                                               name="excel_file" required/>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        Trasferisci
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseP">Nuovo
                                            prodotto</span><b class="caret"></b></a>
                                    </h4>
                                </div>
                                <div id="collapseP" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-group formI" id="contact-list">
                                            <li class="list-group-item">
                                                <form role="form" method="post"
                                                      action="metodi/esecuzioni/new_prodotto.php"
                                                      enctype="multipart/form-data" id="form">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <div class="form-group">
                                                                <label for="descrizione">Descrizione</label> <input
                                                                    placeholder="Descrizione" type="text"
                                                                    class="form-control" id="descrizione"
                                                                    name="descrizione" maxlength="13" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prezzo">Prezzo</label> <input
                                                                    placeholder="Prezzo" type="text"
                                                                    class="form-control" id="prezzo" name="prezzo"
                                                                    required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label for="colore">Categoria Prodotto:</label><br>
                                                                    <select class="form-control" name="categoria"
                                                                            required>

                                                                        <?php

                                                                        //Apertura connessione.
                                                                        require('../connessione.php');

                                                                        $query = "SELECT * FROM categoria";
                                                                        try {
                                                                            foreach ($connessione->query($query) as $row) {
                                                                                $categoria = $row['id_cat'];
                                                                                $descrizione = $row['tipo_cat'];
                                                                                echo("<option value=$categoria>$descrizione</option>");
                                                                            }
                                                                        } catch (Exception $ex) {
                                                                            echo($ex->getMessage());

                                                                        }

                                                                        //Chiusura connessione.
                                                                        $connessione = null;

                                                                        ?>
                                                                    </select>
                                                                    <!-- <input placeholder="Categoria" type="email" class="form-control" id="categoria" name="categoria" required/> -->
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="disponibilita">Disponibilit&agrave: (spunta
                                                                    per nessun vincolo)</label>
                                                                <div class="input-group">
                                                                    <input placeholder="Disponibilit&agrave di default"
                                                                           type="text" class="form-control"
                                                                           id="disponibilita" name="disponibilita"
                                                                           required/>
                                                                      <span class="input-group-btn">
                                                                        <div class="btn-group" data-toggle="buttons">
                                                                            <label class="btn btn-primary">
                                                                                <input id="nullable" name="nullable"
                                                                                       type="checkbox" value="1"
                                                                                       onchange="controlloNullIns()">
                                                                                <span
                                                                                    class="glyphicon glyphicon-ok"></span>
                                                                            </label>
                                                                        </div>
                                                                      </span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Vendibilit&agrave;:</label>
                                                                <div class="material-switch pull-right">
                                                                    <input id="vendita" name="vendita" value="1"
                                                                           type="checkbox"/>
                                                                    <label for="vendita" class="label-primary"></label>
                                                                </div
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Inserisci
                                                        </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseC"><span
                                                class="title">Nuova categoria</span><b class="caret"></b></a>
                                    </h4>
                                </div>
                                <div id="collapseC" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-group formI" id="contact-list">
                                            <li class="list-group-item">
                                                <form role="form" method="post" action="metodi/esecuzioni/categoria.php"
                                                      enctype="multipart/form-data" id="form">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <div class="form-group">
                                                                <label for="nome">Nome categoria</label> <input
                                                                    placeholder="Nome" type="text" class="form-control"
                                                                    id="nome" name="nome" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="colore">Colore:</label><br>
                                                                <select class="form-control" name="colore">
                                                                    <option value="default">Bianco</option>
                                                                    <option value="primary">Blu</option>
                                                                    <option value="info">Celeste</option>
                                                                    <option value="success">Verde</option>
                                                                    <option value="warning">Giallo</option>
                                                                    <option value="danger">Rosso</option>
                                                                    <select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <br/>
                                                    <button type="submit" class="btn btn-primary btn-block">Inserisci
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="panel panel-info">
                                <div class="panel-heading ">
                                    <h4 class="panel-title">
                                        Categorie
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Nome Categoria</th>
                                                <th>Colore</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM categoria";
                                            include "../connessione.php";
                                            foreach ($connessione->query($sql) as $row) {
                                                $id_cat = $row['id_cat'];
                                                echo "<tr id=\"categoria$id_cat\">";
                                                echo "<td id=\"nome$id_cat\">" . $row['tipo_cat'] . "</td>";
                                                switch ($row['colore']) {
                                                    case "danger":
                                                        echo "<td id=\"colore$id_cat\">Rosso</td>";
                                                        break;
                                                    case "warning":
                                                        echo "<td id=\"colore$id_cat\">Giallo</td>";
                                                        break;
                                                    case "success":
                                                        echo "<td id=\"colore$id_cat\">Verde</td>";
                                                        break;
                                                    case "primary":
                                                        echo "<td id=\"colore$id_cat\">Blu</td>";
                                                        break;
                                                    case "info":
                                                        echo "<td id=\"colore$id_cat\">Celeste</td>";
                                                        break;
                                                    case "default":
                                                        echo "<td id=\"colore$id_cat\">Bianco</td>";
                                                        break;
                                                }
                                                echo "<td id=\"modifica$id_cat\" align='center'><button onclick='modCAT(" . $id_cat . ",\"" . $row['colore'] . "\")' class='btn btn-primary btn-md'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button></td>";
                                                echo "<td id=\"elimina$id_cat\" align='center'><button onclick='deleteCAT(" . $id_cat . ")' class='btn btn-danger btn-md '><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
                                                echo "</tr>";
                                            }
                                            $connessione = null;
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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


</body>

</html>

