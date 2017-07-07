<?php

class Fte_notification_maj extends CI_Model{
    
    private $table_notif = 'fte_notification_maj';
    private $table_consulte = 'fte_notification_maj_consulte';
    
    public function notification_for($matricule){
        $requet = "SELECT * FROM $this->table_notif WHERE fte_notification_maj_id NOT IN (SELECT fte_notification_maj_id FROM $this->table_consulte WHERE consulte = $matricule) AND active = 1 ORDER BY date_creation DESC, titre";
        $rep = $this->db->query($requet);
        return $rep->result();
    }
    
    public function nb_notification_for($matricule){
        $requet = "SELECT * FROM $this->table_notif WHERE fte_notification_maj_id NOT IN (SELECT fte_notification_maj_id FROM $this->table_consulte WHERE consulte = $matricule) AND active = 1 ORDER BY date_creation DESC, titre";
        $query = $this->db->query($requet);
        return $query->num_rows();
    }
    
    public function la_notification($id){
        return $this->db->select('titre, corps, couleur, active')
                ->from($this->table_notif)
                ->where('fte_notification_maj_id',$id)
                ->get()->result();
    }
    
    public function new_notification($titre, $corps, $couleur, $active, $createur){
        $this->db->set('titre',$titre);
        $this->db->set('corps',$corps);
        $this->db->set('couleur',$couleur);
        if ($active == 0) {
            $this->db->set('active', $active);
        }
        $this->db->set('createur',$createur);
        return $this->db->insert($this->table_notif);
    }
    
    public function new_consultation($id_notification, $matricule){
        $this->db->set('fte_notification_maj_id',$id_notification);
        $this->db->set('consulte',$matricule);
        return $this->db->insert($this->table_consulte);
    }
    
    public function update_notification($id, $titre, $corps, $couleur, $active){
        $data = array(
            'titre' => $titre,
            'corps' => $corps,
            'couleur' => $couleur,
            'active' => $active
        );
        $this->db->where('fte_notification_maj_id',$id);
        return $this->db->update($this->table_notif,$data);
    }
    
    public function renew_notification($id){
        $this->db->where('fte_notification_maj_id',$id);
        return $this->db->delete($this->table_consulte);
    }
    
    public function suppression_notification($id) {
        $this->renew_notification($id);
        $this->db->where('fte_notification_maj_id',$id);
        return $this->db->delete($this->table_notif);
    }
    
}