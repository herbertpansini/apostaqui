<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Bet extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('bet_model');
        $this->load->model('betdetail_model');
    }

    public function index_get() {
        $bet = $this->bet_model->get();
        if (!is_null($bet)) {
            $this->response(array('response' => $bet), 200);
        } else {
            $this->response(array('error' => 'No hay Bet en la base de datos...'), 200);
        }
    }

    public function find_get($id_user) {
        if (!$id_user) {
            $this->response(null, 400);
        }
        $bet = $this->bet_model->get($id_user);
        if (!is_null($bet)) {
            $this->response(array('response' => $bet), 200);
        } else {
            $this->response(array('error' => 'Bet no encontrada...'), 200);
        }
    }

    public function index_post() {
        if (!$this->post('bet')) {
            $this->response(null, 400);
        }
        
	$id = null;
        $this->db->trans_begin();
	try {
                $bet = $this->post('bet');
			
		$id = $this->bet_model->save($bet);
			
		foreach($bet['bet_details'] as $betdetail) {
			$betdetail['bet_id'] = $id;
			$this->betdetail_model->save($betdetail);
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
        if (!$this->put('bet') || !$id) {
            $this->response(null, 400);
        }
        
        $update = $this->bet_model->update($id, $this->put('bet'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Bet actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->bet_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }
}