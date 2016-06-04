/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global FALSE */
var i;
var k = 0;
var n = "";
var prezzi = [];
var attributi = [];
var qua = [];
var Ptot = [];
var idProdotti = [];
var b = 0;
var totale = 0;
var resto = 0;
var moltiplicatore = 0;

//SRITTURA SCONTRINO VIRTUALE
function scontrino() {
    $("#corpoS").html("");
    $("#footerS").html("");
    var tot = 0;
    for (i = 0; i < attributi.length; i++) {
        $("#corpoS").append("" + attributi[i] + ":  &nbsp;&nbsp;" + qua[i] + "X &nbsp;&nbsp;" + prezzi[i] + "€&nbsp;&nbsp;&nbsp;&nbsp;Tot:" + (qua[i] * prezzi[i]) + "€<br>");
        tot += (qua[i] * prezzi[i]);
    }
    $("#footerS").html("<hr class=\"divisore\">Totale: " + tot + " €");
}

/*function scontrinoCanc() {
    $("#corpoS").html("");
    $("#footerS").html("");
    document.getElementById("display").innerHTML = "";
}*/
//BOTTONE MOLTIPLICA PRODOTTO
function X() {
    moltiplicatore = $("#display").val();
    console.log(moltiplicatore);
    document.getElementById("display").innerHTML = "";
    document.getElementById("display").innerHTML = "" + moltiplicatore + " X ";
    n = "";
}

//TASTIERA
function tastiera(num) {
    document.getElementById("display").innerHTML = "";
    n = n + num;
    document.getElementById("display").innerHTML = "" + n;
    moltiplicatore = "";
}

function varie() {
    if (n > 0) {
        prezzi[k] = n;
        attributi[k] = "varie";
        qua[k] = 1;
        idProdotti[k] = "v";
        document.getElementById("display").innerHTML = "";
        document.getElementById("display").innerHTML = "Varie: &euro; " + prezzi[k];
        k++;
    } else {
        document.getElementById("display").innerHTML = "";
        document.getElementById("display").innerHTML = "Comando non valido";
    }
    n = "";
    b = 0;
    moltiplicatore = "";

    scontrino();


}

function automatico(prezzo, nome, id) {

    b = 0;
    var ind = 0;
    for (i = 0; i < attributi.length; i++) {
        var prova = nome.localeCompare(attributi[i]);
        if (prova === 0) {
            b = 1;
            ind = i;
        }
    }
    if (b !== 0) {
        if (moltiplicatore != "") {
            var app = parseInt(qua[ind]) + parseInt(moltiplicatore);
            qua[ind] = app;
            document.getElementById("display").innerHTML = "";
            document.getElementById("display").innerHTML = attributi[ind] + ":" + "+ " + moltiplicatore + " di " + "&euro; " + prezzo;
        }
        else {
            qua[ind]++;
            document.getElementById("display").innerHTML = "";
            document.getElementById("display").innerHTML = attributi[ind] + ":" + "+ 1 di " + "&euro; " + prezzo;
        }
        moltiplicatore = "";
        contatore = "";

    } else {
        if (moltiplicatore != "") {
            qua[k] = moltiplicatore;
            moltiplicatore = "";
            prezzi[k] = prezzo;
            attributi[k] = nome;
            idProdotti[k] = id;
            document.getElementById("display").innerHTML = "";
            document.getElementById("display").innerHTML = attributi[k] + ":" + qua + " * " + "&euro; " + prezzo;
            k++;
        }
        else {
            qua[k] = 1;
            moltiplicatore = "";
            prezzi[k] = prezzo;
            attributi[k] = nome;
            idProdotti[k] = id;
            document.getElementById("display").innerHTML = "";
            document.getElementById("display").innerHTML = attributi[k] + ": 1 * " + "&euro; " + prezzo;
            k++;
        }

    }
    b = 0;
    n = "";

    scontrino();
}

function subtot(tipo) {

    var nProdotti = qua.length;
    var parametri = "tipoA=" + tipo + "&numero=" + nProdotti;
    for (var i = 0; i < nProdotti; i++) {
        parametri += "&nome" + i + "=" + attributi[i] + "&quantita" + i + "=" + qua[i] + "&prezzo" + i + "=" + prezzi[i] + "&idP" + i + "=" + idProdotti[i];
    }

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/esecuzioni/acquisto.php",
        // passo dei dati alla risorsa remota
        data: parametri,
        // definisco il formato della risposta
        //dataType: "html",
        // imposto un'azione per il caso di successo
        success: function (risposta) {

            if (risposta != 1) {
                if (k > 0) {
                    totale = 0;
                    for (i = 0; i < prezzi.length; i++) {
                        Ptot[i] = prezzi[i] * qua[i];
                        totale = totale + Ptot[i];
                    }
                    document.getElementById("display").innerHTML = "";
                    document.getElementById("display").innerHTML = "Tot.: &euro; " + totale;
                    b = 1;
                } else {
                    document.getElementById("display").innerHTML = "";
                    document.getElementById("display").innerHTML = "Comando non valido";
                }
            } else {
                alert("alcuni prodotti sono esauriti");
            }
            prezzi = [];
            attributi = [];
            qua = [];
            n = "";
            k = 0;

        },
        // ed una per il caso di fallimento
        error: function () {

        }
    });

}

function tot(tipo) {

    if (b !== 0) {
        resto = 0;
        resto = n - totale;
        resto = arrotonda(resto, 2);
        document.getElementById("display").innerHTML = "";
        document.getElementById("display").innerHTML = "Resto: &euro; " + resto;
        $("#footerS").append("<br><hr class\"divisore\">Resto: " + resto + " €");


    } else {
        if (k > 0) {
            var nProdotti = qua.length;
            var parametri = "tipoA=" + tipo + "&numero=" + nProdotti;
            for (var i = 0; i < nProdotti; i++) {
                parametri += "&nome" + i + "=" + attributi[i] + "&quantita" + i + "=" + qua[i] + "&prezzo" + i + "=" + prezzi[i] + "&idP" + i + "=" + idProdotti[i];
            }

            $.ajax({
                // definisco il tipo della chiamata
                type: "GET",
                // specifico la URL della risorsa da contattare
                url: "metodi/esecuzioni/acquisto.php",
                // passo dei dati alla risorsa remota
                data: parametri,
                // definisco il formato della risposta
                //dataType: "html",
                // imposto un'azione per il caso di successo
                success: function (risposta) {

                    if (risposta != 1) {
                        if (k > 0) {
                            totale = 0;
                            for (i = 0; i < prezzi.length; i++) {
                                Ptot[i] = prezzi[i] * qua[i];
                                totale = totale + Ptot[i];
                            }
                            document.getElementById("display").innerHTML = "";
                            document.getElementById("display").innerHTML = "Tot.: &euro; " + totale;
                            b = 1;
                        } else {
                            document.getElementById("display").innerHTML = "";
                            document.getElementById("display").innerHTML = "Comando non valido";
                        }
                    } else {
                        alert("alcuni prodotti sono esauriti");
                    }

                    for (i = 0; i < prezzi.length; i++) {
                        Ptot[i] = prezzi[i] * qua[i];
                        totale = totale + Ptot[i];
                    }
                    document.getElementById("display").innerHTML = "";
                    document.getElementById("display").innerHTML = "Tot.: &euro; " + totale;
                },
                // ed una per il caso di fallimento
                error: function () {

                }
            });
        } else {
            document.getElementById("display").innerHTML = "";
            document.getElementById("display").innerHTML = "Comando non valido";
        }

        prezzi = [];
        attributi = [];
        qua = [];
        b = 0;
        n = "";
        k = 0;
        totale = 0;
        resto = 0;
    }
}


function annulla() {
    prezzi = [];
    attributi = [];
    qua = [];
    idProdotti = [];
    n = "";
    k = 0;
    document.getElementById("display").innerHTML = "";
    document.getElementById("display").innerHTML = "Ordine annullato";
    scontrinoCanc();
}

function del() {
    document.getElementById("display").innerHTML = "";
    n = "";
}

function cancella() {
    if (n == 0) {
        document.getElementById("display").innerHTML = "";
        document.getElementById("display").innerHTML = "Canc.";
        qua[k - 1] = "";
        prezzi[k - 1] = 0;
        attributi[k - 1] = "";
        idProdotti[k - 1] = "";
        k = k - 1;
    } else {
        for (i = 0; i < prezzi.length; i++) {
            if (n === prezzi[i]) {
                qua[i]--;
                if (qua[i] === 0) {
                    var ep = prezzi.splice(i, 1);
                    var ea = attributi.splice(i, 1);
                    var eq = qua.splice(i, 1);
                    document.getElementById("display").innerHTML = "";
                    document.getElementById("display").innerHTML = "- : &euro; " + ep;
                }
            }
        }
    }
    scontrino();
    n = "";
}

function arrotonda(valore, nCifre) {
    if (isNaN(parseFloat(valore)) || isNaN(parseInt(nCifre)))
        return false;
    else
        return Math.round(valore * Math.pow(10, nCifre)) / Math.pow(10, nCifre);
}
