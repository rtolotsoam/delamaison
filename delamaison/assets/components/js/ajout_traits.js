function ajout_traitement(){

	var libelle_traits = document.getElementById("libelle_traits").value;
	var libelle_sous_cat = document.getElementById("libelle_sous_cat").value;
	/*var cont_sous_cat = document.getElementById("cont_sous_cat").value;
	var sous_cat = document.getElementById("sous_cat").value;*/
	





	if((typeof libelle_traits != null && libelle_traits != '') && (typeof libelle_sous_cat != null && libelle_sous_cat != '') ){
		
		var form_data = {
			libelle_traits : libelle_traits,
			libelle_sous_cat : libelle_sous_cat,
			ajax : '1'
		};
		
		// TRAITEMENT AJAX DU FORMULAIRE
		$.ajax({
			url: url_js_traits,
			type: 'POST',
			data: form_data,
			success: function(data) {
				
				// TRAITEMENT DES ERREURS
				if(data == 'erreur'){
					$('#libelle_traits_error').html('');
					$('#libelle_cats_error').html('');
					$('#message_error').html('<div class="alert alert-danger" align="center">Veillez réessayer ulterieurement !</div>');

				}else if(data == 'success'){
					window.location.href = url_acc_traits;
				}else{

					var str = data;
					var res = str.split("||");

					$('#libelle_traits_error').html(res[0]);
					$('#libelle_cats_error').html(res[1]);

					$('#message_error').html('');					
				}

			}
		});

	}else{
		$('#message_error').html('<div class="alert alert-danger" align="center">Les champs sont obligatoires</div>');		
	}
	
	return true;
}


function ajout_traitement_cat(){

	var libelle_trait_cat = document.getElementById("libelle_trait_cat").value;
	

	if(typeof libelle_trait_cat != null && libelle_trait_cat != ''){
		
		var form_data = {
			libelle_trait_cat : libelle_trait_cat,
			ajax : '2'
		};
		
		// TRAITEMENT AJAX DU FORMULAIRE
		$.ajax({
			url: url_js_traits,
			type: 'POST',
			data: form_data,
			success: function(data) {
				
				// TRAITEMENT DES ERREURS
				if(data == 'erreur'){
					$('#libelle_trait_cat_error').html('');
					$('#message_error').html('<div class="alert alert-danger" align="center">Veillez réessayer ulterieurement !</div>');

				}else if(data == 'success'){
					window.location.href = url_acc_traits;
				}else{

					$('#libelle_trait_cat_error').html(data);
					$('#message_error').html('');					
				}

			}
		});

	}else{
		$('#message_error').html('<div class="alert alert-danger" align="center">Les champs sont obligatoires</div>');		
	}
	
	return true;
}