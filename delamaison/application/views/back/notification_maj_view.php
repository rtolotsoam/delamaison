<div id="content">
	<h1 class="content-heading bg-white border-bottom">
		<div class="row">
			<div class="col-md-4">
				<a href="#ajout_notification_maj" data-toggle="modal" class="btn btn-success pull-right">
					AJOUTER NOUVELLE NOTIFICATION
				</a>
			</div>
			<div class="col-md-8">
			</div>
		</div>
	</h1> 
	
<div class="innerAll spacing-x2">


		<div class="widget widget-inverse   corp-info">
			<div class="widget-body padding-bottom-none">

				<!-- Table -->
				<table class="dynamicTable ajax4 table table-bordered table-condensed table-striped table-vertical-center table-responsive">
					
					<!-- Table heading -->
					<thead class="bg-gray">
						<tr>
							<th>Titre</th>
							<th>Contenu</th>
							<th>Qualification</th>
							<th class="center">Visible</th>
                                                        <th><?php echo ascii_to_entities('Créateur'); ?></th>
                                                        <th><?php echo ascii_to_entities('Création'); ?></th>
                                                        <th>Vues</th>
                                                        <th class="center" style="width: 150px;">Modifier</th>
							<th class="center" style="width: 150px;">Supprimer</th>
						</tr>
					</thead>
					<!-- // Table heading END -->

					<!-- Table body -->
					<tbody>
						

					</tbody>
					<!-- // Table body END -->
						
				</table>
				<!-- // Table END -->

				<!-- Affichage du modal de confirmation suppression notification -->
				<div id="affiche-suppr-notification">
				</div>

			</div>	
		</div>		
	


	<script type="text/javascript">
	$(document).ready(function(){
	    init_evenement();
	});
	</script>