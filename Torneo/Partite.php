<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 14/06/2016
 * Time: 16:11
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
    <link rel="stylesheet" href="CSS/Event-List.css">
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
                <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Partite</h4></div>
                        <div id="panel-eventi" class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                                    <ul class="event-list">
                                        <?php
                                        $evento = $_SESSION['id_evento'];
                                        include "../connessione.php";
                                        try {
                                            foreach ($connessione->query("SELECT * FROM `partita` INNER JOIN sq_partita ON partita.id_partita = sq_partita.id_p INNER JOIN squadra ON squadra.id_sq = sq_partita.id_sq WHERE id_evento = 1 GROUP BY(id_partita)") as $row) {
                                                echo "<li>"
                                                    . "<time datetime=\"2014-07-20\">"
                                                    . "<span class=\"day\">31 Luglio</span>"
                                                    . "<span class=\"month\">12:00 - 12:35</span>"
                                                    . "<span class=\"year\">2014</span>"
                                                    . "<span class=\"time\">ALL DAY</span>"
                                                    . "</time>"
                                                    . "<div class=\"info\">"
                                                    . "<table class=\"table table-hover\">"
                                                    . "<thead>"
                                                    . "<tr align='center' style='font-size: 25px;'>"
                                                    . "<th>Firstname</th>"
                                                    . "<th>VS</th>"
                                                    . "<th>Email</th>"
                                                    . "</tr>"
                                                    . "</thead>"
                                                    . "<tbody>"
                                                    . "<tr align='center' style='font-size: 25px;'>"
                                                    . "<td><strong>3</strong></td>"
                                                    . "<td><strong>-</strong></td>"
                                                    . "<td><strong>3</strong></td>"
                                                    . "</tr>"
                                                    . "</tbody>"
                                                    . "</table>"
                                                    /*. "<ul>"
                                                        . "<li style=\"width:50%;\">"
                                                            . "<button type='button' class='btn btn-primary btn-md'>Informazioni partita</button>"
                                                        . "</li>"
                                                    . "</ul>"*/
                                                    . "</div>"
                                                    . "<div class=\"social\">"
                                                    . "<ul>"
                                                    . "<li class=\"facebook\">"
                                                    . "<a href=\"#facebook\">"
                                                    . "<span class=\"fa fa-facebook\"></span>"
                                                    . "</a>"
                                                    . "</li>"
                                                    . "<li class=\"facebook\">"
                                                    . "<a href=\"#facebook\" data-toggle=\"modal\" data-target=\"#myModal\">"
                                                    . "<span class=\"fa fa-info-circle\" aria-hidden=\"true\"></span>"
                                                    . "</a>"
                                                    . "</li>"
                                                    . "<li class=\"trash\">"
                                                    . "<a href=\"#google-plus\">"
                                                    . "<span class=\"fa fa-trash\"></span>"
                                                    . "</a>"
                                                    . "</li>"
                                                    . "</ul>"
                                                    . "<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">"
                                                    . "<div class=\"modal-dialog\">"
                                                    . "<div class=\"modal-content\">"
                                                    . "<div class=\"modal-header\">"
                                                    . "<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>"
                                                    . "<h4 class=\"modal-title\">Modal Header</h4>"
                                                    . "</div>"
                                                    . "<div class=\"modal-body\">"
                                                    . "<p>Some text in the modal.</p>"
                                                    . "</div>"
                                                    . "<div class=\"modal-footer\">"
                                                    . "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>"
                                                    . "</div>"
                                                    . "</div>"
                                                    . "</div>"
                                                    . "</div>"
                                                    . "</div>"
                                                    . "</li>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "error: " . $e->getMessage();
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h4>Crea Partite Gironi</h4></div>
                        <div class="panel-body">
                            <form method="post" action="metodi/partiteGironi.php">
                                <?php
                                include "../connessione.php";
                                try {
                                    $partiteA = $connessione->query("SELECT id_partita, finish, fase_finale, id_evento FROM `partita` INNER JOIN sq_partita ON partita.id_partita = sq_partita.id_p INNER JOIN squadra ON sq_partita.id_sq = squadra.id_sq WHERE fase_finale=0 AND id_evento = 1 AND finish = 0 GROUP BY (id_partita)")->rowCount();
                                } catch (PDOException $e) {
                                    echo "error: " . $e->getMessage();
                                }
                                $connessione = null;
                                if ($partiteA > 0) {
                                    echo "<button type=\"button\" class=\"btn btn-lg btn-block btn-info\" onclick=\"alert('fai finire tutte le partite')\">Crea partite Gioroni</button>";
                                } else {
                                    echo "<button type=\"button\" class=\"btn btn-lg btn-block btn-info\" onclick=\"submit()\">Crea partite Gioroni</button>";
                                }
                                ?>
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