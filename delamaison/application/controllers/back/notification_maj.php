<?php

class Notification_maj extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('fte_notification_maj','notification');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $this->notification();
    }
    
    private function notification(){
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == 'admin'){
            //$all_notif = $this->notification->tous_notification();
            
            $var_url_ajout_notif = "var url_ajout_notif = "."\"".site_url("back/notification_maj/ajouter")."\";";
            $var_url_modif_notif = "var url_modif_notif = "."\"".site_url("back/notification_maj/modifier")."\";";
            $var_url_suppr_notif = "var url_suppr_notif = "."\"".site_url("back/notification_maj/supprimer")."\";";
            $var_url_aff_suppr_notif    = "var url_aff_suppr_notif = "."\"".site_url("back/notification_maj/affiche_suppr_notification")."\";";
            $var_url_after_op_notif = "var url_after_op_notif = "."\"".site_url("back/notification_maj")."\";";
            $var_url_login_notif = "var url_login_notif = "."\"".site_url("back/login")."\";";
            $var_url_recup_notif = "var url_recup_notif = "."\"".site_url("back/notification_maj/la_notification")."\";";
            
            //** PARAMETRE VUE **
            $data['titre'] = 'Notification';
            $data['css'] = array('admin/module.admin.page.tables.min','admin/module.admin.page.form_wizards.min','admin/module.admin.page.modals.min','admin/module.global','admin/notification_maj'); 
            $data['level'] = $level;  
            $data['js_info'] = array($var_url_ajout_notif, $var_url_modif_notif, $var_url_suppr_notif, $var_url_after_op_notif, $var_url_login_notif, $var_url_recup_notif, $var_url_aff_suppr_notif);
            $data['js'] = array('js/notif_maj.js');
            /*if(!empty($all_notif)){
                $data['all_notif'] = $all_notif;
            }*/
            
            $data['gest_g'] = $this->session->userdata('ges_g');
            $data['gest_u'] = $this->session->userdata('ges_u');
            
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            $this->load->view('back/notification_maj_view.php', $data);
            $this->load->view('back/ajouter_notification_maj_view.php');
            
            //$this->load->view('back/supprimer_user_view.php', $data_supr);
            $this->load->view('back/modifier_notification_maj_view.php');
            
            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
        }else{
            redirect('login');
        }
    }
    
    public function ajouter(){
        $level = $this->session->userdata('level');
        $createur = trim($this->session->userdata('mle'));
        if($this->session->userdata('loggin') && $level == 'admin' && $createur != '' && $createur > 0){
            $this->form_validation->set_rules('titre','Titre','min_length[1]|trim|required|xss_clean|htmlspecialchars');
            $this->form_validation->set_rules('corps','Message','min_length[1]|trim|required|xss_clean|htmlspecialchars');
            
            $this->form_validation->set_message('required', 'Le champs est obligatoire');
            $this->form_validation->set_message('htmlspecialchars', 'Caractères invalide');
            $this->form_validation->set_message('xss_clean', 'Caractères invalide');
            $this->form_validation->set_message('min_length', 'Longueur de champs minimum invalide');
            
            if($this->form_validation->run()) {
                $titre = $this->input->post('titre');
                $corps = $this->input->post('corps');
                $couleur = $this->input->post('couleur');
                $active = $this->input->post('active');
                
                $insertion = $this->notification->new_notification($titre, $corps, $couleur, $active, $createur);
                if($insertion){
                    echo '2';
                }else{
                    echo '1';
                }
            }else{
                echo form_error('titre','<div class="alert alert-danger" align="center">' ,'</div>').";". form_error('corps','<div class="alert alert-danger" align="center">' ,'</div>');
            }
        }else{
            echo '0';
        }
    }
    
    public function modifier() {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == 'admin'){
            $this->form_validation->set_rules('titre','Titre','min_length[1]|trim|required|xss_clean|htmlspecialchars');
            $this->form_validation->set_rules('corps','Message','min_length[1]|trim|required|xss_clean|htmlspecialchars');
            
            $this->form_validation->set_message('required', 'Le champs est obligatoire');
            $this->form_validation->set_message('htmlspecialchars', 'Caractères invalide');
            $this->form_validation->set_message('xss_clean', 'Caractères invalide');
            $this->form_validation->set_message('min_length', 'Longueur de champs minimum invalide');
            
            if($this->form_validation->run()) {
                $id = trim($this->input->post('id'));
                $titre = $this->input->post('titre');
                $corps = $this->input->post('corps');
                $couleur = $this->input->post('couleur');
                $active = $this->input->post('active');
                $reset = $this->input->post('reset');
                
                $modification = $this->notification->update_notification($id, $titre, $corps, $couleur, $active);
                if($modification){
                    if($reset == '1'){
                        $this->notification->renew_notification($id);
                    }
                    echo '2';
                }else{
                    echo '1';
                }
            }else{
                echo form_error('titre','<div class="alert alert-danger" align="center">' ,'</div>').";". form_error('corps','<div class="alert alert-danger" align="center">' ,'</div>');
            }
        }else{
            echo '0';
        }
    }
    
    public function la_notification() {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == 'admin'){
            $id = trim($this->input->post('id'));
            if($id != '' && $id > 0){
                $notif = $this->notification->la_notification($id);
                if(!empty($notif)){
                    foreach ($notif as $val_notif) {
                        $obj = array();
                        $obj['titre'] = $val_notif->titre;
                        $obj['corps'] = $val_notif->corps;
                        $obj['couleur'] = $val_notif->couleur;
                        $obj['active'] = $val_notif->active;
                        echo json_encode($obj);
                        break;
                    }
                } else {
                    echo '1';
                }
            }else{
                echo '1';
            }
        }else{
            echo '0';
        }
    }
    
    public function supprimer() {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == 'admin'){
            $id = trim($this->input->post('id'));
            if($id != '' && $id > 0){
                $suppr = $this->notification->suppression_notification($id);
                if($suppr){
                    $this->notification->renew_notification($id);
                }
                echo '2';
            }else{
                echo '1';
            }
        }else{
            echo '0';
        }
    }
    
    public function nb_notification_for(){
        $matricule = trim($this->session->userdata('mle'));
        echo $this->notification->nb_notification_for($matricule);
    }
    
    public function notification_for() {
        $matricule = trim($this->session->userdata('mle'));
        $notifs = $this->notification->notification_for($matricule);
        
        $not_empty = FALSE;
        //$rep = '<div class="list-group" id="content_lst_notif">';
        foreach ($notifs as $notif) {
            $not_empty = TRUE;
            $rep .= '<div class="panel panel-'.$notif->couleur.'" id="lst_notif_'.$notif->fte_notification_maj_id.'">';
            $rep .= '<div class="panel-heading">'.$notif->titre.'<!--div class="pull-right" style="cursor:pointer;" onclick="notif_lu('.$notif->fte_notification_maj_id.');"><i class="fa fa-check-circle-o">Marquer comme lu</i></div--></div>';
            $rep .= '<div class="panel-body"><h6>'.$notif->corps.' <small> ['.transforme_date($notif->date_creation).']</small></h6></div>';
            $rep .= '<div class="panel-footer"><div class="" style="cursor:pointer;" onclick="notif_lu('.$notif->fte_notification_maj_id.');"><i class="fa fa-check-circle-o">Marquer comme lu</i></div></div>';
            $rep .= '</div>';
        }
        
        if($not_empty){
            echo $rep;
        }else{
            echo 'Pas de notification';
        }
    }
    
    public function notif_consulter() {
        $matricule = trim($this->session->userdata('mle'));
        $id = trim($this->input->post('id'));
        $consult = $this->notification->new_consultation($id, $matricule);
        if($consult){
            echo '1';
        }else{
            echo '0';
        }
    }
    



public function transforme_date($dt){
    preg_match('/(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2})/',$dt,$matches);
    $daty = $matches[1];
    $ora = $matches[2];
    $matches = '';
    preg_match('/(\d{4})-(\d{2})-(\d{2})/',$daty,$matches);
    $datyfr = $matches[3].'/'.$matches[2].'/'.$matches[1];
    return $ora.' '.$datyfr;
}


public function affiche_suppr_notification(){
        
    if($this->session->userdata('loggin') && $this->input->post('ajax') == "1"){
        
        $id_not = $this->input->post('id_not');

        /*********** pour affichage Notification ***************/
        $data['id_not'] = $id_not;

        $notifications = $this->notification->la_notification($id_not);

        $data['notifications'] = $notifications;

        $poppup = $this->load->view('back/poppup_notification_suppr_view.php', $data, true);

        echo $poppup;
        /************ END (pour affichage Notification) **************/

    }else{
        redirect('login');
    }
}



}