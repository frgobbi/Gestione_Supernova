/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function eliminaStaff(user){
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/cancellaStaff.php",
        // passo dei dati alla risorsa remota
        data: "id="+user,
        // definisco il formato della risposta
        //dataType: "html",
        // imposto un'azione per il caso di successo
        success: function(){

                var key = "#L"+user;
                $(key).hide();

        },
        // ed una per il caso di fallimento
        error: function(){
            alert("Chiamata fallita!!!");
        }
    });
}


function VisualizzaStaff(user) {

    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/datiStaff.php",
        // passo dei dati alla risorsa remota
        data: "id=" + user,
        // definisco il formato della risposta
        //dataType: "json",
        // imposto un'azione per il caso di successo
        success: function (oggetto) {
            var dati = $.parseJSON(oggetto);
            var codice = "<li id=\"L"+dati.username+"\" class=\"list-group-item\">"
                +"<div class=\"col-xs-12 col-sm-12 col-md-1\">"
                +"<br>"
                +"<div class=\"btn-group\" data-toggle=\"buttons\">"
                +"<label class=\" btn btn-default\">"
                +"<input class='spunta' name=\"Check"+dati.username+"\" type=\"checkbox\" autocomplete=\"off\">"
                +"<span class=\" icoSpunta glyphicon glyphicon-ok\"></span>"
                +"</label>"
                +"</div>"
                +"</div>"
                +"<div class=\"col-xs-12 col-sm-12 col-md-3\">"
                +"<img style='width: 150px; height: 150px' src=\"../"+dati.foto+"\" alt=\""+dati.nome+" "+dati.cognome+"\" class=\"img-responsive img-thumbnail img-circle\" />"
                +"</div>"
                +"<div class=\"col-xs-12 col-sm-12 col-md-8\">"
                +"<span class=\"name\">"+dati.nome+" "+dati.cognome+"</span>"
                +"<div class=\"row\">"
                +"<div class=\"col-md-7\">"
                +"<strong><span></span>Data: </span></strong>&nbsp<span class=\"testo\">"+dati.data_n+"</span><br>"
                +"<strong><span></span>Sesso: </span></strong>&nbsp<span class=\"testo\">"+dati.sesso+"</span>&nbsp<br>"
                +"<strong><span></span>User: </span></strong>&nbsp<span class=\"testo\">"+dati.username+"</span>&nbsp<br>"
                +"<strong><span></span>email: </span></strong>&nbsp<span class=\"testo\">"+dati.email+"</span>&nbsp<br>"
                +"<strong><span></span>Evento: </span></strong>&nbsp<span class=\"testo\">"+dati.nome_evento+"</span>&nbsp<br>"
                +"<strong><span></span>Tipo Staff: </span></strong>&nbsp<span class=\"testo\">"+dati.nome_tipo+"</span>&nbsp<br>"
                +"</div>"
                +"<div class=\" col-xs-12 col-sm-12 col-md-1 col-md-offset-2 button\">"
                +"<button type=\"button\" href=\"#\" class=\"btn btn-md btn-danger\" onclick=\"eliminaStaff("+dati.username+")\"><i class=\"fa fa-trash\"></i></button><br><br>"
                +"<button type=\"button\" href=\"#\" class=\"btn btn-md btn-primary\" onclick=\"attivaModifica("+dati.username+")\"><i class=\"fa fa-pencil\"></i></button>"
                +"</div>"
                +"</div>" +
                "</div>"+
                "<div class=\"clearfix\"></div>"+
                "</li>";

            var key = "#L"+user;
            $(key).replaceWith(codice);
        }
    });

}




function attivaModifica(user){
    //console.log("esisto");
    $.ajax({
        // definisco il tipo della chiamata
        type: "GET",
        // specifico la URL della risorsa da contattare
        url: "metodi/datiStaff.php",
        // passo dei dati alla risorsa remota
        data: "id="+user,
        // definisco il formato della risposta
        //dataType: "html",
        // imposto un'azione per il caso di successo
        success: function(risposta){
            var ogg = $.parseJSON(risposta);
            console.log(ogg);
            var codice = "" +
"<li id=\"L"+ogg.username+"\" class=\"list-group-item\">"
    +"<form method='post' action='metodi/modificaStaff.php?user="+ogg.username+"' enctype=\"multipart/form-data\">"
        +"<div class=\"col-xs-12 col-sm-12 col-md-1\">"
        +"<br>"
            +"<div class=\"btn-group\" data-toggle=\"buttons\">"
            +"<label class=\" btn btn-default\">"
            +"<input class='spunta' name=\""+ogg.username+"\" type=\"checkbox\" autocomplete=\"off\">"
            +"<span class=\" icoSpunta glyphicon glyphicon-ok\"></span>"
            +"</label>"
            +"</div>"
        +"</div>"
        +"<div class=\"col-xs-12 col-sm-12 col-md-3\">"
        +"<img style='width: 150px; height: 150px' src=\"../"+ogg.foto+"\" alt=\"$nome $cognome\" class=\"img-responsive img-thumbnail img-circle\" />"
            +"<div class='form-group'>"
            +"<label for=\"img\">Cambia foto Profilo:</label>"
            +"<input type=\"file\" name='img"+user+"' class=\"filestyle\" data-input=\"false\">"
            +"</div>"
        +"</div>"
    +"<div class=\"col-xs-12 col-sm-12 col-md-8\">"
    +"<span class=\"name\">"+ogg.nome+" "+ogg.cognome+"</span>"
    +"<div class=\"row\">"
    +"<div class=\"col-md-7\">"
        +"<div class=\"form-group\">"
        +"<label for=\"nome\">Nome:</label>"
        +"<input type=\"text\" class=\"form-control\" id=\"nome\" required name=\"nome"+user+"\" value=\""+ogg.nome+"\"/>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label for=\"cognome\">Cognome:</label>"
        +"<input type=\"text\" class=\"form-control\" id=\"cognome\" required name=\"cognome"+user+"\" value=\""+ogg.cognome+"\"/>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label for=\"date\">Data di nascita:</label>"
        +"<input type=\"text\" id=\"date"+user+"\" name=\"date"+user+"\" class=\"form-control floating-label\" value=\""+ogg.data_n+"\" required>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label for=\"email\">E-mail:</label>"
        +"<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email"+user+"\" value=\""+ogg.email+"\" required/>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label for=\"user\">Username:<small>(Solo lettere e numeri)</small></label>"
        +"<input type=\"text\" class=\"form-control\" id=\"user\" name=\"user"+user+"\" value=\""+ogg.username+"\" pattern=\"[A-Za-z0-9]+\" title=\"solo lettere e numeri\" required/>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label for=\"pass\">Password:</label>"
        +"<input placeholder=\"password\" type=\"password\" class=\"form-control\" id=\"pass"+user+"\" name=\"pass"+user+"\"/>"
        +"</div>"

        +"<div class=\"form-group\">"
        +"<label>Sesso:</label><br/>";
        if (ogg.sesso.localeCompare("maschio") == 0) {
            codice +="<div class=\"btn-group\" data-toggle=\"buttons\">"
            +"<label class=\"btn btn-default\">"
            +"<input type=\"radio\" name=\"sessoS"+user+"\" value=\"femmina\" autocomplete=\"off\">"
            +"<span class=\"glyphicon glyphicon-ok\"></span><img src=\"https://cdn3.iconfinder.com/data/icons/rcons-user-action/32/girl-48.png\">"
            +"</label>"
            +"<label class=\"btn btn-default active\">"
            +"<input type=\"radio\" name=\"sessoS"+user+"\" value=\"maschio\" autocomplete=\"off\" checked>"
            +"<span class=\"glyphicon glyphicon-ok\"></span><img src=\"https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678099-profile-filled-48.png\">"
            +"</label>"
            +"</div>";
        } else{
        codice +="<div class=\"btn-group\" data-toggle=\"buttons\">"
            +"<label class=\"btn btn-default active\">"
            +"<input type=\"radio\" name=\"sessoS"+user+"\" value=\"femmina\" autocomplete=\"off\" checked>"
            +"<span class=\"glyphicon glyphicon-ok\"></span><img src=\"https://cdn3.iconfinder.com/data/icons/rcons-user-action/32/girl-48.png\">"
            +"</label>"
            +"<label class=\"btn btn-default\">"
            +"<input type=\"radio\" name=\"sessoS"+user+"\" value=\"maschio\" autocomplete=\"off\">"
            +"<span class=\"glyphicon glyphicon-ok\"></span><img src=\"https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678099-profile-filled-48.png\">"
            +"</label>"
            +"</div>";
        }
        codice+="</div>";

        codice += "<div class=\"form-group\">"
        +"<label>Tipo staff:</label>"
        +"<select name=\"tipo"+user+"\" id=\"tipo"+user+"\" class=\"form-control\">" +
        
        "</select>" +
        "</div>";

        codice += "<div class=\"form-group\">"
            +"<label>Evento:</label>"
            +"<select name=\"evento"+user+"\" id=\"evento"+user+"\" class=\"form-control\">" +
            
            "</select>" +
            "</div>"+

        "</div>";
        codice +="<div class=\" col-xs-12 col-sm-12 col-md-1 col-md-offset-2 button\">"
        +"<button type=\"button\" href=\"#\" class=\"btn btn-md btn-danger btn-block\" onclick=\"VisualizzaStaff('"+ogg.username+"')\"><i class=\"fa fa-times\"></i></button><br>"
        +"<button type=\"button\"  class=\"btn btn-md btn-success btn-block\" onclick='submit();'><i class=\"fa fa-check\"></i></button>"
        +"</div>"
    +"</div>"
    +"</div>"
    +"<div class=\"clearfix\"></div>"
    +"</form>"
+"</li>";

            //console.log(codice);

            var key = "#L"+user;
            //console.log(user);
            //document.getElementById(key).innerHTML = codice;
            $(key).replaceWith(codice);
            $(":file").filestyle({input: false});
            var keyD = "#date"+user;
            $(keyD).bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });
            
            /*Option TIPO STAFF*/
            $.ajax({
                // definisco il tipo della chiamata
                type: "GET",
                // specifico la URL della risorsa da contattare
                url: "metodi/TipoSTAFF.php",
                // passo dei dati alla risorsa remota
                //data: "id_cat=" + id,
                // definisco il formato della risposta
                //dataType: "json",
                // imposto un'azione per il caso di successo
                success: function (oggetto) {
                    var dati = $.parseJSON(oggetto);
                    //console.log(ogg.tipo);
                     //console.log(dati.id);*/
                    var codiceS = "<select id=\"tipo"+user+"\" name=\"tipo"+user+"\" class=\"form-control\">"
                    for (var k in dati) {
                        if(dati[k]['id'] == ogg.tipo){
                            //console.log("trovato");
                            codiceS += "<option value=\"" + dati[k]['id'] + "\" selected>" + dati[k]['nome'] + "</option>";
                        }
                        else{
                            //console.log("nontrovato");
                            codiceS += "<option value=\"" + dati[k]['id'] + "\">" + dati[k]['nome'] + "</option>";
                        }

                    }
                    codiceS += "</select>";
                    var keyS = "#tipo"+user;
                    $(keyS).replaceWith(codiceS);
                }
            });

            /*Option EVENTO*/
            $.ajax({
                // definisco il tipo della chiamata
                type: "GET",
                // specifico la URL della risorsa da contattare
                url: "metodi/Evento.php",
                // passo dei dati alla risorsa remota
                //data: "id_cat=" + id,
                // definisco il formato della risposta
                //dataType: "json",
                // imposto un'azione per il caso di successo
                success: function (oggetto) {
                    var dati = $.parseJSON(oggetto);
                    console.log(dati);
                    //console.log(ogg.evento);
                    //console.log(dati.id);*/
                    var codiceS = "<select id=\"evento"+user+"\" name=\"evento"+user+"\" class=\"form-control\">"
                    for (var k in dati) {
                        if(dati[k]['id'] == ogg.evento){
                            //console.log("trovato");
                            codiceS += "<option value=\"" + dati[k]['id'] + "\" selected>" + dati[k]['nome'] + "</option>";
                        }
                        else{
                            //console.log("nontrovato");
                            codiceS += "<option value=\"" + dati[k]['id'] + "\">" + dati[k]['nome'] + "</option>";
                        }

                    }
                    codiceS += "</select>";
                    var keyS = "#evento"+user;
                    $(keyS).replaceWith(codiceS);
                }
            });
            

        },
        // ed una per il caso di fallimento
        error: function(){
            alert("Chiamata fallita!!!");
        }
    });    
}


function eliminazioneMultipla(){
    console.log("WORK IN PROGRESS");
}

