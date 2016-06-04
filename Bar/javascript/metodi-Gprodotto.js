/**
 * Created by francesco on 29/05/2016.
 */
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
        } else {
            switch (colors[i]) {
                case "danger":
                    codiceC = codiceC + "<option value=\"danger\" selected>Rosso</option>";
                    break;
                case "warning":
                    codiceC = codiceC + "<option value=\"warning\" selected>Giallo</option>";
                    break;
                case "success":
                    codiceC = codiceC + "<option value=\"success\" selected>Verde</option>";
                    break;
                case "primary":
                    codiceC = codiceC + "<option value=\"primary\" selected>Blu</option>";
                    break;
                case "info":
                    codiceC = codiceC + "<option value=\"info\" selected>Celeste</option>";
                    break;
                case "default":
                    codiceC = codiceC + "<option value=\"default\" selected>Bianco</option>";
                    break;
            }
        }
    }
    codiceC += "</select>"
        +"</td>";


    var keyM = "#modifica"+id;
    var keyD = "#elimina"+id;
    $(keyC).replaceWith(codiceC);
    $(keyM).replaceWith("<td id=\"conferma"+id+"\" align='center'><button onclick=\"confermaC("+id+")\" class='btn btn-success btn-md '><i class=\"fa fa-check\" aria-hidden=\"true\"></i></button></td>");
    $(keyD).replaceWith("<td id=\"annulla"+id+"\" align='center'><button onclick=\"visualizzaC("+id+")\" class='btn btn-danger btn-md '><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button></td>");

}

function visualizzaC(id){

    var keyC = "#colore"+id;
    var keyM = "#conferma"+id;
    var keyD = "#annulla"+id;
    var keyN = "#nome"+id;
    var colore
    
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/datiCategoria.php",
        // passo dei dati alla risorsa remota
        data: "id_cat=" + id,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function (ogg) {
            var dati = $.parseJSON(ogg);
            var codiceN = "<td id=\"nome"+dati.id+"\">"+dati.nome+"</td>";
            switch (dati.colore){
                case "danger":  colore =  "<td id=\"colore"+dati.id+"\">Rosso</td>";
                    break;
                case "warning":  colore = "<td id=\"colore"+dati.id+"\">Giallo</td>";
                    break;
                case "success":  colore = "<td id=\"colore"+dati.id+"\">Verde</td>";
                    break;
                case "primary":  colore = "<td id=\"colore"+dati.id+"\">Blu</td>";
                    break;
                case "info":  colore = "<td id=\"colore"+dati.id+"\">Celeste</td>";
                    break;
                case "default": colore = "<td id=\"colore"+dati.id+"\">Bianco</td>";
                    break;
            }
            var codiceM = "<td id=\"modifica"+dati.id+"\" align='center'><button onclick='modCAT("+dati.id+",\""+dati.colore+"\")' class='btn btn-primary btn-md'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button></td>";
            var codiceD = "<td id=\"elimina"+dati.id+"\" align='center'><button onclick='deleteCAT("+dati.id+")' class='btn btn-danger btn-md '><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";

            $(keyN).replaceWith(codiceN);
            $(keyC).replaceWith(colore);
            $(keyM).replaceWith(codiceM);
            $(keyD).replaceWith(codiceD);


        },
        error: function () {
            alert("Problemi ");
        }
    });
}

function confermaC(id){
    var key = "Select"+id;
    var Select = document.getElementById(key);
    var valore = Select.options[Select.selectedIndex].value;
    //console.log(valore);

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/cambioCategoria.php",
        // passo dei dati alla risorsa remota
        data: "id_cat=" + id+"&color="+valore,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function () {
            visualizzaC(id);
        },
        error: function () {
            alert("Problemi con il cambio di colore");
        }
    });
}


function deleteCAT(id) {
    var domanda = confirm("Sicuro di voler cancellare ?? \n Verranno cancellati tutti i prodotti di questa categira");
    if (domanda === true) {
        $.ajax({
            // definisco il tipo della chiamata
            type: "GET",
            // specifico la URL della risorsa da contattare
            url: "metodi/esecuzioni/deleteCat.php",
            // passo dei dati alla risorsa remota
            data: "id_cat=" + id,
            // definisco il formato della risposta
            //dataType: "json",
            // imposto un'azione per il caso di successo
            success: function () {
                window.location.href="Gprodotto.php";
            },
            error: function () {
                alert("Problemi con il cambio di colore");
            }
        });
    }else{
        
    }
}

function controlloNullIns() {

    cbObj = document.getElementById('nullable');
    if (cbObj.checked){
        document.getElementById("disponibilita").value = "Nessun vincolo";
    }else{
        document.getElementById("disponibilita").value= "";
    }
}

function controlloNull(id_p) {
    var key = "nullable"+id_p;
    var keyD = "disponibilita"+id_p;
    cbObj = document.getElementById(key);
    if (cbObj.checked){
        document.getElementById(keyD).value = "Nessun vincolo";
    }else{
        document.getElementById(keyD).value= "";
    }
}

function eliminazione(id_p) {
    var keyP = "#contenutoP"+id_p;

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/deleteProdotto.php",
        // passo dei dati alla risorsa remota
        data: "id_p=" + id_p,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function () {
            //window.location.href="Gprodotto.php";
            $(keyP).hide();
        },
        error: function () {
            alert("Problemi con l'eliminazione del prodotto");
        }
    });
}

function modifica(id_p, nome_p, cat, prezzo, disp){
        var key = "#contenutoP" + id_p;
        if (disp.localeCompare("null") == 0) {
            disponibilita = "Nessun Vincolo";
        } else {
            disponibilita = disp;
        }
        var codice = "<li id=\"contenutoP"+id_p+"\" class=\"list-group-item\">"
            + "<div class=\"col-xs-12 col-md-9 col-md-offset-1 col-sm-12\">"
            + "<div class=\"col-xs-12 col-md-9 col-sm-12\">"
            + "<span class=\"name\">" + nome_p + "</span><br/>"
            + "<label for=\"nomeP" + id_p + "\">Nome Prodotto:</label><input type='text' id=\"nomeP" + id_p + "\" name=\"nomeP" + id_p + "\" class=\"form-control\" value=\"" + nome_p + "\"/>"
            + "<label for=\"prezzoP" + id_p + "\">Prezzo:</label><input type='text' id=\"prezzoP" + id_p + "\" name=\"prezzoP" + id_p + "\" class=\"form-control\" value=\"" + prezzo + "\"/>"
            + "<label for=\"disponibilita"+id_p+"\">Disponibilit&agrave: (spunta per nessun vincolo)</label>"
            +"<div class=\"input-group\">"
            +"<input value='"+disponibilita+"' type=\"text\" class=\"form-control\" id=\"disponibilita"+id_p+"\" name=\"disponibilita"+id_p+"\"/>"
            +"<span class=\"input-group-btn\">"
            +"<div class=\"btn-group\" data-toggle=\"buttons\">"
            if (disp.localeCompare("null") == 0) {
                
                codice += "<label class=\"btn btn-primary active\">" +
                    "<input id=\"nullable" + id_p + "\" name=\"nullable" + id_p + "\" type=\"checkbox\" autocomplete=\"off\" onchange=\"controlloNull(" + id_p + ")\" checked>";
            }
            else {
                codice +="<label class=\"btn btn-primary\">" +
                    "<input id=\"nullable"+id_p+"\" name=\"nullable"+id_p+"\" type=\"checkbox\" value=\"0\" onchange=\"controlloNull("+id_p+")\">";
            }
            codice +="<span class=\"glyphicon glyphicon-ok\"></span>"
            +"</label>"
            +"</div>"
            +"</span>"
            +"</div>";
        codice += "<label for=\"selectC" + id_p + "\">Categoria:</label>" +
            "<select id=\"selectC" + id_p + "\" name=\"selectC" + id_p + "\" class=\"form-control\">";

        codice += "</select>";
        codice += "</div>"
            + "<div class=\"col-xs-12 col-md-2 col-sm-12\"><br>"
            + "<button type=\"button\" class=\"btn btn-md btn-success disable-button btn-block\" onclick=\"modificaP(" + id_p + ")\"><i class=\"fa fa-check\"></i></button><br><br>"
            + "<button type=\"button\" href=\"#\" class=\"btn btn-md btn-danger disable-button btn-block\" onclick=\"visualizza_P("+id_p+")\"><i class=\"fa fa-times\"></i></button>"
            + "</div>"
            + "</div>"
            + "<div class=\"clearfix\"></div>"
            + "</li>";


        $(key).replaceWith(codice);

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/recuperoCAT.php",
        // passo dei dati alla risorsa remota
        //data: "id_cat=" + id,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function (ogg) {
            var dati = $.parseJSON(ogg);
            /*console.log(cat);
            console.log(dati.id);*/
            var codiceS = "<select id=\"selectC" + id_p + "\" name=\"selectC" + id_p + "\" class=\"form-control\">";
            for (var k in dati) {
                if(dati[k]['id'] == cat){
                    //console.log("trovato");
                    codiceS += "<option value=\"" + dati[k]['id'] + "\" selected>" + dati[k]['nome'] + "</option>";
                }
                else{
                    //console.log("nontrovato");
                    codiceS += "<option value=\"" + dati[k]['id'] + "\">" + dati[k]['nome'] + "</option>";
                }

            }
            codiceS += "</select>";
            var keyS = "#selectC"+id_p;
            $(keyS).replaceWith(codiceS);
        }
    });

}


function visualizza_P(id) {
    var key = "#contenutoP" + id;
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/datiProdotto.php",
        // passo dei dati alla risorsa remota
        data: "id_P=" + id,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function (ogg) {
            var dati = $.parseJSON(ogg);
            var Disp;
            if(dati.disp.localeCompare("Nessun Vincolo")==0){
                Disp = "null";
            } else {
                Dsip = dati.disp;
            }


            var prodotto = "<li id=\"contenutoP"+dati.id+"\" class=\"list-group-item\">"
                +"<div class=\"col-xs-12 col-md-9 col-md-offset-1 col-sm-12\">"
                + "<div class=\"col-xs-12 col-md-9 col-sm-12\">"
                + "<span class=\"name\">" +dati.nome + "</span><br/>"
                + "<span class=\"testo-grassetto\">Categoria</span><span class=\"testo\">&nbsp; " +dati.nome_cat+ "</span><br/>"
                + "<span class=\"testo-grassetto\">Prezzo:</span><span class=\"testo\">&nbsp; " +dati.prezzo+ " €</span><br/>"
                + "<span class=\"testo-grassetto\">Disponibilt&agrave;</span><span class=\"testo\">&nbsp;"+dati.disp+"</span><br/>";

            prodotto += "</div>"
                +"<div class=\"col-xs-12 col-md-2 col-sm-12\"><br>"
                + "<button type=\"button\" class=\"btn btn-md btn-danger btn-block\" onclick=\"eliminazione("+dati.id+")\"><i class=\"fa fa-trash\"></i></button><br><br>"
                + "<button type=\"button\" href=\"#\" class=\"btn btn-md btn-success btn-block\" onclick=\"modifica('"+dati.id+"','"+dati.nome+"','"+dati.id_cat+"','"+dati.prezzo+"','"+Disp+"')\"><i class=\"fa fa-pencil\"></i></button>"
                + "</div>"
                +"</div>"
                + "<div class=\"clearfix\"><br><br>"
                +"<div class=\"form-group\">"
                +"<div class=\"material-switch pull-right\">";
            if(dati.vendita == 1){
                prodotto +=  "<input type=\"checkbox\" id=\"vendita"+dati.id+"\" name=\"vendita"+dati.id+"\" onchange=\"vendita("+dati.id+")\" checked/>"
            } else{
                prodotto +=  "<input type=\"checkbox\" id=\"vendita"+dati.id+"\" name=\"vendita"+dati.id+"\" onchange=\"vendita("+dati.id+")\"/>";
            }
            prodotto += "<label for=\"vendita"+dati.id+"\" class=\"label-"+dati.colore+"\"></label>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</li>";

            $(key).replaceWith(prodotto);

        },
        error: function () {
            alert("Problemi ");
        }
    });
}


function modificaP(id_p){
    var keyN = "nomeP"+id_p;
    var keyP = "prezzoP"+id_p;
    var keyD = "disponibilita"+id_p;
    var keyC = "selectC"+id_p;
    var keyNull = "nullable"+id_p;
    var disponibilita;
    var nome = document.getElementById(keyN).value;
    var prezzo = document.getElementById(keyP).value;

    var Oselect = document.getElementById(keyC);
    var cat = Oselect.options[Oselect.selectedIndex].value;

    cbObj = document.getElementById(keyNull);
    if (cbObj.checked){
        //console.log("attivo");
        disponibilita = "null";
    } else {
        disponibilita = document.getElementById(keyD).value;
    }

    //console.log(disponibilita);

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/modificaProdotto.php",
        // passo dei dati alla risorsa remota
        data: "id_p="+id_p+"&nome="+nome+"&prezzo="+prezzo+"&cat="+cat+"&disp="+disponibilita,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function () {
            visualizza_P(id_p)
        },
        error: function () {
            alert("qualcosa è andato storto");
        }
    });
}

function vendita(id_p){
    var key = "vendita"+id_p;
    var parametro;
    cbObj = document.getElementById(key);
    if (cbObj.checked){
        parametro = "attivo";
    } else {
        parametro = "spento";
    }

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/cambioAttivita.php",
        // passo dei dati alla risorsa remota
        data: "id_p="+id_p+"&attivita="+parametro,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function () {

        },
        error: function () {
            alert("qualcosa è andato storto");
        }
    });


}
