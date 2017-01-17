<!-- MENU ACTION -->
<div id="menu" class="hidden-print hidden-xs">
	<div class="sidebar sidebar-inverse">
		<div class="user-profile media innerAll">
			<div class="media-body">
				<p style='color:white;'>
					<?php if(!empty($menu)){
							echo "&nbsp;&nbsp;<i class=\"fa fa-chevron-circle-right\"></i>&nbsp;&nbsp;".ascii_to_entities($menu);
					}?>
				</p>
			</div>
		</div>
		<?php if($titre != "ACCUEIL"){ ?>
		<div class="sidebarMenuWrapper">
			<ul class="list-unstyled" id="activities">
			</ul>	
		</div>
		<?php } ?>
	</div>
</div>
<!-- END MENU ACTION -->