/**
 * Created by francesco on 12/06/2016.
 */
function controllaG(id) {
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
            url: "metodi/controllaG.php",
            // passo dei dati alla risorsa remota
            data: "nomeG="+nome,
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
                    $(key).popover({html:true,title: "Nome Squadra", content: "Il nome del girone è valido", placement: "top"});
                    $(key).popover('show');
                    setTimeout(function () {
                        $(key).popover('destroy');
                    }, 5000);


                } else {
                    $(keyG).show();
                    $(keydiv).addClass("has-error has-feedback");
                    $(keyS).hide()
                    $(key).popover({html:true, title: "Nome Squadra", content: "Nome Girone non valido", placement: "top"});
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
