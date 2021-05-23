<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Validate extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('aposta_model');
    }
    
    public function  index_get() {
        $validated = $this->aposta_model->validated();
        
        if (!is_null($validated)) {
            $this->response(array('response' => $validated), 200);
        } else {
            $this->response(array('error' => 'Not found...'), 200);
        }
    }

    public function index_put() {
        if (!$this->put('aposta')) {
            $this->response(null, 400);
        }
        
        $id = null;
        $this->db->trans_begin();
        try {
            $itens = $this->put('aposta');
            foreach($itens as $item) {
                $id = $this->aposta_model->validate($item);
            }                
            $this->db->trans_commit();
	} catch (Exception $e) {
            //something broke, hit undo
            $this->db->trans_rollback();
	}
        
        if (!is_null($id)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }    
}