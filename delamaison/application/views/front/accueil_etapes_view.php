<div id="content"><h1 class="content-heading bg-white border-bottom" style="z-index: 0;"><?php if(!empty($menu)){ echo $menu;} ?></h1> 
<div class="innerAll">

    	
<!-- CONTENT -->

<div class="row">
	<div class="col-lg-12">	
		<div class="row">
			<?php 
				if(!empty($categories)){
					foreach ($categories as $val_cat) {
					
			?>
				<div class="col-md-2 columns">
					<div class="titre_contenu">
						<?php /*echo ascii_to_entities($val_cat->libelle_categories); */?>
					</div>
					<div class="button2">
						<a href="<?php echo site_url('front/accueil_processus/'.$val_cat->fte_categories_id) ?>" class="titre_bouton"><?php echo ascii_to_entities($val_cat->libelle_categories);?></a>
					</div>	   
				</div>
			<?php 
					}
				}
			?>
			
		</div>
	</div>
</div>

<!-- END CONTENT -->
		
		