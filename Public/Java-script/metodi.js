/**
 * Created by francesco on 16/05/2016.
 */
function AggiungiRiga(num) {

    var table = document.getElementById("tabellaI");
    console.log(table);
    var row = table.insertRow(num);
    num--;
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = "<td><div id=\"DGnomeG"+num+"\" class='form-group'>"
        +"<input class=\"form-control\" type=\"text\" onblur=\"controlla('nomeG"+num+"')\" id=\"nomeG"+num+"\" name=\"nomeG"+num+"\" required>"
        +"<span id=\"GnomeG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell2.innerHTML = "<td><div id=\"DGcognomeG"+num+"\" class='form-group'>"
        +"<input class=\"form-control\" type=\"text\" id=\"cognomeG"+num+"\" onblur=\"controlla('cognomeG"+num+"')\" name=\"cognomeG"+num+"\" required>"
        +"<span id=\"GcognomeG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell3.innerHTML = "<td><div id=\"DGdateG"+num+"\" class='form-group'>"
        +"<input type=\"text\" id=\"dateG" +num+ "\" name=\"dateG" +num+ "\" class=\"form-control floating-label\" placeholder=\"Date\" required>"
        +"<span id=\"GdateG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell4.innerHTML = "<td><div id=\"DGLuogoG"+num+"\" class='form-group'>"
        +"<input class=\"form-control\" type=\"text\" id=\"LuogoG"+num+"\" onblur=\"controlla('LuogoG"+num+"')\" name=\"LuogoG"+num+"\" required>"
        +"<span id=\"GLuogoG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell5.innerHTML = "<td><div id=\"DGcodG"+num+"\" class='form-group'>"
        +"<input class=\"form-control\" type=\"text\" id=\"codG"+num+"\" onkeyup=\"touppercase(this.id,this.value);\" onblur=\"controlla('codG"+num+"')\" name=\"codG"+num+"\" required>"
        +"<span id=\"GcodG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell6.innerHTML = "<td><div id=\"DGresG"+num+"\" class='form-group'>"
        +"<input class=\"form-control\" type=\"text\" id=\"resG" + num + "\" onblur=\"controlla('resG"+num+"')\" name=\"resG" + num + "\" required>"
        +"<span id=\"GresG"+num+"\" class=\"glyphicon glyphicon-remove form-control-feedback\" aria-hidden=\"true\"></span></div></td>";

    cell7.innerHTML = "<td><div class='form-group'>"
        +"<input type=\"file\" class=\"filestyle\" id=\"file"+num+"\" data-input=\"false\" name='file"+num+ "'>"
        +"</div></td>";
}

function EliminaRiga(num) {
    num++;
    document.getElementById("tabellaI").deleteRow(num);
}

function cambiaV(dest) {
    console.log(dest);
    switch(dest) {
        case 1:
            $("#Sq").hide();
            $("#Invia").hide();
            $("#Ref").show();
            $("#info").show();
            break;
        case 2:
            $("#Ref").hide();
            $("#Invia").hide();
            $("#Sq").show();
            $("#info").show();
            break;
        case 3:
            $("#Ref").hide();
            $("#Sq").hide();
            $("#info").hide();
            $("#Invia").show();
            break;

    }

}

function resetF() {
    document.getElementById("iscrizione").reset();
    $("#Sq").hide();
    $("#Invia").hide();
    $("#Ref").show();
    $("#info").show();
}

function submitF() {

    var nomeR = document.getElementById("nomeR").value;
    var confronto = nomeR.localeCompare("");

    if(confronto == 0){
        $("#Sq").hide();
        $("#Invia").hide();
        $("#Ref").show();
        $("#info").show();
        $("#DGnomeR").addClass("has-error has-feedback");
        $("#GnomeR").show();
        $('#nomeR').popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
        $('#nomeR').popover('show');
        return;
    } else {
        $("#DGnomeR").removeClass("has-error has-feedback");
        $("#GnomeR").hide();
        $('#nomeR').popover('destroy');
    }

    var emailR = document.getElementById("emailR").value;
    var confronto = emailR.localeCompare("");

    if(confronto == 0){
        $("#Sq").hide();
        $("#Invia").hide();
        $("#Ref").show();
        $("#info").show();


        $("#DGemailR").addClass("has-error has-feedback");
        $("#GemailR").show();
        $('#emailR').popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
        $('#emailR').popover('show');
        return;
    } else {
        $("#DGemailR").removeClass("has-error has-feedback");
        $("#GemailR").hide();
        $('#emailR').popover('destroy');
    }

    var nomeS = document.getElementById("nomeS").value;
    var confronto = nomeS.localeCompare("");

    if(confronto == 0){
        $("#Ref").hide();
        $("#Invia").hide();
        $("#Sq").show();
        $("#info").show();

        $("#DGnomeR").removeClass("has-success has-feedback");
        $('#GSnomeS').hide();
        $('#DGnomeS').addClass("has-error has-feedback");
        $('#GnomeS').show();
        $('#nomeS').popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
        $('#nomeS').popover('show');
        return;
    } else {
        $("#DGemailR").removeClass("has-error has-feedback");
        $("#GemailR").hide();
        $('#nomeS').popover('destroy');
    }
    
    
    var numeroG = document.getElementById('Cont').value;
    console.log(numeroG);
    var controllo = 0;
    for(var i = 0; i<numeroG;i++){
        var nome = "nomeG"+i;
        var cognome = "cognomeG"+i;
        var data = "dateG"+i;
        var luogo = "LuogoG"+i
        var cod = "codG"+i;
        var res = "resG"+i;

        var stringaN = document.getElementById(nome).value;
        var stringaC = document.getElementById(cognome).value;
        var stringaD = document.getElementById(data).value;
        var stringaL = document.getElementById(luogo).value;
        var stringaCod = document.getElementById(cod).value;
        var stringaR = document.getElementById(res).value;


        var DG = "#DG"+nome;
        var G = "#G"+nome;
        if((stringaN.localeCompare(""))==0){


            $(DG).addClass("has-error has-feedback");
            $(G).show();
            //$(nome).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            //$(nome).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
           // $(nome).popover('destroy');
        }

        var DG = "#DG"+cognome;
        var G = "#G"+cognome;
        if((stringaC.localeCompare(""))==0){


            $(DG).addClass("has-error has-feedback");
            $(G).show();
            //$(cognome).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            //$(cognome).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
            //$(cognome).popover('destroy');
        }


        var DG = "#DG"+data;
        var G = "#G"+data;
        if((stringaD.localeCompare(""))==0){

            $(DG).addClass("has-error has-feedback");
            $(G).show();
            $(data).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            $(data).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
            //$(data).popover('destroy');
        }

        var DG = "#DG"+luogo;
        var G = "#G"+luogo;
        if((stringaCod.localeCompare(""))==0){


            $(DG).addClass("has-error has-feedback");
            $(G).show();
            //$(cod).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            //$(cod).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
            //$(cod).popover('destroy');
        }

        var DG = "#DG"+cod;
        var G = "#G"+cod;
        if((stringaL.localeCompare(""))==0){


            $(DG).addClass("has-error has-feedback");
            $(G).show();
            //$(cod).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            //$(cod).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
            //$(cod).popover('destroy');
        }


        var DG = "#DG"+res;
        var G = "#G"+res;
        if((stringaR.localeCompare(""))==0){


            $(DG).addClass("has-error has-feedback");
            $(G).show();
            //$(res).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
            //$(res).popover('show');
            controllo = 1;
        } else {
            $(DG).removeClass("has-error has-feedback");
            $(G).hide();
            //$(res).popover('destroy');
        }
    }

    if(controllo == 1){
        $("#Ref").hide();
        $("#Invia").hide();
        $("#Sq").show();
        $("#info").show();
        return;
    }

    document.getElementById("iscrizione").submit();
}

function controlla(id) {
    console.log(id);
    var nomeR = document.getElementById(id).value;
    console.log(nomeR);
    var confronto = nomeR.localeCompare("");

    var keydiv = "#DG"+id;
    var keyG = "#G"+id;
    var key = "#"+id;

    if(confronto == 0){
        $(keydiv).addClass("has-error has-feedback");
        $(keyG).show();
        $(key).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
        $(key).popover('show');
    }
    else {
        $(key).popover('destroy');
        $(keydiv).removeClass("has-error has-feedback");
        $(keyG).hide();
        
    }
}

function controllaSQ(id) {
    var nome = document.getElementById(id).value;

    var confronto = nome.localeCompare("");
    var key ="#"+id;
    var keydiv = "#DG"+id;
    var keyG = "#G"+id;
    var keyS = "#GS"+id;

    if(confronto == 0){
        $(keydiv).removeClass("has-success has-feedback");
        $(keyS).hide()
        $(keydiv).addClass("has-error has-feedback");
        $(keyG).show();
        $(key).popover({title: "Campo Obbligatorio", content: "Questo campo è obbligatorio", placement: "top"});
        $(key).popover('show');
    }
    else {
        $.ajax({
            // definisco il tipo della chiamata
            type: "GET",
            // specifico la URL della risorsa da contattare
            url: "metodi/controllaSQ.php",
            // passo dei dati alla risorsa remota
            data: "nomeS="+nome,
            // definisco il formato della risposta
            //dataType: "html",
            // imposto un'azione per il caso di successo
            success: function(risposta){
                var n = risposta;

                    if (n == 0){
                        $(keydiv).removeClass("has-error has-feedback");
                        $(keyG).hide();
                        $(keydiv).addClass("has-success has-feedback");
                        $(keyS).show()
                        $(key).popover({html:true,title: "Nome Squadra", content: "Il nome Squdra è valido", placement: "top"});
                        $(key).popover('show');
                        setTimeout(function () {
                            $(key).popover('destroy');
                        }, 5000);


                    } else {
                        $(keyG).show();
                        $(keydiv).addClass("has-error has-feedback");
                        $(keyS).hide()
                        $(key).popover({html:true, title: "Nome Squadra", content: "Il nome della squdra <br> già stato iscritto", placement: "top"});
                        $(key).popover('show');
                        setTimeout(function () {
                            $(key).popover('destroy');
                        }, 5000);

                    }
                }
            ,
            // ed una per il caso di fallimento
            error: function(){

            }
        });
    }
}


