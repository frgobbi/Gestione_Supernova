<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>
    <script src="http://code.jquery.com/jquery-1.12.0.js" type="text/javascript"></script>
    <script src="cassa1/Js/conto.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="cassa1/Js/conto.js" type="text/javascript"></script>
    <script src="cassa1/Js/metodi.js" type="text/javascript"></script>
    <link rel="stylesheet" href="cassa1/CSS/elementiCassa.css">
    <link rel="stylesheet" href="cassa1/CSS/cassa.css">

    <script type="text/javascript">


    </script>
</head>

<body>
<div id="overlay"></div>
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
                <div class="col-md-11">
                    <div id="popupBox">
                        <div class="row">
                            <div class="col-md-8 table-responsive">
                                <table id="Tserate" class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Evento</th>
                                        <th>Incasso</th>
                                        <th>Numero Ordini</th>
                                        <th>Chiusura</th>
                                        <th>Reset</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $evento = $_SESSION['id_evento'];
                                    $sql = "SELECT d_ord, nome_evento, n_ordini, chiusura FROM serata INNER JOIN evento ON serata.id_evento = evento.id_evento WHERE serata.id_evento = 1";
                                    include "../connessione.php";

                                    foreach ($connessione->query($sql) as $row) {
                                        $data = $row['d_ord'];
                                        $nomeI = "chiusura" . $row['d_ord'];
                                        $idT = "chiusura" . $row['d_ord'] . "T";
                                        $idF = "chiusura" . $row['d_ord'] . "F";
                                        $idLT = "label" . $row['d_ord'] . "T";
                                        $idLF = "label" . $row['d_ord'] . "F";
                                        $Iprodotti = $connessione->query("SELECT SUM(prezzo) AS IncassoP FROM `serata` INNER JOIN ordine ON serata.d_ord = ordine.d_ord INNER JOIN prodotto ON ordine.id_prodotto = prodotto.id_prodotto WHERE id_evento = $evento AND serata.d_ord LIKE '$data'")->fetch(PDO::FETCH_OBJ);
                                        $Ivarie = $connessione->query("SELECT SUM(importo) AS IncassoV FROM `serata` INNER JOIN ordinev ON serata.d_ord = ordinev.d_ord WHERE id_evento = $evento AND serata.d_ord LIKE '$data'")->fetch(PDO::FETCH_OBJ);
                                        $incassoS = 0 + $Iprodotti->IncassoP + $Ivarie->IncassoV;
                                        $nOrd = "numO" . $row['d_ord'];
                                        $idR = "reset" . $row['d_ord'];
                                        $date = $row['d_ord'];
                                        echo "<tr>";
                                        echo "<td>" . $row['d_ord'] . "</td>";
                                        echo "<td>" . $row['nome_evento'] . "</td>";
                                        echo "<td id=\"data$data\">$incassoS &euro; </td>";
                                        echo "<td id=\"$nOrd\">" . $row['n_ordini'] . "</td>";
                                        if ($row['chiusura'] != 1) {
                                            echo "<td align='center'>";
                                            echo "<div class=\"btn-group\" id=\"status\" data-toggle=\"buttons\">";
                                            echo "<label id=\"$idLT\" class=\"btn btn-default btn-on  active\">";
                                            echo "<input type=\"radio\" value=\"0\" id=\"$idT\" name=\"$nomeI\" onchange=\"modificachiusura('$date','$evento')\" checked>ON</label>";
                                            echo "<label id=\"$idLF\" class=\"btn btn-default btn-off\">";
                                            echo "<input type=\"radio\" value=\"1\" id=\"$idF\" name=\"$nomeI\" onchange=\"modificachiusura('$date','$evento')\">OFF</label>";
                                            echo "</div>";
                                            echo "</td>";
                                        } else {
                                            echo "<td align='center'>";
                                            echo "<div class=\"btn-group\" id=\"status\" data-toggle=\"buttons\">";
                                            echo "<label id=\"$idLT\" class=\"btn btn-default btn-on \">";
                                            echo "<input type=\"radio\" value=\"0\" id=\"$idT\" name=\"$nomeI\" onchange=\"modificachiusura('$date','$evento')\">ON</label>";
                                            echo "<label id=\"$idLF\" class=\"btn btn-default btn-off active\">";
                                            echo "<input type=\"radio\" value=\"1\" id=\"$idF\" name=\"$nomeI\" onchange=\"modificachiusura('$date','$evento')\" checked>OFF</label>";
                                            echo "</div>";
                                            echo "</td>";
                                        }
                                        echo "<td align='center'><button id=\"$idR\" class='btn btn-danger btn-lg' onclick=\"controllaReset('$date','$evento')\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td>";
                                        echo "</tr>";
                                    }


                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                    echo "<div class=\"col-md-4\">";
                                    echo "<div class=\"panel panel-default\">";
                                    echo "<div class=\"panel-heading\">Nuova Serata</div>";
                                    echo "<div class=\"panel-body\">";
                                    echo "<button class=\"btn btn-success btn-block btn-lg\" onclick=\"controlloN('$evento')\">Apri una nuova <br> Serata</button>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offet-2 col-sm-12 col-xs-12">
                    <button id="serate"  class="btn btn-warning btn-lg btn-block" onclick="GPopup()">Serate</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <button id="analisiD"  class="btn btn-info btn-lg btn-block" >Analisi Dati</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <textarea class="form-control"  id="display"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('1')">1</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('2')">2</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('3')">3</button>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('4')">4</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('5')">5</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('6')">6</button>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('7')">7</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('8')">8</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('9')">9</button>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('0')">0</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('00')">00</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="numeri btn btn-lg btn-default btn-block" onclick="tastiera('.')">.</button>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="bM btn btn-lg btn-default btn-block" onclick="annulla()">Annulla</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="bM btn btn-lg btn-default btn-block" onclick="cancella()">Cancella</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="bM btn btn-lg btn-default btn-block" onclick="del()">Del</button>
                        </div>
                        <div class="col-lg-12 col-md-12-xs-12 col-sm-12 col">
                            <button class="btn btn-lg btn-primary btn-block" onclick="tot(1)">Buono</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="bM btn btn-lg btn-default btn-block" onclick="X()">X</button>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="Btt btn btn-lg btn-default btn-block" onclick="varie()">Varie</button>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="Btt btn btn-lg btn-default btn-block" onclick="subtot(0)">SUB</button>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button id="tot" class="bT btn btn-lg btn-default btn-block" onclick="tot(0)">TOT</button>
                        </div>
                    </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                        <div class="panel-heading"><h4>Prodotti</h4></div>
                        <div class="panel-body">
                            <?php
                            include "../connessione.php";
                            $sql ="SELECT * FROM prodotto INNER JOIN categoria ON prodotto.id_cat = categoria.id_cat  WHERE prodotto.vendita = 1 ORDER BY(prodotto.id_cat)";
                            foreach ($connessione->query($sql) as $row){
                                $colore = "btn-".$row['colore'];
                                $nome = $row['nome_p'];
                                $prezzo = $row['prezzo'];
                                $id_p = $row['id_prodotto'];
                                echo("<button type=\"button\" class=\"btn $colore btn-lg btn-block\" onclick=\"automatico($prezzo,'$nome','$id_p')\">$nome</button>");
                            }
                            $connessione = null;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="scontrino">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="headeS">
                                <h3>Torneo Supernova</h3>
                                <h5>dal 11 al 17 luglio 2016</h5>
                                <hr class="divisore">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="corpoS"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="footerS">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->


</body>

</html>