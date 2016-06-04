<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    <script src="Javascript/controlla.js"></script>
    <link rel="stylesheet" href="CSS/RegoleS.css"/>

    <style type="text/css">

        .glyphicon-remove, .glyphicon-ok{
            display: none ;
        }

        /*Regole input file logo */
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .image-preview-input-title {
            margin-left: 2px;
        }
    </style>

    <script type="text/javascript">
        $(document).on('click', '#close-preview', function () {
            $('.image-preview').popover('hide');
            // Hover befor close the preview
            $('.image-preview').hover(
                function () {
                    $('.image-preview').popover('show');
                },
                function () {
                    $('.image-preview').popover('hide');
                }
            );
        });

        $(function () {
            // Create the close button
            var closebtn = $('<button/>', {
                type: "button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;',
            });
            closebtn.attr("class", "close pull-right");
            // Set the popover default content
            $('.image-preview').popover({
                trigger: 'manual',
                html: true,
                title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
                content: "There's no image",
                placement: 'bottom'
            });
            // Clear event
            $('.image-preview-clear').click(function () {
                $('.image-preview').attr("data-content", "").popover('hide');
                $('.image-preview-filename').val("");
                $('.image-preview-clear').hide();
                $('.image-preview-input input:file').val("");
                $(".image-preview-input-title").text("Browse");
            });
            // Create the preview image
            $(".image-preview-input input:file").change(function () {
                var img = $('<img/>', {
                    id: 'dynamic',
                    width: 250,
                    height: 200
                });
                var file = this.files[0];
                var reader = new FileReader();
                // Set preview image into the popover data-content
                reader.onload = function (e) {
                    $(".image-preview-input-title").text("Change");
                    $(".image-preview-clear").show();
                    $(".image-preview-filename").val(file.name);
                    img.attr('src', e.target.result);
                    $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }
                reader.readAsDataURL(file);
            });
        });
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
                                    <input type="text" class="form-control" id="contact-list-search">
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
                            $sql = "SELECT * FROM squadra";
                            try {
                                foreach ($connessione->query($sql) as $row) {
                                    $id = $row['id_sq'];
                                    echo "<li id=\"contenutoS$id\" class=\"list-group-item\">"
                                        . "<div class=\"col-xs-12 col-md-2  col-sm-12\">";
                                    if ($row['srcF'] == NULL) {
                                        echo "<img src=\"../ImmaginiApp/Loghi/superman_logo.png\" alt=\"Scott Stevens\" class=\"img-responsive img-rounded\"/>";
                                    } else {
                                        $foto = $row['srcF'];
                                        echo "<img src=\"../$foto\" alt=\"Scott Stevens\" class=\"img-responsive img-circle\"/>";
                                    }
                                    echo "</div>";
                                    echo "<div class=\"col-xs-12 col-md-9  col-sm-12\">"
                                        . "<div class=\"col-xs-12 col-md-11 col-sm-12\">"
                                        . "<span class=\"name\">" . $row['nomeSQ'] . "</span><br/>"
                                        . "<span><strong>Categoria: </strong></span><span>&nbsp;" . $row['Nome_Ref'] . "</span><br/>"
                                        . "<span><strong>Email: </strong></span><span>&nbsp;" . $row['mail'] . "</span><br/>";
                                    if ($row['Numero'] != NULL) {
                                        echo "<span><strong>Categoria: </strong></span><span>&nbsp;" . $row['Numero'] . "</span><br/>";
                                    }
                                    echo "<div class=\"table-responsive\">"
                                        . "<table class=\"table table-bordered table-hover\">"
                                        . "<thead>"
                                        . "<tr>"
                                        . "<th>Vittorie</th>"
                                        . "<th>Sconfitte</th>"
                                        . "<th>Pareggi</th>"
                                        . "<th>Gol fatti</th>"
                                        . "<th>Gol subiti</th>"
                                        . "<th>Punti</th>"
                                        . "</tr>"
                                        . "</thead>"
                                        . "<tbody>"
                                        . "<tr>"
                                        . "<td>" . $row['p_vinte'] . "</td>"
                                        . "<td>" . $row['p_perse'] . "</td>"
                                        . "<td>" . $row['p_pareggio'] . "</td>"
                                        . "<td>" . $row['gol_f'] . "</td>"
                                        . "<td>" . $row['gol_s'] . "</td>"
                                        . "<td>" . $row['punti'] . "</td>"
                                        . "</tr>"
                                        . "</tbody>"
                                        . "</table>"
                                        . "</div>";

                                    echo "<div class=\"panel-group\">"
                                        . "<div class=\"panel panel-primary\">"
                                        . "<div class=\"panel-heading\">"
                                        . "<h4 class=\"panel-title\">"
                                        . "<a data-toggle=\"collapse\" href=\"#Giocatori$id\">Componenti Squadra</a>"
                                        . "</h4>"
                                        . "</div>"
                                        . "<div id=\"Giocatori$id\" class=\"panel-collapse collapse\">"
                                        . "<div class=\"panel-body\">"
                                        . "<div class=\"table-responsive\">"
                                        . "<table class=\"table table-bordered table-hover\">"
                                        . "<thead>"
                                        . "<tr>"
                                        //eventualmente foto
                                        //. "<th></th>"
                                        . "<th>Nome</th>"
                                        . "<th>Cognome</th>"
                                        . "<th>Data di nascita</th>"
                                        . "<th>Luogo di Nascita</th>"
                                        . "<th>Codice Fiscale</th>"
                                        . "<th>Residenza</th>"
                                        . "<th>Gol</th>"
                                        . "<th>Cartellini Gialli</th>"
                                        . "<th>Cartellini Gialli</th>"
                                        . "</tr>"
                                        . "</thead>"
                                        . "<tbody>";
                                    try {
                                        foreach ($connessione->query("SELECT * FROM giocatore WHERE id_squadra = $id") as $riga) {
                                            echo "<tr>"
                                                . "<td>" . $riga['nome'] . "</td>"
                                                . "<td>" . $riga['cognome'] . "</td>"
                                                . "<td>" . $riga['d_nascita'] . "</td>"
                                                . "<td>" . $riga['Luogo_n'] . "</td>"
                                                . "<td>" . $riga['CodiceFiscale'] . "</td>"
                                                . "<td>" . $riga['Res'] . "</td>"
                                                . "</tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "error: " . $e->getMessage();
                                    }
                                    echo "</tbody>"
                                        . "</table>"
                                        . "</div>"
                                        . "</div>"
                                        . "</div>"
                                        . "</div>"
                                        . "</div>";
                                    echo "</div>"
                                        . "<div class=\"col-xs-12 col-md-1 col-sm-12\"><br>"
                                        . "<button type=\"button\" class=\"btn btn-md btn-danger btn-block\"><i class=\"fa fa-trash\"></i></button><br>"
                                        . "<button type=\"button\" class=\"btn btn-md btn-primary btn-block\"><i class=\"fa fa-file-pdf-o\"></i></button><br>"
                                        . "</div>"
                                        . "</div>"
                                        . "<div class=\"clearfix\"></div>"
                                        . "</li>";
                                }
                            } catch (PDOException $e) {
                                echo "error: " . $e->getMessage();
                            }
                            $connessione = null;
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4>Nuova Squadra</h4></div>
                        <div class="panel-body">
                            <form method="post" action="metodi/nuova_squadra.php">
                                <div id="DGnomeR" class="form-group">
                                    <label for="NomeR">Nome Referente <i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" id="nomeR" onblur="controlla('nomeR')"
                                           name="nomeR" aria-describedby="inputError2Status" required>
                                    <span class="glyphicon glyphicon-remove form-control-feedback" id="GnomeR"
                                          aria-hidden="true" style="display: none"></span>
                                </div>
                                <div id="DGemailR" class="form-group">
                                    <label for="emailR">E-mail Referente <i
                                            class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="email" onblur="controlla('emailR')" id="emailR"
                                           name="emailR" required>
                                    <span id="GemailR" class="glyphicon glyphicon-remove form-control-feedback"
                                          aria-hidden="true" style="display: none"></span>
                                </div>
                                <div class="form-group">
                                    <label for="telR">Numero di telefono Referente<br>
                                        <small> (non obbligatorio)</small>
                                    </label>
                                    <input class="form-control" type="tel" id="telR" name="telR">
                                </div>

                                <label>Immagine/Logo squadra</label>
                                <div class="input-group image-preview">
                                    <input type="text" id="textImg" class="form-control image-preview-filename"
                                           disabled="disabled">
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear"
                                                        style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif"
                                                           name="input-file-preview"/>
                                                    <!-- rename it -->
                                                </div>
                                            </span>
                                </div>

                                <div id="DGnomeS" class="form-group">
                                    <label for="nomeS">Nome Squadra<i class="fa fa-asterisk text-danger"></i></label>
                                    <input class="form-control" type="text" onblur="controllaSQ('nomeS')" id="nomeS"
                                           name="nomeS" required>
                                    <span id="GSnomeS" class="glyphicon glyphicon-ok form-control-feedback"
                                          aria-hidden="true" style="display: none"></span>
                                    <span id="GnomeS" class="glyphicon glyphicon-remove form-control-feedback"
                                          aria-hidden="true" style="display: none"></span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Iscrivi Nuova Squadra
                                </button>
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


</body>

</html>

