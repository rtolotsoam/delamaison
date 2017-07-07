<!-- MODAL -->
<div class="modal fade" id="affiche-not-<?php echo $id_not; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Suppression notification</h3>
			</div>
			<!-- END MODAL HEADER -->
			
			<!-- MODAL BODY -->
			<div class="modal-body">
				<div class="innerAll">
					<div id="message_session"> 
			  		</div>

			  		<div id="message_bd"> 
			  		</div>

					<p class="astuce">
						<img src="<?php echo img_url('attention.png'); ?>" alt="logo_attention" />
						&nbsp;Voulez-vous vraiment supprimer la notification, titre :
						<span style="color:red;">
							<?php echo ascii_to_entities($notifications[0]->titre); ?>
						</span>
					</p>
				</div>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="ntfmaj_suppr(<?php echo $id_not; ?>);">Supprimer
				</button>
			</div>
			<!--  END MODAL FOOTER -->
			
		</div>
	</div>
</div>
<!-- END MODAL -->