
$(document).ready(function(){
    regule_maj_nb_notif();
    $('#lst_notif').css('max-height','700px');
    $('#lst_notif').css('overflow-y','auto');
    $('#affiche_notification_maj').on('shown.bs.modal', function () {
        consultation();
    });
});

function consultation(){
    $.post(url_ajax_notif, {
    }, function (reponse) {
        $("#lst_notif").each(function(){
            $(this).html(reponse);
            maj_nb_notif();
        });
    });
}

function maj_nb_notif(){
    if ($("#nb_notif").length) {
        $.post(url_ajax_nb_notif, {
        }, function (reponse) {
            $("#nb_notif").each(function () {
                $(this).html(reponse);
                if((reponse*1) > 0){
                    $("#nb_notif").css('background-color','red');
                }else{
                    $("#nb_notif").css('background-color','');
                }
            });
        });
    }
}

function notif_lu(id){
    $.post(url_ajax_lu_notif, {id:id}, function(reponse){
        if (reponse == '1') {
            $("#lst_notif_"+id).hide(200);
            maj_nb_notif();
        } else {
            alert("Erreur: erreur connexion.");
        }
    });
}

function regule_maj_nb_notif(){
    setTimeout(regule_maj_nb_notif, 30000);
    maj_nb_notif();
}