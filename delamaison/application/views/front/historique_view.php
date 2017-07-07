
<div id="content"><h1 class="content-heading bg-white border-bottom hidden">Historique</h1> 
<div class="innerAll spacing-x2">

		<div class="widget widget-inverse" >
			<div class="widget-body padding-bottom-none">

				<!-- Table -->
				<table class="dynamicTable <?php if($level == "admin") echo "ajax"; else echo "ajax2"; ?> table">
					
					<!-- Table heading -->
					<thead class="bg-gray">
						<tr>
							<?php if($level =="admin" ){ ?>
							<th>Matricule</th>
							<th>traitement&nbsp;</th>
							<th>Etapes</th>
							<th>Début</th>
							<th>Fin</th>
							<?php }else{ ?>
							<th>traitement&nbsp;</th>
							<th>Processus</th>
							<th>Début</th>
							<th>Fin</th>
							<?php } ?>
						</tr>
					</thead>
					<!-- // Table heading END -->

					<!-- Table body -->
					<tbody>
						

					</tbody>
					<!-- // Table body END -->
						
				</table>
				<!-- // Table END -->

			</div>	
		</div>		
	


	
<!-- Modal -->

<div class="modal fade" id="modal-compose">
	
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" data-dismiss="modal" class="bootbox-close-button close">×</button>
			<h4 class="modal-title">Filtre pour l'export</h4>
		</div>
			<!-- Modal heading -->
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Login</h3>
			</div> -->
			<!-- // Modal heading END -->
			<!-- Modal body -->
			<div class="alert alert alert-danger" style="display:none;" id="warning">
				<strong>Il y a eu une erreur sur la date.</strong>
			</div>
			<div class="modal-body"> 
			
				<form class="margin-none" role="form">
					<div class="form-group">
						<div class="row innerLR innerB">
							<div class="form-group">
								<div class="col-md-6">
								 	<label for="matr">Matricule :</label>
								    <select id="matricule" class="form-control" multiple>
										<option value="">--Toutes--</option>
										<?php 
										
										foreach ($histo_user as $table_histo) {
										?>
											<option value="<?php echo $table_histo->matricule; ?>"><?php echo $table_histo->matricule.' - '.$table_histo->initcap; ?>
											</option>
										<?php
										}
										?>
										
								</select>
								</div>
								<div class="col-md-6">
								 	<label for="matr">Liste colonnes dans l'export : </label>
								    <select id="colonne" class="form-control" multiple disabled style="cursor:pointer;">
										<option value = "m">Matricule</option>
										<option value = "t">Traitement</option>
										<option value = "p">Processus</option>
										<option value = "d">Début</option>
										<option value = "f">Fin</option>
								</select>
								</div>
							 </div>
							
						</div>
						<div class="row innerLR innerB">
							<div class="form-group">
								<div class="col-md-6">
								 	<label for="matr">Date début :</label>
								    <input type="text" id="datepicker1" class="form-control" value='<?php echo date("d/m/Y");?>'>
								</div>
								<div class="col-md-6">
								 	<label for="matr">Date fin :</label>
								    <input type="text" id="datepicker1b" class="form-control" value='<?php echo date("d/m/Y");?>'>
								</div>
							 </div>
							
						</div>
					</div>
					
				</form>
			
			</div>
			<!-- // Modal body END -->

			<div class="innerAll text-center border-top">
				<a href="" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-fw icon-crossing"></i> Cancel</a>
				<a href="" class="btn btn-primary" id="exporter"><i class="fa fa-fw icon-outbox-fill"></i>Exporter</a>
			</div>
	
		</div>
	</div>
	
</div>
<!-- // Modal END -->

<script type="text/javascript">
$("#exporter").on('click',function(){
	var list_matr    = $("#matricule").val();
	var datepicker1  = $("#datepicker1").val();
	var datepicker1b = $("#datepicker1b").val();

	datepicker1 	 = convert_date_format(datepicker1);
	datepicker1b 	 = convert_date_format(datepicker1b);

	if(datepicker1b < datepicker1 && ( datepicker1b  !="" && datepicker1 !=""))
	{
		$("#datepicker1").focus();
		$("#warning").show();
			setTimeout(function(){
	  			$("#warning").hide();
			}, 3000);
		return false;
	}else
	{	
		
		window.location = "<?php echo site_url('back/fte_histo_user_c_export/index');?>?list_matr="+list_matr+'&datepicker1='+datepicker1+'&datepicker1b='+datepicker1b+'&test=ggg';
		return false;
	}
});

	function convert_date_format(date)
	{
		var newdate = date.split("/").reverse().join("-");
		return newdate;
	}
</script>
