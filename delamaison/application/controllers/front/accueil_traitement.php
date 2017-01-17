<?php


class Accueil_traitement extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_categories','cats');
        $this->load->model('fte_traitement','traits');
        $this->load->model('fte_user','usr');

    }

    

    public function index($id)
    {
        $this->accueil_traitement($id);

    }

    public function accueil_traitement($id)
    {
        if($this->session->userdata('loggin')){


            $id_traits = (int) $id;
            
            if($id_traits){
                $this->session->set_userdata('process_redirect', $id_traits);
                $categories = $this->cats->liste_categories_by_parent($id_traits);

                $donnes_menu = $this->cats->liste_categories_by_id($id_traits);

                foreach ($donnes_menu as $val_menu) {
                    $menu = $val_menu->libelle_categories;
                }

            }else{
                $process_redirect = $this->session->userdata('process_redirect');                
                $categories = $this->cats->liste_categories_by_parent($process_redirect);
            }

            if($this->session->userdata('user')){

                $user = $this->session->userdata('user');


                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $this->session->set_userdata('id_user', $id_user);

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom'] = $val_user->prenom;
                        $data_user['pass'] = $val_user->pass;
                        $data_user['mail'] = $val_user->mail; 
                    }

                    $this->session->unset_userdata('user');
                }
            }else{

                $user = $this->usr->liste_utilisateur_ById((int) $this->session->userdata('id_user'));

                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom'] = $val_user->prenom;
                        $data_user['pass'] = $val_user->pass;
                        $data_user['mail'] = $val_user->mail; 
                    }

                }
            }


            //** CODE **
            $level = $this->session->userdata('level');
            $var_url_modif_user_profil = "var url_modif_user_profil = "."\"".site_url("back/utilisateur/modifier_profil")."\";";
            $var_url_accueil = "var url_accueil = "."\"".site_url("front/accueil_traitement/normal")."\";";
            $var_url_search = "var url_js_search = "."\"".site_url("front/accueil_processus/search_normal")."\";";
            $var_acc_search = "var url_acc_search = "."\"".site_url("front/accueil_processus/normal")."\";";
            //** END CODE **
            
            //** PARAMETRE VUE **
            $data['titre'] = 'ACCUEIL TRAITEMENT';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min','admin/module.admin.page.notifications.min');
            $data['categories'] = $categories;

            if(!empty($menu)){
                $data['menu'] = $menu;
            }

            if($id_traits){
                $data['traitement'] = $id_traits;
            }else{
                $data['traitement'] = $process_redirect;
            }

            $data['prenom'] = $this->session->userdata('prenom');
            $data['level'] = $level;
            $data['js'] = array('js/back.js','js/users.js','js/search.js');
            $data['js_info'] = array($var_url_modif_user_profil, $var_url_accueil, $var_url_search, $var_acc_search);
            //** END PARAMETRE VUE **
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('includes/menu_horizental.php');
            $this->load->view('front/accueil_traitement_view.php', $data);
            $this->load->view('front/user_profil_view.php', $data_user);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }


    public function normal()
    {
        if($this->session->userdata('loggin')){

                $process_redirect = $this->session->userdata('process_redirect');                
                $categories = $this->cats->liste_categories_by_parent($process_redirect);
                $donnes_menu = $this->cats->liste_categories_by_id($process_redirect);

                foreach ($donnes_menu as $val_menu) {
                    $menu = $val_menu->libelle_categories;
                }


            //** CODE **
            $level = $this->session->userdata('level');

            if($this->session->userdata('user')){

                $user = $this->session->userdata('user');

                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $this->session->set_userdata('id_user', $id_user);

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom'] = $val_user->prenom;
                        $data_user['pass'] = $val_user->pass;
                        $data_user['mail'] = $val_user->mail; 
                    }

                    $this->session->unset_userdata('user');
                }
            }else{

                $user = $this->usr->liste_utilisateur_ById((int) $this->session->userdata('id_user'));

                if(!empty($user)){

                    foreach ($user as $val_user) {
                        $id_user = $val_user->fte_user_id;
                        $data_user['id_user'] = $id_user;

                        $data_user['matricule'] = $val_user->matricule;
                        $data_user['prenom'] = $val_user->prenom;
                        $data_user['pass'] = $val_user->pass;
                        $data_user['mail'] = $val_user->mail; 
                    }

                }
            }

            $var_url_modif_user_profil = "var url_modif_user_profil = "."\"".site_url("back/utilisateur/modifier_profil")."\";";
            $var_url_accueil = "var url_accueil = "."\"".site_url("front/accueil_traitement/normal")."\";";
            $var_url_search = "var url_js_search = "."\"".site_url("front/accueil_processus/search_normal")."\";";
            $var_acc_search = "var url_acc_search = "."\"".site_url("front/accueil_processus/normal")."\";";
            //** END CODE **
            
            //** PARAMETRE VUE **
            $data['titre'] = 'ACCUEIL TRAITEMENT';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/module.admin.page.pricing_tables.min','admin/module.admin.page.notifications.min');
            $data['categories'] = $categories;
            $data['level'] = $level;

            if(!empty($menu)){
                $data['menu'] = $menu;
            }

            if($process_redirect){
                $data['traitement'] = $process_redirect;
            }

            $data['prenom'] = $this->session->userdata('prenom');
            $data['js'] = array('js/back.js','js/users.js','js/search.js');
            $data['js_info'] = array($var_url_modif_user_profil, $var_url_accueil, $var_url_search, $var_acc_search);
            //** END PARAMETRE VUE **

            //** END PARAMETRE VUE **
        
            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('includes/menu_horizental.php');
            $this->load->view('front/accueil_traitement_view.php', $data);
            $this->load->view('front/user_profil_view.php', $data_user);
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }

}