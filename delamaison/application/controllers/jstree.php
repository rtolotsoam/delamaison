<?php

class Jstree extends CI_Controller {

	public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_categories','cats');
    }

	public function index($id)
	{
		$this->jstree($id);
	}

	public function jstree($id)
	{

		$level = $this->session->userdata('level');

        if($this->session->userdata('loggin') && ($level =="admin" || $level =="user")){
		
				$id_root = (int) $id;

				// CODE
				$data = $this->cats->liste_categories_tree($id_root);

				//var_dump($data);

				$array = json_decode(json_encode($data), True);

				//var_dump($array);
				
				$itemsByReference = array();


				// Build array of item references:
				foreach($array as $key => &$item) {
				  
				   $itemsByReference[$item['id']] = &$item;
				   // Children array:
				   $itemsByReference[$item['id']]['children'] = array();
				   // Empty data class (so that json_encode adds "data: {}" ) 
				  	$itemsByReference[$item['id']]['array'] = new StdClass();
				}

				

				// Set items as children of the relevant parent item.
				foreach($array as $key => &$item)
				   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
				      $itemsByReference [$item['parent_id']]['children'][] = &$item;

				// Remove items that were added to parents elsewhere:
				foreach($array as $key => &$item) {
				   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
				      unset($array[$key]);
				}
				// Encode:
				header('Content-Type: application/json');
				echo json_encode($array);
				
				// END CODE

		}else{
            redirect('login');
        }		
	}
}

