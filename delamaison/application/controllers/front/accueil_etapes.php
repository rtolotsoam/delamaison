<?php


class Accueil_etapes extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_categories','cats');
        $this->load->model('fte_traitement','traits');

    }

    

    public function index($id)
    {

        $this->accueil_etapes($id);

    }

    public function accueil_etapes($id)
    {
        if($this->session->userdata('loggin')){


            //** CODE **
            $id_categories = (int) $id;

            $liste_cat = $this->cats->liste_categories_by_parent($id_categories);

            $donnes_menu = $this->cats->liste_categories_by_id($id_categories);

            foreach ($donnes_menu as $val_menu) {
                $menu = $val_menu->libelle_categories;
            }

            $level = $this->session->userdata('level');

            //** PARAMETRE VUE **
            $data['titre'] = 'ACCUEIL ETAPE';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min');
            if(!empty($liste_cat)){
                $data['categories'] = $liste_cat;
            }
            if(!empty($donnes_menu)){
                $data['menu'] = $menu;
            }
            $data['level'] = $level;
            //** END PARAMETRE VUE **

            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('includes/menu_horizental.php');
            $this->load->view('front/accueil_etapes_view.php', $data);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE ***/

            
        }else{
            redirect('login');
        }

    }

}