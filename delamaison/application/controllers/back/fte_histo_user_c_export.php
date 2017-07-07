<?php


class Fte_histo_user_c_export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('fte_histo_user_export','histo_export');
        $this->load->model('fte_processus','libelle');
        $this->load->model('fte_historique_view','vhist');
        $this->load->model('fte_traitement','trait');

        $this->load->library('excel');
        $this->load->library('style_export');
        
    }

    public function index()
    {
        $col_number     = 1;
        $liste_number   = 1;
        $count_row      = 0;

        $coul_Thead     = '#7bb989';
        $date_now       = date('Y-m-d H:i:s');

        $heading        = array('Matricule','Traitement','Processus','Début','Fin');
        $date1          = $this->input->get_post('datepicker1');
        $date1          = implode("-", array_reverse(explode("/", $date1)));
        $date2          = $this->input->get_post('datepicker1b');
        $date2          = implode("-", array_reverse(explode("/", $date2)));
        $list_matr      = $this->input->get_post('list_matr');


        $filename       = 'export_delamaison_'.$date1.'__'.$date2.'_.xls';
        $listeColExcel  = $this->excel->liste_colExcel();
        $donnee_export  = $this->histo_export->histo_user_export($list_matr,$date1,$date2);
        $donnees        = $this->vhist->liste_historique_vw();
        
        foreach ($donnees as $val) {
            $procs = $this->trait->liste_traitement_by_id((int) $val->campagne_id);
            if(!empty($procs)){
                foreach ($procs as $val_proc) {
                    $resultat['lib_'.$val->session_id] = $val_proc->info_traitement;
                     }
                }
            } 
       
       $count_row       = count($donnee_export);

       if( $count_row > 0)
       {
            foreach($heading as $h){
            $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, $h);
            $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)
                ->applyFromArray($this->style_export->background($coul_Thead))
                ->applyFromArray($this->style_export->font_color('FFFFFF'))
                ->applyFromArray($this->style_export->border_style('000000'));
            $col_number++;    
            }
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(150);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(75);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); 
            $this->excel->getActiveSheet()->setTitle("delamaison");
            $this->excel->getActiveSheet()->freezePane('B2');
             foreach ($donnee_export as $data) {
                $matricule_     = "";
                $processus_     = "";
                $debut_         = "";
                $fin_           = "";
                $libelle        = "";

                $matricule_     = $data->matricule;
                $processus_     = $data->etapes ; 
                $debut_         = $data->debut;
                $fin_           = $data->fin;
                $libelle        = $data->campagne_id;
                $proc           = ascii_to_entities($processus_);
                $finale         = html_entity_decode($proc, ENT_COMPAT, 'UTF-8');
                $lib_fi         = ascii_to_entities($libelle);
                $lib_fi         = html_entity_decode($lib_fi, ENT_COMPAT, 'UTF-8');

                $col_number     = 1;
                $liste_number  += 1;
                $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, $matricule_);
                $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)
                            ->applyFromArray($this->style_export->border_style('000000'))
                            ->applyFromArray($this->style_export->center());
                $col_number     +=1;
                $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, $lib_fi);
                $libellee = "" ;
                $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)->applyFromArray($this->style_export->border_style('000000'));            
                $col_number     +=1;
                $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, $finale);
                $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)->applyFromArray($this->style_export->border_style('000000'));
                $col_number     +=1;
                $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, utf8_encode($debut_));
                $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)->applyFromArray($this->style_export->border_style('000000'));
                $col_number     +=1;
                $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, utf8_encode($fin_));
                $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)->applyFromArray($this->style_export->border_style('000000'));

            }
        
       }
       else
       {
            $this->excel->getActiveSheet()->setCellValue($listeColExcel[$col_number].$liste_number, "PAS DE DONNEES");
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(450);
            $this->excel->getActiveSheet()->getStyle($listeColExcel[$col_number].$liste_number)
                            ->applyFromArray($this->style_export->border_style('000000'))
                            ->applyFromArray($this->style_export->center())
                            ->applyFromArray($this->style_export->background($coul_Thead))
                            ->applyFromArray($this->style_export->font_color('FFFFFF'));
       }
       
        $objWriter      = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
        header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output');
        
        exit();


    }


   
}