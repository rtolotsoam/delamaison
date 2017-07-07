<!--MODAL -->
<div class="modal fade" id="ajout_notification_maj">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- MODAL HEADER -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Ajout notification</h3>
            </div>
            <!-- END MODAL HEADER -->
            
            <!-- MODAL BODY -->
            <div class="modal-body">
                <div class="innerAll">
                    <form class="margin-none innerLR inner-2x">
                        
                        <p id="titre_notifmaj_error"></p>
                        <div class="form-group">
                            <label for="titre_notifmaj">Titre: </label>
                            <input type="text" class="form-control" id="titre_notifmaj" placeholder="Titre de la notification" />
                        </div>
                        
                        <p id="corps_notifmaj_error"></p>
                        <div class="form-group">
                            <label for="corps_notifmaj">Message: </label>
                            <textarea class="form-control" rows="3" id="corps_notifmaj" placeholder="Le contenu de la notification..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="couleur_notifmaj">couleur: </label>
                            <select class="form-control" id="couleur_notifmaj">
                                <option value="info" class="bg-info">Information</option>
                                <option value="warning" class="bg-warning">Importante</option>
                                <option value="danger" class="bg-danger">Tr&egrave;s importante</option>
                            </select>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="active_notifmaj" checked >Visible
                            </label>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!--  END MODAL BODY -->
            
            <!-- MODAL FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-block btn-info" id="bouton_ajout_traits" onclick="ajout_notif_maj();">Ajouter</button>
            </div>
            <!--  END MODAL FOOTER -->
            
        </div>
    </div>
</div>
<!-- END MODAL -->