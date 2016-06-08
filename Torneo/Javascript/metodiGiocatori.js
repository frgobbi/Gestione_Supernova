/**
 * Created by francesco on 05/06/2016.
 */
function elimina(id) {
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/deleteG.php",
        // passo dei dati alla risorsa remota
        data: "id=" + id,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function () {
            var key = "#giocatore" + id
            $(key).hide();
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });
}

function modifica(id, id_cat) {

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/DatiGiocatore.php",
        // passo dei dati alla risorsa remota
        data: "id_g=" + id,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {
            var cod = $.parseJSON(risposta);
            var key = "#dati" + id;

            var codice = "<div id='dati$id_giocatore' class=\"col-xs-12 col-sm-6\">"
                + "<div class=\"input-group\">"
                + "<label for=\"Nome" + id + "\">Nome:</label>"
                + "<input value='"+cod.nome+"' id='Nome" + id + "' name='Nome" + id + "' type=\"text\" class=\"form-control\">"
                + "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"Cognome" + id + "\">Cognome:</label>"
                + "<input value='"+cod.cognome+"' id='Cognome" + id + "' name='Cognome" + id + "' type=\"text\" class=\"form-control\">"
                + "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"data" + id + "\">Data di nascita:</label>"
                + "<input value='"+cod.data+"' type=\"date\" id=\"data" + id + "\" name=\"data" + id + "\" class=\"form-control floating-label\" required>";
            codice += "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"Luogo" + id + "\">Luogo di nascita:</label>"
                + "<input value='"+cod.luogo+"' id='Luogo" + id + "' name='Luogo" + id + "' type=\"text\" class=\"form-control\">"
                + "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"Codice" + id + "\">Codice Fiscale: <small>(Via Paolo Rossi 5 Corciano)</small></label>"
                + "<input value='"+cod.codice+"' class=\"form-control\" type=\"text\" id=\"Codice\" name='Codice' onkeyup=\"this.style.textTransform='uppercase'\" required>"
                + "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"Via" + id + "\">Residenza: <small>(Via Paolo Rossi 5 Corciano)</small></label>"
                + "<input value='"+cod.Res+"' id='Via" + id + "' name='Via" + id + "' type=\"text\" class=\"form-control\">"
                + "</div>"
                + "<div class=\"input-group\">"
                + "<label for=\"Squadra" + id + "\">Squadra:</label>"
                + "<select id='Squdra" + id + "' name='Squdra" + id + "' class='form-control'></select>"
                + "</div>"
                + "</div>";

            $(key).replaceWith(codice);
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });


}
