/**
 * Created by francesco on 04/06/2016.
 */
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
