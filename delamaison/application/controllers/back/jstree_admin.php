<?php

class Jstree_admin extends CI_Controller {

	public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_categories','cats');
        $this->load->model('fte_traitement','traits');
        $this->load->model('fte_processus','procs');
    }

	public function index()
	{
		$this->jstree_admin();
	}

	public function jstree_admin()
	{

		$level = $this->session->userdata('level');

        if($this->session->userdata('loggin') && $level =="admin" && $this->input->post('ajax')){

        	if($this->input->post('ajax') == 'create'){
		
				$id = (int) $this->input->post('id');
				$text = $this->input->post('text');
				$pos = $this->input->post('position');

				$categs = $this->cats->liste_categories_by_id($id);

				foreach ($categs as $val_cat) {
					$niveau_act = (int) $val_cat->niveau;
					$cat_id = $val_cat->categories_id;
					$root_id = $val_cat->root_id;
				}

				$niveau = $niveau_act + 1;

				$data = array(
					'libelle_categories' => $text,
                    'niveau' => $niveau,
                    'parent_id' => $id,
                    'categories_id' => $cat_id,
                    'root_id' => $root_id
					);

				$id_nouveau_cat = $this->cats->ajouter_sous_categories($data);

				if($id_nouveau_cat){

					$result = array('id' => $id_nouveau_cat);

					header('Content-Type: application/json; charset=utf-8');
    				echo json_encode($result);
				}else{
					echo "erreur";
				}

			}else if($this->input->post('ajax') == 'rename'){

				$id = (int) $this->input->post('id');
				$text = $this->input->post('text');

				$update = $this->cats->editer_categories($id, array('libelle_categories' => $text));

				$traits = $this->cats->liste_categories_by_id($id);

				foreach ($traits as $val_trait) {
					$verif_trait_id = (int) $val_trait->traitement_id;
				}

				if($verif_trait_id){

					$this->traits->modifier_traitement($verif_trait_id, array('info_traitement' => $text));
				}

				if($update){
					echo "succes";
				}else{
					echo "erreur";
				}

			}else if($this->input->post('ajax') == 'delete'){

				$id = (int) $this->input->post('id');

				$data = array('flag' => 0);

				$delete = $this->cats->editer_categories($id, $data);

				if($delete){

					$niveau = $this->cats->get_niveau($id);


		            if($niveau[0]->niveau == 2 ){
		                
		                $this->cats->editer_categories_withroot_id($id, $data);

		            }else if($niveau[0]->niveau == 3){

		                $this->cats->editer_categories_withparent_id($id, $data);
		            }

					echo "succes";
				}else{
					echo "erreur";
				}

			}else if($this->input->post('ajax') == 'create_process'){

				$id = (int) $this->input->post('id');
				$text = $this->input->post('text');
				$pos = $this->input->post('position');

				$categs = $this->cats->liste_categories_by_id($id);

				foreach ($categs as $val_cat) {
					$niveau_act = (int) $val_cat->niveau;
					$cat_id = $val_cat->categories_id;
					$root_id = $val_cat->root_id;
				}

				$niveau = $niveau_act + 1;

				$trait = array(
					'info_traitement' => $text
				);


				$id_trait = (int) $this->traits->ajouter_traitement($trait);

				$data = array(
					'libelle_categories' => $text,
                    'niveau' => $niveau,
                    'parent_id' => $id,
                    'traitement_id' => $id_trait,
                    'categories_id' => $cat_id,
                    'root_id' => $root_id
				);

				$id_nouveau_cat = $this->cats->ajouter_sous_categories($data);

				$process = array(
					'parent_id' => 0,
					'campagne_id' => $id_trait,
					'ordre' => 1,
					'alias' => 'P1'
				);

				$id_process = $this->procs->ajouter_processus($process);
					

				if($id_nouveau_cat && $id_process){

					$result = array('id' => $id_nouveau_cat);

					header('Content-Type: application/json; charset=utf-8');
    				echo json_encode($result);

				}else{
					echo "erreur";
				}


			}else if($this->input->post('ajax') == 'delete_process'){

				$id = (int) $this->input->post('id');

				$delete = $this->cats->editer_categories($id, array('flag' => 0));

				if($delete){
					echo "succes";
				}else{
					echo "erreur";
				}

			}else if($this->input->post('ajax') == 'edit_process'){

				$id = (int) $this->input->post('id');


				$categs = $this->cats->liste_categories_by_id($id);

				foreach ($categs as $val_cat) {
					$id_trait = (int) $val_cat->traitement_id;
				}

				echo $id_trait;
			}



			//var_dump("id = ".$id." text = ".$text." pos= ".$pos);


		}else{
            redirect('login');
        }		
	}
}

