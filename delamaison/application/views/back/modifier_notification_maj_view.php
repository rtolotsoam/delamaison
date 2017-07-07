<!--MODAL -->
<div class="modal fade" id="modif_notification_maj">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- MODAL HEADER -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Modification notification</h3>
            </div>
            <!-- END MODAL HEADER -->
            
            <!-- MODAL BODY -->
            <div class="modal-body">
                <div class="innerAll">
                    <form class="margin-none innerLR inner-2x">
                        
                        <input type="hidden" id="id_notif_modif" value=""/>
                        
                        <p id="titre_notifmaj_error"></p>
                        <div class="form-group">
                            <label for="titre_notifmaj">Titre: </label>
                            <input type="text" class="form-control" id="titre_notifmaj_modif" placeholder="Titre de la notification" />
                        </div>
                        
                        <p id="corps_notifmaj_error"></p>
                        <div class="form-group">
                            <label for="corps_notifmaj">Message: </label>
                            <textarea class="form-control" rows="3" id="corps_notifmaj_modif" placeholder="Le contenu de la notification..."></textarea>
                        </div>
                        
                        <p id="couleur_notifmaj_error"></p>
                        <div class="form-group">
                            <label for="couleur_notifmaj">couleur: </label>
                            <select class="form-control" id="couleur_notifmaj_modif">
                                <option value="info" class="bg-info">Information</option>
                                <option value="warning" class="bg-warning">Importante</option>
                                <option value="danger" class="bg-danger">Tr&egrave;s importante</option>
                            </select>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="active_notifmaj_modif">Visible
                            </label>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="renew_notifmaj_modif">Reset "vues"
                            </label>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!--  END MODAL BODY -->
            
            <!-- MODAL FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-block btn-info" id="bouton_ajout_traits" onclick="modif_notif_maj()">Modifier</button>
            </div>
            <!--  END MODAL FOOTER -->
            
        </div>
    </div>
</div>
<!-- END MODAL -->