
<div id="content">
	<h1 class="content-heading bg-white border-bottom <?php if($level != "admin"){ echo "hidden"; }?>">
		
		<div class="row">
			<div class="col-md-4"> 
				<?php if(isset($liste_cat) && !empty($liste_cat)){ ?>
	    		<a href="#ajout-traitement-cat" data-toggle="modal" class="btn btn-success pull-right">			AJOUTER TRAITEMENT
	    		</a>
	    		<?php } ?>

	    	</div>
	    	<div class="col-md-4"> 
		    	<div class="form-group" style="margin-left:40px;">
			    	<label for="source-cat">Choisir le <?php echo ascii_to_entities("catégorie"); ?>: </label>

			    	<select id="source-cat" onchange="charge_categories()">
			    		<?php 
			    		if(!empty($liste_cat) && !empty($id_cat)){ 
			    			foreach ($liste_cat as $val_select) {
			    		?>
						<option value="<?php echo $val_select->fte_categories_id; ?>" <?php if($id_cat==$val_select->fte_categories_id) echo "selected"; ?>><?php echo ascii_to_entities($val_select->libelle_categories); ?></option>
						<?php
							}
						} 
						?>
					</select>
					<i id="spin" style="display:none;" class="fa fa-spinner fa-spin"></i>
				</div>				

			</div>
			<div class="col-md-4"> 
	    		<a href="#ajout-traitement" data-toggle="modal" class="btn btn-success">	AJOUTER CATEGORIE</a>
	    	</div>
			
			
		</div>
		
	</h1> 
<div class="innerAll spacing-x2">

    	
<!-- CONTENT -->    
<div class="panel-group accordion accordion-2" id="tabAccountAccordion" style="border:none !important;">

<div class="row <?php  if($level == "admin"){ echo "corp-info"; } ?>">

	<?php 
	
	if(!empty($categories)){

		$id_collapse = 0;

		foreach ($categories as $val_cat) {

			$id_collapse ++;
		 

		 	$traits = $lst_cat[$val_cat->fte_categories_id];
	?>
	
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-11">	
						<h4 class="panel-title">
							<a class="accordion-toggle glyphicons right_arrow" data-toggle="collapse" data-parent="#tabAccountAccordion" href="#collapse-<?php echo $id_collapse; ?>-1">
								<i></i>
								<?php echo strtoupper(ascii_to_entities($val_cat->libelle_categories)); ?>
								
							</a>		
																						
						</h4>
					</div>
					
					<div class="col-md-1">	
						
						<a style="margin-bottom : 4px !important;" href="#supprimer-traitement-<?php echo $val_cat->fte_categories_id;  ?>" data-toggle="modal" class="btn btn-danger pull-right"><i class="fa fa-times"></i></a>
						
					</div>
				</div>	
			</div>
			<div id="collapse-<?php echo $id_collapse; ?>-1" class="panel-collapse collapse">
				<div class="panel-body">

				<div class="row">	
					<div class="col-md-6">
						
						<div class="input-group">
							<div class="input-group-btn">
		                        <button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i></button>
		                    </div>
		                    <input class="search-input-<?php echo $val_cat->fte_categories_id; ?> form-control" onkeyup="search_nom(<?php echo $val_cat->fte_categories_id; ?>);"/>
		                </div>

		            </div>    
            	</div>
            	<br/>
				
				<?php
				if(!empty($traits)){

					foreach ($traits as $val_trait) {


				?>

					<div id="tree-container-<?php echo $val_trait->root_id; ?>"></div>	

					<script type="text/javascript">

					function search_nom(id){

						var search_val = '.search-input-'+id;

						var searchString = $(search_val).val();

						$('#tree-container-'+id).jstree(true).search(searchString);
					}

					$(function(){

					

					<?php 
						echo "var container =\"#tree-container-".$val_trait->root_id."\";";
						echo "var id = \"/".$val_trait->root_id."\";"; 
						echo "var jstree_admin = \"".site_url("back/jstree_admin")."\";";
					?>


					var url = url_jstree+id;
				    
					// console.log(url);
					// console.log(jstree_admin);

					
					    //fill data to tree  with AJAX call
					    $(container).jstree({
					    "contextmenu" : {
						        items : { // Could be a function that should return an object like this one
						            "create" : {
						                "separator_before"  : false,
						                "separator_after"   : true,
						                "label"             : "Créer",
						                "_disabled"			: function (data) {
						                	var inst = $.jstree.reference(data.reference),
						                		obj = inst.get_node(data.reference);

						                		console.log(obj);

						                		if(obj.icon == "jstree-default jstree-file"){
						                			return true;
						                		}else if((obj.children.length == obj.children_d.length) && (obj.parent !="#")){
						                			return true;

						                		}else if((obj.children.length == obj.children_d.length) && (obj.children.length == 0) && (obj.children_d.length == 0) && (obj.parent !="#")){
						                			return true;
						                		}else{	
						                			return false;
						                		}

												
										},
						                "action"			: function (data) {
											var inst = $.jstree.reference(data.reference),
												obj = inst.get_node(data.reference);
											inst.create_node(obj, { type : "default" }, "last", function (new_node) {
												setTimeout(function () { inst.edit(new_node); },0);
											});
										}
						            },
						            "rename" : {
										"separator_before"	: false,
										"separator_after"	: false,
										"_disabled"			: false, //(this.check("rename_node", data.reference, this.get_parent(data.reference), "")),
										"label"				: "Renommer",
										/*!
										"shortcut"			: 113,
										"shortcut_label"	: 'F2',
										"icon"				: "glyphicon glyphicon-leaf",
										*/
										"action"			: function (data) {
											var inst = $.jstree.reference(data.reference),
												obj = inst.get_node(data.reference);
											inst.edit(obj);
										}
									},
									"remove" : {
										"separator_before"	: false,
										"icon"				: false,
										"separator_after"	: false,
										"_disabled"			: false, //(this.check("delete_node", data.reference, this.get_parent(data.reference), "")),
										"label"				: "Supprimer",
										"_disabled"			: function (data) {
						                	var inst = $.jstree.reference(data.reference),
						                		obj = inst.get_node(data.reference);

						                		if(obj.icon == "jstree-default jstree-file"){
						                			return true;
						                		}else{

						                			if(obj.parent == "#"){
														return true;
													}else{
						                				return false;
						                			}
						                		}
												
										},
										"action"			: function (data) {
											var inst = $.jstree.reference(data.reference),
												obj = inst.get_node(data.reference);
											if(inst.is_selected(obj)) {
												inst.delete_node(inst.get_selected());
											}
											else {
												inst.delete_node(obj);
											}
										}
									},
									"process" : {
										"separator_before"  : false,
						                "separator_after"   : false,
						                "label"             : "Processus",
						                "action"            : false,
						                "_disabled"			: function (data) {
						                	var inst = $.jstree.reference(data.reference),
						                		obj = inst.get_node(data.reference);

												if(obj.parent == "#"){
													return true;
												}else if(obj.children.length != obj.children_d.length){
						                			return true;
						                		}else{
						                			return false;
						                		}
												
										},
						                "submenu" 			: {
						                	"add_process" : {
						                		"separator_before"  : false,
								                "separator_after"   : false,
								                "label"             : "Ajouter",
								                "_disabled"			: function (data) {
								                	var inst = $.jstree.reference(data.reference),
								                		obj = inst.get_node(data.reference);

								                		if(obj.icon == "jstree-default jstree-file"){
								                			return true;
										                }else if(obj.children.length != 0){
										                	return false;
										                }else{
								                			return false;
								                		}
														
												},
								                "action"			: function (data) {
													var inst = $.jstree.reference(data.reference),
														obj = inst.get_node(data.reference);
													inst.create_node_process(obj, { type : "file" }, "last", function (new_node) {
														setTimeout(function () { inst.edit(new_node); },0);
													});
												}
						                	},
						                	"delete_process" : {
						                		"separator_before"  : false,
								                "separator_after"   : false,
								                "label"             : "Supprimer",
								                "_disabled"			: function (data) {
								                	var inst = $.jstree.reference(data.reference),
								                		obj = inst.get_node(data.reference);

								                		if(obj.icon == "jstree-default jstree-file"){
								                			return false;
										                }else{
								                			return true;
								                		}
														
												},
								                "action"			: function (data) {
													var inst = $.jstree.reference(data.reference),
														obj = inst.get_node(data.reference);
													if(inst.is_selected(obj)) {
														inst.delete_node_process(inst.get_selected());
													}
													else {
														inst.delete_node_process(obj);
													}
												}
						                	},
						                	"edit_process" : {
						                		"separator_before"  : false,
								                "separator_after"   : false,
								                "label"             : "Editer",
								                "_disabled"			: function (data) {
								                	var inst = $.jstree.reference(data.reference),
								                		obj = inst.get_node(data.reference);

								                		if(obj.icon == "jstree-default jstree-file"){
								                			return false;
										                }else{
								                			return true;
								                		}
														
												},
								                "action"			: function (data) {
													var inst = $.jstree.reference(data.reference),
														obj = inst.get_node(data.reference);
														
														$.ajax({
															url: jstree_admin,
															type : 'POST',
															data : {
																id : obj.id,
																ajax : 'edit_process'
															}, 
															success: function(result){
													        	editer(result);
													    	}
														});

														
												}
						                	},


						                } 
									}
						        }
						},
						"search": {
				            'case_insensitive'  : true,
				            'show_only_matches' : true
				        },
						'types' : {
							'default' : { 'icon' : 'jstree-default jstree-folder' },
							'file' : { 'valid_children' : [], 'icon' : 'jstree-default jstree-file' }
						},
						'plugins': ["state","wholerow", "contextmenu","types","search"],
					        'core' : {
					            'data' : {
					                "url" : url,
					                "data" : function (node) {
						                return { 'id' : node.id };
						            },
					                "dataType" : "json" // needed only if you do not supply JSON headers
					            },
					        'check_callback' : true,
            				'themes' : {
              					'responsive' : true
            					}       
					        }

					    }).on('create_node.jstree', function (e, data) {

				         		$.post(jstree_admin, { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text, 'ajax' : 'create' }).done(function (d){
				              		data.instance.set_id(data.node, d.id);
				            	}).fail(function () {
				              		data.instance.refresh();
				            	});

				        }).on('rename_node.jstree', function (e, data) {
					          
						        $.post(jstree_admin, { 'id' : data.node.id, 'text' : data.text, 'ajax' : 'rename' }).fail(function () {
						              data.instance.refresh();
						        });

					    }).on('delete_node.jstree', function (e, data) {
						        $.post(jstree_admin, { 'id' : data.node.id, 'ajax' : 'delete' })
						            .fail(function () {
						              data.instance.refresh();
						        });
        				}).on('create_node_process.jstree', function (e, data) {

				         		$.post(jstree_admin, { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text, 'ajax' : 'create_process' }).done(function (d){
				              		data.instance.set_id(data.node, d.id);
				            	}).fail(function () {
				              		data.instance.refresh();
				            	});

				        }).on('delete_node_process.jstree', function (e, data) {
						        $.post(jstree_admin, { 'id' : data.node.id, 'ajax' : 'delete_process' })
						            .fail(function () {
						              data.instance.refresh();
						        });
        				});

				    });
					</script>

				
				<?php
					}
				}
				?>
				
				</div>	
			</div>
		</div>		
	
	</div>
	<?php
		}
	}
	?>

<!-- </div> -->


</div>
<!-- END CONTENT -->

		
		
		