<?php

function scegliStaff($tipo) {
        $connessione = null;
        include "../connessione.php";
        
    // esecuzione della query per la selezione dei record
    // query argomento del metodo query()
    try {
        foreach ($connessione->query("SELECT * FROM funzioni_staff INNER JOIN funzione on funzioni_staff.id_funzione = funzione.id_funzione WHERE id_staff = $tipo") as $row) {

            echo("<div class=\"col-lg-3 col-md-6\">");
            echo("<a href=\"../" . $row['src'] . "\">");
            echo("<div class=\"panel " . $row['color'] . "\">");
            echo("<div class=\"panel-heading\">");
            echo("<div class=\"row\">");
            echo("<div class=\"col-xs-3\">");
            echo("<i class=\"fa " . $row['icona'] . " fa-5x\"></i>");
            echo("</div>");
            echo("<div class=\"col-xs-9 text-right\">");
            echo("<div class=\"huge\">" . $row['nome_funzione'] . "</div>");

            echo("</div>");
            echo("</div>");
            echo("</div>");

            echo("<div class=\"panel-footer\">");
            echo("<span class=\"pull-left\">" . $row['descrizione'] . "</span>");
            echo("<span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>");
            echo("<div class=\"clearfix\"></div>");
            echo("</div>");

            echo("</div>");
            echo("</a>");
            echo("</div>");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $connessione = null;


    echo("<div class=\"col-lg-3 col-md-6\">");
    echo("<a href=\"#\">");
    echo("<div class=\"panel panel-primary\">");
    echo("<div class=\"panel-heading\">");
    echo("<div class=\"row\">");
    echo("<div class=\"col-xs-3\">");
    echo("<i class=\"fa fa-comment fa-5x\"></i>");
    echo("</div>");
    echo("<div class=\"col-xs-9 text-right\">");
    echo("<div class=\"huge\">Chat</div>");

    echo("</div>");
    echo("</div>");
    echo("</div>");

    echo("<div class=\"panel-footer\">");
    echo("<span class=\"pull-left\">Chat with whoever you want</span>");
    echo("<span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>");
    echo("<div class=\"clearfix\"></div>");
    echo("</div>");

    echo("</div>");
    echo("</a>");
    echo("</div>");



    echo("<div class=\"col-lg-3 col-md-6\">");
    echo("<a href=\"../GestioneUtente/gestioneUtente.php\">");
    echo("<div class=\"panel panel-danger\">");
    echo("<div class=\"panel-heading\">");
    echo("<div class=\"row\">");
    echo("<div class=\"col-xs-3\">");
    echo("<i class=\"fa fa-user fa-5x\"></i>");
    echo("</div>");
    echo("<div class=\"col-xs-9 text-right\">");
    echo("<div class=\"huge\">Utente</div>");

    echo("</div>");
    echo("</div>");
    echo("</div>");

    echo("<div class=\"panel-footer\">");
    echo("<span class=\"pull-left\">My account</span>");
    echo("<span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>");
    echo("<div class=\"clearfix\"></div>");
    echo("</div>");

    echo("</div>");
    echo("</a>");
    echo("</div>");
}
