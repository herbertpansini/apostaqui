<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Aposta extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('aposta_model');
        $this->load->model('jogo_model');
    }

    public function index_get() {
        $aposta = $this->aposta_model->get();
        if (!is_null($aposta)) {
            $this->response(array('response' => $aposta), 200);
        } else {
            $this->response(array('error' => 'No hay apostas en la base de datos...'), 200);
        }
    }

    public function find_get($id_usuario) {
        if (!$id_usuario) {
            $this->response(null, 400);
        }
        $aposta = $this->aposta_model->get($id_usuario);
        if (!is_null($aposta)) {
            $this->response(array('response' => $aposta), 200);
        } else {
            $this->response(array('error' => 'Aposta no encontrada...'), 200);
        }
    }

    public function index_post() {
        /*if (!$this->post('aposta')) {
            $this->response(null, 400);
        }
        $id = $this->aposta_model->save($this->post('aposta'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }*/
        
        if (!$this->post('aposta')) {
            $this->response(null, 400);
        }
        
	$id = null;
        $this->db->trans_begin();
	try {
                $aposta = $this->post('aposta');			
		$id = $this->aposta_model->save($aposta);
                
		foreach($aposta['itens_aposta'] as $itensaposta) {
			$itensaposta['aposta_id'] = $id;
			$this->jogo_model->save($itensaposta);
		}
                
		$this->db->trans_commit();			
	} catch (Exception $e) {
		//something broke, hit undo
                $this->db->trans_rollback();
	}
        
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }

    public function index_put($id) {
        if (!$this->put('aposta') || !$id) {
            $this->response(null, 400);
        }
        
        $update = $this->aposta_model->update($id, $this->put('aposta'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Aposta actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->aposta_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}