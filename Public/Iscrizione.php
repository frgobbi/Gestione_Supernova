<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include '../Librerie/Base/librerie.php';
    LPubbliche();
    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../Librerie/bootstrap-material-datetimepicker-gh-pages/css/bootstrap-material-datetimepicker.css"/>
    <link rel="stylesheet" href="CSS/Form.css"/>
    <link rel="stylesheet" href="CSS/input-file.css"
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="../Librerie/bootstrap-material-datetimepicker-gh-pages/js/bootstrap-material-datetimepicker.js"></script>
    <script type="text/javascript" src="../Librerie/file/bootstrap-filestyle.js"></script>
    <script type="text/javascript" src="Java-script/metodi.js"></script>


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
        /*Script contatore*/
        $(document).ready(function () {
            $('.btn-number').click(function (e) {
                e.preventDefault();

                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                //console.log(input);
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        var minValue = parseInt(input.attr('min'));
                        if (!minValue)
                            minValue = 5;
                        if (currentVal > minValue) {
                            input.val(currentVal - 1).change();
                            EliminaRiga(input.val());
                        }
                        if (parseInt(input.val()) == minValue) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {
                        var maxValue = parseInt(input.attr('max'));
                        if (!maxValue)
                            maxValue = 9;
                        if (currentVal < maxValue) {
                            input.val(currentVal + 1).change();
                            AggiungiRiga(input.val());
                            $(".filestyle").filestyle({input: false});
                            var key = "#dateG" + (input.val()-1);
                            console.log(key);
                            $(key).bootstrapMaterialDatePicker
                            ({
                                time: false,
                                clearButton: true
                            });
                        }
                        if (parseInt(input.val()) == maxValue) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function () {
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function () {

                var minValue = parseInt($(this).attr('min'));
                var maxValue = parseInt($(this).attr('max'));
                if (!minValue)
                    minValue = 5;
                if (!maxValue)
                    maxValue = 9;
                var valueCurrent = parseInt($(this).val());

                var name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }

            });
        });

        // altro

        $(function () {
            $('a[title]').tooltip();
        });

    </script>
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
<div id="page">
    <?php
    require '../ComponentiBase/nav.php';
    navUnlogPublic();
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- ----------------------------------------------------------------------------------------------------------------------
             -- Intestazione della pagina -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Supernova 3.0
                        <small>dal 11 luglio al 17 luglio 2016</small>
                    </h1>
                </div>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-4 col-md-offset-4 col-sm-12 col-xs-12 jumbotron">
                    <form method="post" id="iscrizione" action="metodi/nuova_squadra.php" enctype="multipart/form-data">
                        <div id="title">
                            <h1 class="testo1">Iscrizione Torneo Supernova</h1>
                            
                        </div>
                        <div id="info">
                            <div class="alert alert-danger">
                                <strong><i class="fa fa-asterisk text-danger"></i></strong> Campi Obbligatori!
                            </div>
                        </div>
                        <!-- ---------------------------------------------------------------------------------------------------------------------- -->
                        <div id="Ref">
                            <h2 class="testo2">Dati Referente Squadra</h2>
                            <!-- has-error has-feedback -->
                            <div id="DGnomeR" class="form-group">
                                <label for="NomeR">Nome Referente <i class="fa fa-asterisk text-danger"></i></label>
                                <input class="form-control" type="text" id="nomeR" onblur="controlla('nomeR')" name="nomeR" aria-describedby="inputError2Status" required>
                                <span class="glyphicon glyphicon-remove form-control-feedback" id="GnomeR" aria-hidden="true"></span>
                            </div>
                            <div id="DGemailR" class="form-group">
                                <label for="emailR">E-mail Referente <i class="fa fa-asterisk text-danger"></i></label>
                                <input class="form-control" type="email" onblur="controlla('emailR')" id="emailR" name="emailR" required>
                                <span id="GemailR" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="telR">Numero di telefono Referente
                                    <small> (non obbligatorio)</small>
                                </label>
                                <input class="form-control" type="tel" id="telR" name="telR">
                            </div>
                            <div class="row">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-block" onclick="cambiaV(2)">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            
                            <!-- ---------------------------------------------------------------------------------------------------------------------- -->
                        </div>
                        <div id="Sq">
                            <h2 class="testo2">Dati Squadra</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div id="DGnomeS" class="form-group">
                                        <label for="nomeS">Nome Squadra<i class="fa fa-asterisk text-danger"></i></label>
                                        <input class="form-control" type="text" onblur="controllaSQ('nomeS')" id="nomeS" name="nomeS" required>
                                        <span id="GSnomeS"class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                                        <span id="GnomeS" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="nome">Numero Componenti<i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary btn-number"
                                                    disabled="disabled" data-type="minus" data-field="Nsquadra">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>
                                        <input type="text" id="Cont" name="Nsquadra" class="form-control input-number" value="5" readonly required>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary btn-number"
                                                    data-type="plus" data-field="Nsquadra">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="tabella" class="table-responsive">
                                    <h2 class="testo2">Dati Giocatori</h2>
                                    <table id="tabellaI" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nome<i class="fa fa-asterisk text-danger"></i></th>
                                            <th>Cognome<i class="fa fa-asterisk text-danger"></i></th>
                                            <th>Data di Nascita<i class="fa fa-asterisk text-danger"></i></th>
                                            <th>Codice Fiscale<i class="fa fa-asterisk text-danger"></i></th>
                                            <th>Residenza<i class="fa fa-asterisk text-danger"></i><br>
                                                <small>(ES. Via mauro rossi 7 Perugia)</small>
                                            </th>
                                            <th>Foto Profilo <br>
                                                <small>(Facoltativa)</small>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < 5; $i++) {
                                            echo "<tr>";
                                            //if ($i < 5) {
                                                echo "<td><div id=\"DGnomeG".$i."\" class='form-group'>"
                                                    ."<input class=\"form-control\" type=\"text\" onblur=\"controlla('nomeG".$i."')\" id=\"nomeG" . $i . "\" name=\"nomeG" . $i . "\" required>"
                                                    ."<span id=\"GnomeG".$i."\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";
                                                
                                                echo "<td><div id=\"DGcognomeG".$i."\" class='form-group'>"
                                                    ."<input class=\"form-control\" type=\"text\" id=\"cognomeG" . $i . "\" onblur=\"controlla('cognomeG".$i."')\" name=\"cognomeG" . $i . "\" required>"
                                                    ."<span id=\"GcognomeG".$i."\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

                                                echo "<td><div id=\"DGdateG".$i."\" class='form-group'>"
                                                    ."<input type=\"text\" id=\"dateG" . $i . "\" name=\"dateG" . $i . "\" class=\"form-control floating-label\" placeholder=\"Date\" required>"
                                                    ."<span id=\"GdateG".$i."\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

                                                echo "<td><div id=\"DGcodG".$i."\" class='form-group'>"
                                                    ."<input class=\"form-control\" type=\"text\" id=\"codG" . $i . "\" onblur=\"controlla('codG".$i."')\" name=\"codG" . $i . "\" required>"
                                                    ."<span id=\"GcodG".$i."\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

                                                echo "<td><div id=\"DGresG".$i."\" class='form-group'>"
                                                    ."<input class=\"form-control\" type=\"text\" id=\"resG" . $i . "\" onblur=\"controlla('resG".$i."')\" name=\"resG" . $i . "\" required>"
                                                    ."<span id=\"GresG".$i."\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

                                                echo "<td><div class='form-group'>"
                                                    ."<input type=\"file\" class=\"filestyle\" id=\"file" . $i . "\" data-input=\"false\" name='file" . $i . "'>"
                                                    ."</div></td>";


                                            echo "</tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" onclick="cambiaV(1)"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                                            <button type="button" class="btn btn-primary" onclick="cambiaV(3)">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- ---------------------------------------------------------------------------------------------------------------------- -->
                        <div id="Invia">
                            <br><br>
                            <button type="button" class="btn btn-lg btn-block btn-success" onclick="submitF()">Iscriviti</button>
                            <br>
                            <button type="button" class="btn btn-lg btn-block btn-danger" onclick="resetF()">Reset</button>
                            <br>
                            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="cambiaV(2)"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    /*FORM DELLA DATA PARTE 2*/
    $(document).ready(function () {
        for (var i = 0; i < 5; i++) {
            var key = "#dateG" + i
            $(key).bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });
        }
    });

</script>
</body>
</html>