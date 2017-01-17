<?php


class Traitement_admin extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_traitement','traits');
        $this->load->model('fte_processus','procs');
        $this->load->model('fte_categories','cats');

        $this->load->library('form_validation');

    }

    

    public function index()
    {

        $this->traitement_admin();

    }

    // INSERTION D'UN TRAITEMENT ET D'UN PREMIER PROCESSUS p1
    public function traitement_admin()
    {
        $level = $this->session->userdata('level');

        if($this->session->userdata('loggin') && $level == 'admin'){


            if($this->input->post('ajax') == '1'){    
            
                // VALIDATION DU CHAMPS DU FORMULAIRE (Libelle traitement)
                $this->form_validation->set_rules('libelle_traits', 'Libelle catégorie', 'min_length[4]|trim|required|xss_clean|htmlspecialchars');
                $this->form_validation->set_rules('libelle_sous_cat', 'Libelle traitement', 'min_length[4]|trim|required|xss_clean|htmlspecialchars');

                


                // PERSONNALISATION DES MESSAGES D'ERREUR
                $this->form_validation->set_message('required', 'Les champs sont obligatoires');
                $this->form_validation->set_message('htmlspecialchars', 'Caractères invalide');
                $this->form_validation->set_message('xss_clean', 'Caractères invalide');
                $this->form_validation->set_message('min_length', 'Longueur de champs minimum invalide');

                // TRAITEMENT DU FORMULAIRE
                if($this->form_validation->run()) {

                        $libelle_traits = $this->input->post('libelle_traits');  
                        $libelle_cats = $this->input->post('libelle_sous_cat');
                        
                        $data = array(
                                'libelle_categories' => $libelle_traits,
                                'niveau' => 1,
                                'parent_id' => 0
                            );

                        $id_nouveau_cat = (int) $this->cats->ajouter_sous_categories($data);

                        $data2 = array(
                                'libelle_categories' => $libelle_cats,
                                'niveau' => 2,
                                'parent_id' => $id_nouveau_cat
                            );

                        $id_nouveau_trait = (int) $this->cats->ajouter_sous_categories($data2);

                        $upd_cat_id = array(
                            'categories_id' => 0,
                            'root_id' => 0
                        );

                        $upd_root_id = array(
                            'categories_id' => $id_nouveau_cat,
                            'root_id' => $id_nouveau_trait
                        );


                        if($id_nouveau_cat && $id_nouveau_trait){

                            $this->cats->editer_categories($id_nouveau_cat, $upd_cat_id);
                            $this->cats->editer_categories($id_nouveau_trait, $upd_root_id);

                            echo "success";
                        }else{
                            echo "erreur";
                        }
                    

                }else{
                    echo form_error('libelle_traits' ,'<div class="alert alert-danger" align="center">' ,'</div>').'||'.form_error('libelle_sous_cat' ,'<div class="alert alert-danger" align="center">' ,'</div>');
                }

                
            

            }else if($this->input->post('ajax') == '2'){

                $id_categories = $this->session->userdata('id_categories');

                // VALIDATION DU CHAMPS DU FORMULAIRE (Libelle traitement)
                $this->form_validation->set_rules('libelle_trait_cat', 'Libelle traitement', 'min_length[4]|trim|required|xss_clean|htmlspecialchars');

                // PERSONNALISATION DES MESSAGES D'ERREUR
                $this->form_validation->set_message('required', 'Les champs sont obligatoires');
                $this->form_validation->set_message('htmlspecialchars', 'Caractères invalide');
                $this->form_validation->set_message('xss_clean', 'Caractères invalide');
                $this->form_validation->set_message('min_length', 'Longueur de champs minimum invalide');

                // TRAITEMENT DU FORMULAIRE
                if($this->form_validation->run()) {

                        $libelle_trait_cat = $this->input->post('libelle_trait_cat');  
                        
                        $data = array(
                            'libelle_categories' => $libelle_trait_cat,
                            'niveau' => 2,
                            'parent_id' => $id_categories,
                            'categories_id' => $id_categories,
                            'root_id' => 0
                        );

                        $id_nouveau_trait_cat = (int) $this->cats->ajouter_sous_categories($data);

                        $upd_root_id = array(
                            'root_id' => $id_nouveau_trait_cat
                        );


                        if($id_nouveau_trait_cat){    

                            $this->cats->editer_categories($id_nouveau_trait_cat, $upd_root_id);
                            
                            echo "success";
                        }else{
                            echo "erreur";
                        }
                    

                }else{
                    echo form_error('libelle_trait_cat' ,'<div class="alert alert-danger" align="center">' ,'</div>');
                }
            }
                
        }else{
            redirect('login');
        }


    }




    // POUR METTRE LE FLAG DU TRAITEMENT 0
    public function supprimer_traitement($id){

        $level = $this->session->userdata('level');

        
        if($this->session->userdata('loggin') && $level == 'admin'){
            
            $id_traitement = (int) $id;
            
            $data = array('flag' => 0);

            $this->traits->supprimer_traitement($id_traitement, $data);

            redirect('front/accueil');

        }else{
            redirect('login');
        }    
        
    }



    // POUR MODIFIER LE TRAITEMENT
    public function modifier_traitement(){
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == 'admin' && $this->input->post('ajax') == '1'){
            
            // VALIDATION DU CHAMPS DU FORMULAIRE (Libelle traitement)
            $this->form_validation->set_rules('libelle_traits_modif', 'Libelle traitement', 'trim|required|xss_clean|htmlspecialchars');

            // PERSONNALISATION DES MESSAGES D'ERREUR
            $this->form_validation->set_message('required', 'Le champs est obligatoire');
            $this->form_validation->set_message('htmlspecialchars', 'Caractères invalide');
            $this->form_validation->set_message('xss_clean', 'Caractères invalide');

            // TRAITEMENT DU FORMULAIRE
            if($this->form_validation->run()) {
                
                $libelle = $this->input->post('libelle_traits_modif');  
                $source = $this->input->post('source_traits_modif');
                $id_traitement = $this->input->post('id_traitement_modif');  
                $flag = $this->input->post('flag_traits_modif');

               $data = array(
                        'info_traitement' => $libelle,
                        'source_info' => $source,
                        'flag' => $flag,
                        'flag_processus' => 0,
                        'flag_action' => 0
                    );


                if($this->traits->modifier_traitement($id_traitement, $data)){
                    echo "success";                            
                }else{
                    echo "erreur";
                }

            }else{
                echo form_error('libelle_traits_modif' ,'<div class="alert alert-danger" align="center">' ,'</div>');
            }



        }else{
            redirect('login');
        }
    }
    


}