<?php


class Accueil extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_categories','cats');
        $this->load->model('fte_processus','procs');
        $this->load->model('fte_traitement','traits');
		$this->load->library('session');

    }

    

    public function index()
    {

        $this->accueil();

    }


    public function accueil()
    {
		
		// var_dump($this->session->flashdata('resultsearch'));
        if($this->session->userdata('loggin') && $this->input->post('ajax') == 'first_process'){

            //****************************** CODE ************************************
            $id_cat = (int) $this->input->post('id_cat');

            $cats = $this->cats->liste_categories_by_id($id_cat);

            foreach ($cats as $val_cat) {
                $id_trait = (int) $val_cat->traitement_id;
            }

            $procs = $this->procs->liste_processus_first($id_trait);

            foreach ($procs as $val_proc) {
                $id_proc = $val_proc->fte_process_id;
            }


            if($id_trait && $id_proc){
                echo $id_trait."||".$id_proc;
            }
            //***************************** END CODE ***********************************
			
            
        }else{
            redirect('login');
        }

    }

}