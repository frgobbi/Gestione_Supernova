<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 12/06/2016
 * Time: 11:26
 */
session_start();
if (!$_SESSION['login']) {
    echo "<script type='text/javascript'>location.href=\"../index.php\"</script>";
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include '../Librerie/Base/librerie.php';
    Ll1();
    ?>

    <script type="application/javascript" src="Javascript/controllaGirone.js"></script>
    <style type="text/css">
        .btn span.glyphicon {
            opacity: 0;
        }

        .btn.active span.glyphicon {
            opacity: 1;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php
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
                        <div class="panel-heading" align="center"><h4>Gironi</h4></div>
                        <div class="panel-body">
                            <?php
                            $evento = $_SESSION['id_evento'];
                            $controllo = 0;
                            include "../connessione.php";
                            try {
                                foreach ($connessione->query("SELECT * FROM `squadra` WHERE `id_evento` = 1") as $row) {
                                    if ($row['id_girone'] == NULL) {
                                        $controllo = 1;
                                        break;
                                    }
                                }

                                if ($controllo != 0) {
                                    echo "<div class='table-responsive'>"
                                        . "<table class='table table-hover table-bordered'>"
                                        . "<thead>"
                                        . "<tr>"
                                        . "<th>Nome Squdra</th>"
                                        . "<th>Punti</th>"
                                        . "<th>Partite Vinte</th>"
                                        . "<th>Partite Perse</th>"
                                        . "<th>Partite Pareggiate</th>"
                                        . "<th>Gol Fatti</th>"
                                        . "<th>Gol Subiti</th>"
                                        . "<th>Differenza reti</th>"
                                        . "</tr>"
                                        . "</thead>"
                                        . "<tbody>";
                                    foreach ($connessione->query("SELECT * FROM `squadra` WHERE `id_evento` = 1") as $row) {
                                        $id_squadra = $row['id_sq'];
                                        $punti = $connessione->query("SELECT SUM(esito) AS punti FROM sq_partita WHERE id_sq = $id_squadra")->fetch(PDO::FETCH_OBJ);
                                        if ($punti->punti == NULL) {
                                            $punteggio = 0;
                                        } else {
                                            $punteggio = $punti->punti;
                                        }
                                        $PartiteV = $connessione->query("SELECT COUNT(esito) AS Pvinte FROM sq_partita WHERE id_sq = $id_squadra AND esito = 3")->fetch(PDO::FETCH_OBJ);
                                        $PartiteP = $connessione->query("SELECT COUNT(esito) AS Pperse FROM sq_partita WHERE id_sq = $id_squadra AND esito = 0")->fetch(PDO::FETCH_OBJ);
                                        $PartitePa = $connessione->query("SELECT COUNT(esito) AS Ppareggio FROM sq_partita WHERE id_sq = $id_squadra AND esito = 1")->fetch(PDO::FETCH_OBJ);
                                        $GolF = $connessione->query("SELECT COUNT(gol) Gol_F  FROM giocatore INNER JOIN partita_giocatore ON giocatore.id_g = partita_giocatore.id_giocatore WHERE id_squadra = $id_squadra AND Gol = 1")->fetch(PDO::FETCH_OBJ);
                                        $GolS = $connessione->query("SELECT COUNT(gol) Gol_S FROM giocatore INNER JOIN partita_giocatore ON giocatore.id_g = partita_giocatore.id_giocatore WHERE id_partita = ( SELECT id_p FROM sq_partita WHERE id_sq = $id_squadra ) AND id_squadra != $id_squadra AND Gol = 1")->fetch(PDO::FETCH_OBJ);
                                        $Diffgol = $GolF->Gol_F - $GolS->Gol_S;
                                        echo "<tr>"
                                            . "<td>" . $row['nomeSQ'] . "</td>"
                                            . "<td>$punteggio</td>"
                                            . "<td>$PartiteV->Pvinte</td>"
                                            . "<td>$PartiteP->Pperse</td>"
                                            . "<td>$PartitePa->Ppareggio</td>"
                                            . "<td>$GolF->Gol_F</td>"
                                            . "<td>$GolS->Gol_S</td>"
                                            . "<td>$Diffgol</td>"
                                            . "</tr>";
                                    }
                                    echo "</tbody>"
                                        . "</table>"
                                        . "</div>";
                                }/* else {
                                    echo "<div class='table-responsive'>";
                                    foreach ($connessione->query("SELECT nome_g, id_girone FROM `squadra` NATURAL JOIN girone WHERE id_evento = 1 GROUP BY(id_girone)") as $row) {
                                        $id_g = $row['id_girone'];
                                        $nome_g = $row['nome_g'];
                                        echo "<table class='table table-hover table-bordered'>"
                                            . "<thead>"
                                            . "<tr>Girone $nome_g</tr>"
                                            . "<tr>"
                                            . "<th>Nome Squdra</th>"
                                            . "<th>Punti</th>"
                                            . "<th>Partite Vinte</th>"
                                            . "<th>Partite Perse</th>"
                                            . "<th>Partite Pareggiate</th>"
                                            . "<th>Gol Fatti</th>"
                                            . "<th>Gol Subiti</th>"
                                            . "<th>Differenza reti</th>"
                                            . "</tr>"
                                            . "</thead>"
                                            . "<tbody>";
                                        foreach ($connessione->query("SELECT * FROM `squadra` WHERE `id_evento` = 1 AND id_girone = '$id_g'") as $row) {
                                            $id_squadra = $row['id_sq'];
                                            $punti = $connessione->query("SELECT SUM(esito) AS punti FROM sq_partita WHERE id_sq = $id_squadra")->fetch(PDO::FETCH_OBJ);
                                            if ($punti->punti == NULL) {
                                                $punteggio = 0;
                                            } else {
                                                $punteggio = $punti->punti;
                                            }
                                            $PartiteV = $connessione->query("SELECT COUNT(esito) AS Pvinte FROM sq_partita WHERE id_sq = $id_squadra AND esito = 3")->fetch(PDO::FETCH_OBJ);
                                            $PartiteP = $connessione->query("SELECT COUNT(esito) AS Pperse FROM sq_partita WHERE id_sq = $id_squadra AND esito = 0")->fetch(PDO::FETCH_OBJ);
                                            $PartitePa = $connessione->query("SELECT COUNT(esito) AS Ppareggio FROM sq_partita WHERE id_sq = $id_squadra AND esito = 1")->fetch(PDO::FETCH_OBJ);
                                            $GolF = $connessione->query("SELECT COUNT(gol) Gol_F  FROM giocatore INNER JOIN partita_giocatore ON giocatore.id_g = partita_giocatore.id_giocatore WHERE id_squadra = $id_squadra AND Gol = 1")->fetch(PDO::FETCH_OBJ);
                                            $GolS = $connessione->query("SELECT COUNT(gol) Gol_S FROM giocatore INNER JOIN partita_giocatore ON giocatore.id_g = partita_giocatore.id_giocatore WHERE id_partita = ( SELECT id_p FROM sq_partita WHERE id_sq = $id_squadra ) AND id_squadra != $id_squadra AND Gol = 1")->fetch(PDO::FETCH_OBJ);
                                            $Diffgol = $GolF->Gol_F - $GolS->Gol_S;
                                            echo "<tr>"
                                                . "<td>" . $row['nomeSQ'] . "</td>"
                                                . "<td>$punteggio</td>"
                                                . "<td>$PartiteV->Pvinte</td>"
                                                . "<td>$PartiteP->Pperse</td>"
                                                . "<td>$PartitePa->Ppareggio</td>"
                                                . "<td>$GolF->Gol_F</td>"
                                                . "<td>$GolS->Gol_S</td>"
                                                . "<td>$Diffgol</td>"
                                                . "</tr>";
                                        }
                                        echo "</tbody>"
                                            . "</table>";
                                    }
                                    echo "</div>";
                                }*/
                            } catch (PDOException $e) {
                                echo "error: " . $e->getMessage();
                            }
                            $connessione = null;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="panel panel-red">
                        <div class="panel-heading"><h4>Crea Girone</h4></div>
                        <div class="panel-body">
                            <form method="post" action="metodi/creaGirone.php">
                                <div id="DGnomeG" class="form-group">
                                    <label for="nomeG">Nome Girone</label>
                                    <input class="form-control" type="text" onblur="controllaG('nomeG')" id="nomeG"
                                           name="nomeG" required>
                                    <span id="GSnomeG" class="glyphicon glyphicon-ok form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                    <span id="GnomeG" class="glyphicon glyphicon-remove form-control-feedback"
                                          style="display: none" aria-hidden="true"></span>
                                </div>
                                <button type="submit" class="btn btn-primary brn-lg btn-block">Inserisci Girone</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-yellow">
                        <div class="panel-heading"><h4>Assegna gironi</h4></div>
                        <div class="panel-body">
                            <form id="AssegnaG" method="post" action="metodi/AssegnaGironi.php">
                                <div data-toggle="buttons">
                                    <?php
                                    include "../connessione.php";
                                    try {
                                        foreach ($connessione->query("SELECT * FROM `girone`") as $row) {
                                            $id_girone = $row['id_girone'];
                                            $nome_g = $row['nome_g'];
                                            echo "<label class=\"btn btn-info\">"
                                                . "<input type=\"checkbox\" name='gironi[]' value='$id_girone' autocomplete=\"off\">"
                                                . "<span class=\"glyphicon glyphicon-ok\"></span>"
                                                . "</label>&nbsp;"
                                                . "<label>Girone $nome_g</label><br>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "error: " . $e->getMessage();
                                    }
                                    $connessione = null;
                                    ?>
                                    <div class="form-group">
                                        <label for="numeroSQ">Numero Squdre per girone:</label>
                                        <input class="form-control" type="text" name="numeroSQ" id="numeroSQ">
                                    </div>
                                    <?php
                                    if($controllo != 0){
                                        echo"<button class=\"btn btn-primary brn-lg btn-block\" name=\"assegna\" id=\"assegna\" onclick=\"submit()\">Genera Gironi</button>";
                                    }
                                    else{
                                        echo"<button class=\"btn btn-primary brn-lg btn-block disabled\" name=\"assegna\" id=\"assegna\" onclick=\"submit()\">Genera Gironi</button>";
                                    }
                                    ?>
                            </form><br>
                            <form method="post" action="metodi/eliminaG.php">
                            <button class="btn btn-danger brn-lg btn-block" name="deleteG" id="deleteG" onclick="submit()">elimina Gironi</button>
                            </form>
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

