/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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

            function aggiorna(num) {

                var parametri = "";
                for (var id = 1; id <= num; id++) {
                    var nome = "input[name=evento" + id + "]:checked";
                    var x = $(nome).val();
                    if (id == 1) {
                        parametri = parametri + "evento" + id + "=" + x;
                    } else {
                        parametri = parametri + "&" + "evento" + id + "=" + x;
                    }


                }
                console.log(parametri);

                $.ajax({
                    // definisco il tipo della chiamata
                    type: "GET",
                    // specifico la URL della risorsa da contattare
                    url: "metodi/aggiorna_eventi.php",
                    // passo dei dati alla risorsa remota
                    data: parametri,
                    // definisco il formato della risposta
                    dataType: "html",
                    // imposto un'azione per il caso di successo
                    success: function (risposta) {
                        $("#tabS").remove();
                        $("#tabella").html(risposta);
                        alert("Staff aggiornati!!! :-P");
                    },
                    // ed una per il caso di fallimento
                    error: function () {
                        alert("Chiamata fallita!!!");
                    }

                });
            }
            function staff(num) {
                var parametri = "";
                for (var id = 1; id <= num; id++) {
                    var nome = "input[name=funzione" + id + "]:checked";
                    //console.log(nome);
                    var x = $(nome).val();
                    //console.log(x);
                    if (id == 1) {
                        parametri = parametri + "funzione" + id + "=" + x;
                    } else {
                        parametri = parametri + "&" + "funzione" + id + "=" + x;
                    }
                }

                var campiE = "";
                $("input[name=elimina]").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        campiE += $(this).val() + ",";
                    }
                });
                parametri = parametri + "&" + "elimina" + "=" + campiE;
                //console.log(parametri);

                $.ajax({
                    // definisco il tipo della chiamata
                    type: "GET",
                    // specifico la URL della risorsa da contattare
                    url: "metodi/aggiornastaff.php",
                    // passo dei dati alla risorsa remota
                    data: parametri,
                    // definisco il formato della risposta
                    dataType: "html",
                    // imposto un'azione per il caso di successo
                    success: function (risposta) {
                        $("#tabT").remove();
                        $("#ADDSTaff").html(risposta);
                        alert("Staff aggiornati!!! :-P");
                    },
                    // ed una per il caso di fallimento
                    error: function () {
                        alert("Chiamata fallita!!!");
                    }

                });

            }

