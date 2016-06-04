<!DOCTYPE html>
<html lang="it">

    <head>
        <?php
        include 'Librerie/Base/librerie.php';
        Lesterne();
        ?>
        <link rel="stylesheet" href="Librerie/CSS/Unlog.css">
        <style type="text/css">


            #page-wrapper{
                height: 900px;
            }
            footer{
                padding: 0;
                background-color: #C0C0C0;
                height: 80px;
            }

            .carousel-inner > .item > img,
            .carousel-inner > .item > img{
                width: 700px;
                height: 500px;
                margin: auto;
            }
            
            @media screen and (max-width: 768px) {
            .carousel-inner > .item > img,
            .carousel-inner > .item > img{
                width: 700px;
                height:300px;
                margin: auto;
            }
            
            #page-wrapper{
                height: 100%;
            }
            
            }

            #slider, #bottoni{
                padding-top: 50px;
            }

            #bottoni > .btn{
                height: 80px;
            }
        </style>
        
        <script type="text/javascript">
            function chiuso() {
                alert("funzionalita' non ancora disponibile");    
            }
            
            function iscriviti() {
                var id_evento = 1;
                $.ajax({
                    // definisco il tipo della chiamata
                    type: "GET",
                    // specifico la URL della risorsa da contattare
                    url: "metodiIndex/Num-Sq.php",
                    // passo dei dati alla risorsa remota
                    data: "id="+id_evento,
                    // definisco il formato della risposta

                    // imposto un'azione per il caso di successo
                    success: function(risposta){
                         if(risposta >= 9){
                             alert("Si sono già iscritte il numero massimo di squdre... contatta gli organizzatori per informazioni");
                         } else {
                             window.location.href='Public/Iscrizione.php';
                         }
                    },
                    // ed una per il caso di fallimento
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });
            }
        </script>
    </head>
    <body>
    <div id="page">
        <?php
        require 'ComponentiBase/nav.php';
        navUnlog();
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Torneo Supernova
                            <small>dal 11 luglio al 17 luglio 2016</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div id="slider" class="col-lg-6">
                        <?php
                        echo("<div id=\"myCarousel\" class=\"carousel slide\"\" data-ride=\"carousel\">");
                        $cartella = "ImmaginiApp/ImmaginiGalleria";
                        $elencoFile = array();
                        if ($handle = opendir($cartella)) {
                            while (($file = readdir($handle)) !== false) {
                                if ($file != "." && $file != "..") {
                                    $elencoFile[] = $file;
                                }
                            }
                        }
                        closedir($handle);

                        echo("<ol class=\"carousel-indicators\">");
                        echo("<li data-target=\"#myCarousel\" data-slide-to=\"0\" class=\"active\"></li>");
                        for ($i = 1; $i < count($elencoFile); $i++) {
                            echo("<li data-target=\"#myCarousel\" data-slide-to=\"" . $i . "\"></li>");
                        }
                        echo("</ol>");

                        echo("<div class=\"carousel-inner\" role=\"listbox\">");
                        echo("<div class=\"item active\">");
                        echo("<img src=\"" . "ImmaginiApp/ImmaginiGalleria/" . $elencoFile[0] . "\"width=\"400\" height=\"325\">");
                        echo("</div>");

                        for ($i = 1; $i < count($elencoFile); $i++) {
                            echo("<div class=\"item\">");
                            echo("<img src=\"" . "ImmaginiApp/ImmaginiGalleria/" . $elencoFile[$i] . "\"width=\"400\" height=\"325\">");
                            echo("</div>");
                        }
                        echo("</div>");

                        echo("<a class=\"left carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"prev\">");
                        echo("<span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span>");
                        echo("<span class=\"sr-only\">Previous</span>");
                        echo("</a>");
                        echo("<a class=\"right carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"next\">");
                        echo("<span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>");
                        echo("<span class=\"sr-only\">Next</span>");
                        echo("</a>");
                        echo("</div>");
                        ?>
                        <br> <br>
                        <h3 align="center">Per info sul torneo</h3>
                        <button class="btn btn-primary btn-lg btn-block" onclick="window.location.href='https://www.facebook.com/events/987011811414751/?notif_t=plan_user_joined&notif_id=1464116569830960'">Evento facebook <i class="fa fa-facebook" aria-hidden="true"></i></button>
                    </div>
                    <div id="bottoni" class="col-lg-4 col-lg-offset-1">
                        <button type="button" class="btn btn-lg btn-primary btn-block" onclick="chiuso()">Visualizza Classifica</button><br/>
                        <button type="button" class="btn btn-lg btn-info btn-block" onclick="chiuso()">Visualizza Marcatori</button><br/>
                        <button type="button" class="btn btn-lg btn-success btn-block" onclick="chiuso()">Risultati Partite</button><br/>
                        <button type="button" class="btn btn-lg btn-warning btn-block" onclick="chiuso()">Visualizza Foto Torneo</button><br/>
                        <button type="button" class="btn btn-lg btn-danger btn-block" onclick="iscriviti()">Iscriviti al Torneo</button><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <!--<footer>
        <p>&copy; Company 2015</p>
    </footer>-->
</html>