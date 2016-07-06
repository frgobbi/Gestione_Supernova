<?php

function barraLaterale($tipo, $percorso) {

    $link = explode("/", $percorso);
    $lunghezza = count($link);
    $connessione = null;
    
    include "../connessione.php";

    // esecuzione della query per la selezione dei record
    // query argomento del metodo query()
    try {
        foreach ($connessione->query("SELECT * FROM `staff` WHERE 1") as $row) {
            if ($row['username'] == $_SESSION['utente']) {
                $nome = $row['nome'] . " " . $row['cognome'];
                $img = $row['foto'];
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $connessione = null;

    require("nomi.php");
    $vet = nomi($tipo);
    //<!--Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    echo("<div class = \"collapse navbar-collapse navbar-ex1-collapse\">");
    echo("<ul class = \"nav navbar-nav side-nav\">");
    echo("<img id=\"imgP\" alt=\"Bootstrap Image Preview\" src=\"../$img\" style='width: 170px; height: 170px' class=\"img-circle\" />");
    echo("<li>");
    echo("<a href = \"../GestioneUtente/gestioneUtente.php\"><center>$nome</center></a>");
    echo("</li>");

    echo("<li class = \"active\">");
    echo("<a href='../Home/home.php'><i class=\"fa fa-tachometer\" aria-hidden=\"true\"></i> Home</a>");
    echo("</li>");
    for ($i = 0; $i < count($vet); $i++) {
        
        $sottolink = risorse($vet[$i][0]);
        if ($sottolink != null) {
            echo("<li>");
            echo("<a href = \"javascript:;\" data-toggle = \"collapse\" data-target = \"#demo" . $vet[$i][0] . "\"><i class = \"fa fa-fw " . $vet[$i][3] . "\"></i> " . $vet[$i][2] . " <i class = \"fa fa-fw fa-caret-down\"></i></a>");
            echo("<ul id = \"demo" . $vet[$i][0] . "\" class = \"collapse\">");
            for ($j = 0; $j < count($sottolink); $j++) {
                echo("<li>");
                echo("<a href = \"../" . $sottolink[$j][0] . "\">" . $sottolink[$j][1] . "</a>");
                echo("</li>");
            }
            echo("</ul>");
            echo("</li>");
        } else {
            echo("<li>");
            echo("<a href =\" ../" . $vet[$i][1] . "\"><i class = \"fa fa-fw " . $vet[$i][3] . "\"></i> " . $vet[$i][2] . "</a>");
            echo("</li>");
        }
    }
    echo("</ul>");
    echo("</div>");

}

function risorse($funzione) {

    switch ($funzione) {
        case 1:
            $vettore = array(
                array("Bar/cassa.php", "cassa","panel-yellow", "fa fa-pencil" ),
                array("Bar/Gprodotto.php", "Gestione Prodotti", "panel-red", "fa fa-pencil" )
            );
            break;
        //se c‘è il sole...
        case 2:
            $vettore = array(
                array("Torneo/squadre.php", "Squadre","panel-info", "fa fa-pencil" ),
                array("Torneo/giocatori.php", "Giocatori","panel-success", "fa fa-pencil"),
                array("Torneo/Gironi.php", "Gironi","panel-red", "fa fa-pencil"),
                array("Torneo/Partite.php", "Partite","panel-primary", "fa fa-pencil")
            );
            break;
        case 3:
            $vettore = null;
            break;
        case 4:
            $vettore = array(
                array("Admin/Staff.php", "Staff","panel-yellow", "fa fa-pencil")
            );
            break;
        default:
            $vettore = null;
    }
    return$vettore;
}
