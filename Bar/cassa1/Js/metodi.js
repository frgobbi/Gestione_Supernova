/**
 * Created by francesco on 25/05/2016.
 */
function GPopup() {
    $('#overlay').fadeIn('slow');
    $('#popupBox').fadeIn('slow');

    $('#overlay, .deleteMeetingCancel').click(function () {
        $('#overlay').fadeOut('slow');
        $('#popupBox').fadeOut('slow');
        $('#popupContent').fadeOut('slow');
    });
}
/* CONTROLLO PER ESEGUIRE LA CHIUSURA*/
function modificachiusura(data, evento) {
    var e = evento;
    var name = "chiusura" + data;
    var key = "input[name=\"" + name + "\"]:checked";
    var b = $(key).val();
    console.log(b);
    if (b == 0) {
        //controllo se tutte le sere sono chiuse
        $.ajax({
            // definisco il tipo della chiamata
            type: "GET",
            // specifico la URL della risorsa da contattare
            url: "metodi/controlli/controlla_serate.php",
            // passo dei dati alla risorsa remota
            data: "evento=" + evento,
            // definisco il formato della risposta
            dataType: "html",
            // imposto un'azione per il caso di successo
            success: function (risposta) {
                if (risposta == 1) {
                    alert("chiudi tutte le serate prima di aprine una");
                    var FalseL = "#label" + data + "F";
                    var TrueL = "#label" + data + "T";

                    var False = "chiusura" + data + "F";
                    var True = "chiusura" + data + "T";

                    $(TrueL).removeClass("active");
                    $(FalseL).addClass("active");

                    document.getElementById(True).checked = false;
                    document.getElementById(False).checked = true;
                } else {
                    cambioC(data, e, b);
                }
            },
            // ed una per il caso di fallimento
            error: function () {
                alert("Chiamata fallita!!!");
            }
        });
    } else {
        cambioC(data, e, b);
    }
}
/* CONTROLLO PER ESEGUIRE IL RESET*/
function controllaReset(data,evento){
    var e = evento;
    //controllo se tutte le sere sono chiuse
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/controlli/controlla_serate.php",
        // passo dei dati alla risorsa remota
        data: "evento=" + evento,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {
            console.log(risposta);
            if (risposta == 1) {
                alert("chiudi tutte le serate prima di resettarne una!");
            } else {
                Reset(data, e);
            }
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });
}

/*CONTROLLO NUOVA SERATA*/
function controlloN(evento) {

/* Controllo serate aperte*/
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/controlli/controlla_serate.php",
        // passo dei dati alla risorsa remota
        data: "evento=" + evento,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {
            if (risposta == 1) {
                alert("chiudi tutte le serate prima di Crearne 1");
            } else {
                /* Controllo serata già presente*/
                $.ajax({
                    // definisco il tipo della chiamata
                    type: "GET",
                    // specifico la URL della risorsa da contattare
                    url: "metodi/controlli/serataEsistente.php",
                    // passo dei dati alla risorsa remota
                    //data: "data=" + dataC,
                    // definisco il formato della risposta
                    dataType: "html",
                    // imposto un'azione per il caso di successo
                    success: function (risposta) {
                        console.log(risposta);
                        if (risposta == 1) {
                            alert("Serata già inserita nel sistema!! :P");
                        } else {
                            new_serata(evento);
                        }
                    },
                    // ed una per il caso di fallimento
                    error: function () {
                        alert("Chiamata fallita!!!");
                    }
                });
            }
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });




}
/* CHIUSURA/APERTURA SERATA*/
function cambioC(data, evento, valore) {
    console.log("avvia");
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/cambio.php",
        // passo dei dati alla risorsa remota
        data: "evento=" + evento+"&data="+data+"&cambio="+valore,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {
            if (risposta == 1) {
                alert("Qualcosa è andato storto!!");
                var FalseL = "#label" + data + "F";
                var TrueL = "#label" + data + "T";

                var False = "chiusura" + data + "F";
                var True = "chiusura" + data + "T";

                $(TrueL).removeClass("active");
                $(FalseL).addClass("active");

                document.getElementById(True).checked = false;
                document.getElementById(False).checked = true;
            }
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });
}
/* RESET SERATA*/
function Reset(data, evento) {
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/resetS.php",
        // passo dei dati alla risorsa remota
        data: "evento=" + evento+"&data="+data,
        // definisco il formato della risposta
        dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {
            if (risposta == 0) {
                var FalseL = "#label" + data + "F";
                var TrueL = "#label" + data + "T";

                var False = "chiusura" + data + "F";
                var True = "chiusura" + data + "T";

                $(TrueL).addClass("active");
                $(FalseL).removeClass("active");

                document.getElementById(True).checked = true;
                document.getElementById(False).checked = false;

                var incasso = "#incasso"+data;
                var num_ord = "#numO"+data;

                $(incasso).replaceWith("<td id=\"incasso"+data+"\">0.00 €");
                $(num_ord).replaceWith("<td id=\"numO"+data+"\">0.00 €");

            }
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Chiamata fallita!!!");
        }
    });
}

/*INSERIMENTO NUOVA SERATA*/
function new_serata(evento) {
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/nuova_serata.php",
        // passo dei dati alla risorsa remota
        data: "evento=" + evento,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function (ogg) {
            var dati = $.parseJSON(ogg);
            console.log(dati.esito);
            if (dati.esito == 0) {


                var table = document.getElementById("Tserate");
                var R = document.getElementById("Tserate").rows.length;
                console.log(R);

                var row = table.insertRow(R);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                cell1.innerHTML = "<td>"+dati.dataS+"</td>";

                cell2.innerHTML = "<td>"+dati.evento+"</td>";;

                cell3.innerHTML = "<td id=\"$incasso"+dati.dataS+"\">"+dati.incasso+" &euro; </td>";

                cell4.innerHTML = "<td id=\"$numO"+dati.data+"\">"+dati.numero+"</td>";

                cell5.innerHTML = "<td align='center'><div class=\"btn-group\" id=\"status\" data-toggle=\"buttons\">"
                +"<label id=\"label"+dati.dataS+"T\" class=\"btn btn-default btn-on  active\">"
                +"<input type=\"radio\" value=\"0\" id=\"chiusura"+dati.dataS+"T\" name=\"chiusura"+dati.dataS+"\" onchange=\"modificachiusura('"+dati.dataS+"','"+evento+"')\" checked>ON</label>"
                +"<label id=\"label"+dati.dataS+"F\" class=\"btn btn-default btn-off\">"
                +"<input type=\"radio\" value=\"1\" id=\"chiusura"+dati.dataS+"F\" name=\"chiusura"+dati.dataS+"\" onchange=\"modificachiusura('"+dati.dataS+"','"+evento+"')\">OFF</label>"
                +"</div>"
                +"</td>";

                cell6.innerHTML = "<td align='center'><button id=\"reset"+dati.datsS+"\" class='btn btn-danger btn-lg' onclick=\"controllaReset('"+dati.dataS+"','"+evento+"')\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td>";

            }
        },
        // ed una per il caso di fallimento
        error: function () {
            alert("Problemi con la creazione di una nuova serata");
        }
    });    
}
