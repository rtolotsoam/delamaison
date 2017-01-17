<?php 
class Fte_categories extends CI_Model
{
	
	protected $table = 'fte_categories';

	public function liste_categories()
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function search($id, $critere)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('categories_id', $id)
						->where('flag', 1)
						->where('traitement_id !=', 0)
						->ilike('libelle_categories', $critere)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_tree($id)
	{
		$rq = $this->db->select("
			fte_categories_id as id, 
			libelle_categories as text, 
			parent_id,
			(CASE 
				WHEN  traitement_id = 0 THEN 'jstree-default jstree-folder'
				ELSE 'jstree-default jstree-file'
			END) AS icon
		")
						->from($this->table)
						->where('root_id', $id)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('fte_categories_id', $id)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_traitement_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('traitement_id', $id)
						->where('flag', 1)
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_niveau($niveau)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('niveau', $niveau)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_parent($parent)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('parent_id', $parent)
						->where('flag', 1)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}


	public function liste_categories_by_categories_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('categories_id', $id)
						->where('flag', 1)
						->where('niveau', 2)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function liste_categories_by_root_id($id)
	{
		$rq = $this->db->select('*')
						->from($this->table)
						->where('root_id', $id)
						->where('flag', 1)
						->where('niveau', 2)
						->order_by('fte_categories_id', 'asc')
						->get();

		if( $rq->num_rows > 0 ){
			return $rq->result();
		}
		return false;
	}

	public function ajouter_sous_categories($data)
	{
		
		$this->db->insert($this->table, $data);
    	return $this->db->insert_id();
    	
	}


	public function editer_categories($id, $data) {
		return $this->db->where("fte_categories_id", $id)
						->update($this->table, $data);
	}
		
}