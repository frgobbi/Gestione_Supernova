<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <style type="text/css">

        .btn span.glyphicon {
            opacity: 0;
        }
        .btn.active span.glyphicon {
            opacity: 1;
        }

        #panelProdotti {
            height: 650px;
            overflow-x: auto;

        }

        .material-switch > input[type="checkbox"] {
            display: none;
        }

        .material-switch > label {
            cursor: pointer;
            height: 0px;
            position: relative;
            width: 40px;
        }

        .material-switch > label::before {
            background: rgb(0, 0, 0);
            box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            content: '';
            height: 16px;
            margin-top: -8px;
            position: absolute;
            opacity: 0.3;
            transition: all 0.4s ease-in-out;
            width: 40px;
        }

        .material-switch > label::after {
            background: rgb(255, 255, 255);
            border-radius: 16px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            content: '';
            height: 24px;
            left: -4px;
            margin-top: -8px;
            position: absolute;
            top: -4px;
            transition: all 0.3s ease-in-out;
            width: 24px;
        }

        .material-switch > input[type="checkbox"]:checked + label::before {
            background: inherit;
            opacity: 0.5;
        }

        .material-switch > input[type="checkbox"]:checked + label::after {
            background: inherit;
            left: 20px;
        }

        .panel > .list-group .list-group-item:first-child {
            /*border-top: 1px solid rgb(204, 204, 204);*/
        }

        @media (max-width: 767px) {
            .visible-xs {
                display: inline-block !important;
            }

            .block {
                display: block !important;
                width: 100%;
                height: 1px !important;
            }
        }

        #back-to-bootsnipp {
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .c-search > .form-control {
            border-radius: 0px;
            border-width: 0px;
            border-bottom-width: 1px;
            font-size: 1.3em;
            padding: 12px 12px;
            height: 44px;
            outline: none !important;
        }

        .c-search > .form-control:focus {
            outline: 0px !important;
            -webkit-appearance: none;
            box-shadow: none;
        }

        .c-search > .input-group-btn .btn {
            border-radius: 0px;
            border-width: 0px;
            border-left-width: 1px;
            border-bottom-width: 1px;
            height: 44px;
        }

        .c-list {
            padding: 0px;
            min-height: 44px;
        }

        #prodotti {
            display: inline-block;
            font-size: 1.7em;
            font-weight: bold;
            padding: 5px 15px;
        }

        ul.c-controls {
            list-style: none;
            margin: 0px;
            min-height: 44px;
        }

        ul.c-controls li {
            margin-top: 8px;
            float: left;
        }

        ul.c-controls li a {
            font-size: 1.7em;
            padding: 11px 10px 6px;
        }

        ul.c-controls li a i {
            min-width: 24px;
            text-align: center;
        }

        ul.c-controls li a:hover {
            background-color: rgba(51, 51, 51, 0.2);
        }

        .c-toggle {
            font-size: 1.7em;
        }

        .name {
            font-size: 1.7em;
            font-weight: 700;
        }

        .c-info {
            padding: 5px 10px;
            font-size: 1.25em;
        }

    </style>
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


        function modCAT(id, colore) {
            var colors = [
                "danger",
                "warning",
                "success",
                "primary",
                "info",
                "default"
            ];
            var keyC = "#colore"+id;
            var codiceC = "<td id=\"colore"+id+"\">"
                    +"<select class=\"form-control\" id=\"Select"+id+"\" name=\"select"+id+"\">";

            switch (colore){
                case "danger": codiceC = codiceC + "<option value=\"danger\">Rosso</option>";
                    break;
                case "warning": codiceC = codiceC + "<option value=\"warning\">Giallo</option>";
                    break;
                case "success": codiceC = codiceC + "<option value=\"success\">Verde</option>";
                    break;
                case "primary": codiceC = codiceC + "<option value=\"primary\">Blu</option>";
                    break;
                case "info": codiceC = codiceC + "<option value=\"info\">Celeste</option>";
                    break;
                case "default": codiceC = codiceC + "<option value=\"default\">Bianco</option>";
                    break;
            }
            for(var i =0; i <colors.length;i++) {
                if (colore.localeCompare(colors[i]) != 0) {
                    switch (colors[i]) {
                        case "danger":
                            codiceC = codiceC + "<option value=\"danger\">Rosso</option>";
                            break;
                        case "warning":
                            codiceC = codiceC + "<option value=\"warning\">Giallo</option>";
                            break;
                        case "success":
                            codiceC = codiceC + "<option value=\"success\">Verde</option>";
                            break;
                        case "primary":
                            codiceC = codiceC + "<option value=\"primary\">Blu</option>";
                            break;
                        case "info":
                            codiceC = codiceC + "<option value=\"info\">Celeste</option>";
                            break;
                        case "default":
                            codiceC = codiceC + "<option value=\"default\">Bianco</option>";
                            break;
                    }
                }
            }
                codiceC += "</select>"
                    +"</td>";


            var keyM = "#modifica"+id;
            var keyD = "#elimina"+id
            $(keyC).replaceWith(codiceC);
            $(keyM).replaceWith("<td id=\"conferma"+id+"\" align='center'><button onclick=\"confermaC("+id+")\" class='btn btn-success btn-md '><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>");
            $(keyD).replaceWith(codiceC);
            
        }

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
            <div class="row">
                <div class="col-md-8">

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

                            foreach ($connessione->query("SELECT * FROM `prodotto`INNER JOIN categoria ON prodotto.id_cat = categoria.id_cat") as $row) {
                                $idP = $row['id_prodotto'];
                                echo "<li id=\"contenutoP$idP\" class=\"list-group-item\">"
                                    . "<div class=\"col-xs-12 col-sm-3\">"
                                    . "<img src=\"http://api.randomuser.me/portraits/men/49.jpg\" alt=\"Scott Stevens\" class=\"img-responsive img-circle\" />"
                                    . "</div>"
                                    . "<div class=\"col-xs-12 col-sm-9\">"
                                    . "<div class=\"col-xs-12 col-sm-10\">
                                            <span class=\"name\">" . $row['nome_p'] . "</span><br/>
                                            <span class=\"testo-grassetto\">Prezzo:</span><span class=\"testo\">&nbsp; " . $row['prezzo'] . " €</span><br/>
                                            <span class=\"testo-grassetto\">Categoria:</span><span class=\"testo\">&nbsp; " . $row['tipo_cat'] . "
                                           </span><br/>
                                        </div>
                                        <div class=\"col-xs-12 col-sm-2\"><br>
                                         <button type=\"button\" class=\"btn btn-md btn-danger disable-button\" onclick=\"eliminazione(" . $row['id_prodotto'] . ")\"><i class=\"fa fa-trash\"></i></button><br><br>
                                         <button type=\"button\" href=\"#\" class=\"btn btn-md btn-success disable-button\" onclick=\"modifica(" . $row['id_prodotto'] . ")\"><i class=\"fa fa-pencil\"></i></button>
                                </div>                                    
                                </div>
                                <div class=\"clearfix\"></div>
                            </li>";
                            }
                            $connessione = null;
                            ?>


                        </ul>
                    </div>

                </div>
                <div class="col-md-4">

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
                                                        onClick="window.location.href='work_files/Modello_Caricamento_Merende.xlsx'">
                                                    <i class="fa fa-download"></i></button>
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
                                                                    name="descrizione" required/>
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
                                                                <label for="disponibilita">Disponibilit&agrave: (spunta per nessun vincolo)</label>


                                                                <div class="input-group">
                                                                    <input placeholder="Disponibilit&agrave di default"
                                                                           type="text" class="form-control"
                                                                           id="disponibilita" name="disponibilita"
                                                                           required/>
                                                                      <span class="input-group-btn">
                                                                        <div class="btn-group" data-toggle="buttons">
                                                                            <label class="btn btn-primary">
                                                                                <input name="nullable" type="checkbox" value="1">
                                                                                <span class="glyphicon glyphicon-ok"></span>
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
                                                        <div class="form-group">
                                                            <label>Bottone attivo: </label>
                                                            <div class="material-switch pull-right">
                                                                <input id="button" name="button" value="1"
                                                                       type="checkbox"/>
                                                                <label for="button" class="label-info"></label>
                                                            </div
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
                                                <th>Modifica</th>
                                                <th>Elimina</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM categoria";
                                            include "../connessione.php";
                                            foreach($connessione->query($sql) as $row){
                                            $id_cat = $row['id_cat'];
                                                echo "<tr id=\"categoria$id_cat\">";
                                                    echo "<td id=\"nome$id_cat\">".$row['tipo_cat']."</td>";
                                                    switch ($row['colore']){
                                                        case "danger": echo "<td id=\"colore$id_cat\">Rosso</td>";
                                                            break;
                                                        case "warning": echo "<td id=\"colore$id_cat\">Giallo</td>";
                                                            break;
                                                        case "success": echo "<td id=\"colore$id_cat\">Verde</td>";
                                                            break;
                                                        case "primary": echo "<td id=\"colore$id_cat\">Blu</td>";
                                                            break;
                                                        case "info": echo "<td id=\"colore$id_cat\">Celeste</td>";
                                                            break;
                                                        case "default": echo "<td id=\"colore$id_cat\">Bianco</td>";
                                                            break;
                                                    }
                                                    echo "<td id=\"modifica$id_cat\" align='center'><button onclick='modCAT(".$id_cat.",\"".$row['colore']."\")' class='btn btn-primary btn-md'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button></td>";
                                                    echo "<td id=\"elimina$id_cat\" align='center'><button onclick='deleteCAT(".$id_cat.")' class='btn btn-danger btn-md '><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
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

