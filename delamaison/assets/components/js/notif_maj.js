
function init_evenement(){
    $('#couleur_notifmaj').on('change',function(){
        colori_select($(this));
    });
    $('#couleur_notifmaj_modif').on('change',function(){
        colori_select($(this));
    });
    $('#ajout_notification_maj').on('shown.bs.modal', function () {
        colori_select($('#couleur_notifmaj'));
    });
}

function colori_select(the_select){
    the_select.removeClass('bg-info');
    the_select.removeClass('bg-warning');
    the_select.removeClass('bg-danger');
    the_select.addClass('bg-'+the_select.val());
}


function ajout_notif_maj(){
    
    var titre = $('#titre_notifmaj').val();
    var corps = $('#corps_notifmaj').val();
    var couleur = $('#couleur_notifmaj').val();
    var active = $('#active_notifmaj').is(':checked') ? 1 : 0;
    
    $.post(url_ajout_notif,{
        titre:titre,
        corps:corps,
        couleur:couleur,
        active:active
    }, function(reponse){
        if(reponse == 0){
            alert('Erreur: session perdue.');
            window.location.href = url_login_notif;
        }else if (reponse == 1) {
            alert("Erreur: erreur enregistrement, veuillez reessayer.");
        }else if (reponse == 2) {
            window.location.href = url_after_op_notif;
        }else{
            var res = reponse.split(";");
            $('#titre_notifmaj_error').html(res[0]);
            $('#corps_notifmaj_error').html(res[1]);
        }


    });

}

function init_modal_modif(){
    $('#id_notif_modif').val('');
    $('#titre_notifmaj_modif').val('');
    $('#corps_notifmaj_modif').val('');
    $('#couleur_notifmaj_modif').val('info');
    $('#active_notifmaj_modif').removeAttr('checked');
    $('#renew_notifmaj_modif').removeAttr('checked');
}

function ntfmaj_modif(id){
    init_modal_modif();
    $.post(url_recup_notif,{
        id:id
    }, function(reponse){
        if(reponse == 0){
            alert('Erreur: session perdue.');
            window.location.href = url_login_notif;
        }else if (reponse == 1) {
            alert("Erreur: erreur recuperation donnees, veuillez reessayer.");
        }else{
            var rep = $.parseJSON(reponse);
            $('#id_notif_modif').val(id);
            $('#titre_notifmaj_modif').val(rep.titre);
            $('#corps_notifmaj_modif').val(rep.corps);
            $('#couleur_notifmaj_modif').val(rep.couleur);
            colori_select($('#couleur_notifmaj_modif'));
            if(rep.active == '1'){
                $('#active_notifmaj_modif').attr('checked',"");
            }else{
                $('#active_notifmaj_modif').removeAttr('checked');
            }
            $('#modif_notification_maj').modal();
        }


    });
}

function modif_notif_maj(){
    
    var id = $('#id_notif_modif').val();
    var titre = $('#titre_notifmaj_modif').val();
    var corps = $('#corps_notifmaj_modif').val();
    var couleur = $('#couleur_notifmaj_modif').val();
    var active = $('#active_notifmaj_modif').is(':checked') ? 1 : 0;
    var reset = $('#renew_notifmaj_modif').is(':checked') ? 1 : 0;
    
    $.post(url_modif_notif,{
        id:id,
        titre:titre,
        corps:corps,
        couleur:couleur,
        active:active,
        reset:reset
    }, function(reponse){
        if(reponse == 0){
            alert('Erreur: session perdue.');
            window.location.href = url_login_notif;
        }else if (reponse == 1) {
            alert("Erreur: erreur enregistrement, veuillez reessayer.");
        }else if (reponse == 2) {
            window.location.href = url_after_op_notif;
        }else{
            var res = reponse.split(";");
            $('#titre_notifmaj_error').html(res[0]);
            $('#corps_notifmaj_error').html(res[1]);
        }


    });

}

function ntfmaj_suppr(id){

    $.post(url_suppr_notif, {
        id: id
    }, function (reponse) {
        if (reponse == 0) {
            $('#message_bd').html('');
            $('#message_session').html('<div class="alert alert-danger" align="center">Erreur: session perdue.</div>');
        } else if (reponse == 1) {
            $('#message_session').html('');
            $('#message_bd').html('<div class="alert alert-danger" align="center">Erreur: erreur recuperation donnees, veuillez reessayer.</div>');
        } else {
            window.location.href = url_after_op_notif;
        }
        
        
    });

}


function affiche_suppr_notification(id) {

    console.log(id);

            var form_data = {
                id_not : id,
                ajax : '1'
            };



            $.ajax({
                url: url_aff_suppr_notif,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    
                    $("#affiche-suppr-notification").html(data);
                    $("#affiche-not-"+id).modal();

                }

            });
    
}