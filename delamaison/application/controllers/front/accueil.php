<?php


class Accueil extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        $this->load->library('Datatables');
    }

    

    public function index()
    {

        $this->datatable();

    }

    public function datatable()
    {
        $level = $this->session->userdata('level');

        if($this->session->userdata('loggin') && $level == "admin"){

          $results = $this->datatables->select('matricule,campagne_id,etapes,debut,fin')
          //->unset_column('campagne_id')
          ->from('vw_historique');

          echo $this->datatables->generate();

        }else{

          redirect('login');

        } 
    }

    public function datatableUser()
    {
        $level = $this->session->userdata('level');

        // var_dump($level);

        if($this->session->userdata('loggin') && $level == "user"){

          $mle = (int) $this->session->userdata('mle');

          $results = $this->datatables->select('campagne_id,etapes,debut,fin')
                      ->where('matricule', $mle)
          //->unset_column('campagne_id')
          ->from('vw_historique');

          echo $this->datatables->generate();

        }else{

          redirect('login');

        } 
    }


    public function datatableAdmin()
    {
        $level = $this->session->userdata('level');

        // var_dump($level);

        if($this->session->userdata('loggin') && $level == "admin"){

          $mle = (int) $this->session->userdata('mle');

          $results = $this->datatables->select("
              matricule,
              level,
              prenom,
              mail,
              (CASE 
                  WHEN  statut = 1 THEN '<span class=\"label label-success\"> ACTIVER </span>'
                    ELSE '<span class=\"label label-danger\"> DESACTIVER </span>'
                  END) AS statut
              ,
              (CASE 
                  WHEN  gestion_user = 1 THEN '<span class=\"label label-success\" data-toggle=\"tooltip\" data-original-title=\"GESTION DES UTILISATEUR\" data-placement=\"right\"> OUI </span> '
                    ELSE '<span class=\"label label-danger\" data-toggle=\"tooltip\" data-original-title=\"GESTION DES UTILISATEUR\" data-placement=\"right\"> NON </span>'
                  END) AS gestion_user,
              (CASE 
                  WHEN  gestion_process = 1 THEN '<span class=\"label label-success\" data-toggle=\"tooltip\" data-original-title=\"GESTION DES PROCESSUS\" data-placement=\"right\"> OUI </span> '
                    ELSE '<span class=\"label label-danger\" data-toggle=\"tooltip\" data-original-title=\"GESTION DES PROCESSUS\" data-placement=\"right\"> NON </span>'
                  END) AS gestion_process,
              ('<div class=\"btn-group btn-group-sm\"><a href=\"#modifier-user-'  || fte_user_id || '\" data-toggle=\"modal\" class=\"btn btn-inverse\"><i class=\"fa fa-pencil\"></i></a></div>') as fte_user_id,
              ('<div class=\"btn-group btn-group-sm\"><a href=\"#supprimer-user-' || fte_user_id || '\" data-toggle=\"modal\" class=\"btn btn-danger\"><i class=\"fa fa-times\"></i></a></div>') as fte_user_id2
              ")
          ->where('flag', 1)
          ->from('fte_user');


          // $this->datatables->add_column('modifier', '
          //           <div class="btn-group btn-group-sm">
          //             <a href="#modifier-user-" data-toggle="modal" class="btn btn-inverse"><i class="fa fa-pencil"></i></a>
          //           </div>');
          // $this->datatables->add_column('supprimer', '
          //           <div class="btn-group btn-group-sm">
          //             <a href="#supprimer-user-" data-toggle="modal" class="btn btn-danger"><i class="fa fa-times"></i></a>
          //           </div>');

          echo $this->datatables->generate();

        }else{
            redirect('login');
        }

    }
    
    public function datatableNotif()
    {
        $level = $this->session->userdata('level');

        if($this->session->userdata('loggin') && $level == "admin"){
          $results = $this->datatables->select('titre,crp,clr,visible,createur,dt_creation,vues,modif,suppr')
                  ->from('vw_notification_maj');

          echo $this->datatables->generate();

        }else{
            redirect('login');
        }

    }

}