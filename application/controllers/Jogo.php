<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Jogo extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('jogo_model');
    }

    public function index_get() {
        $itemaposta = $this->jogo_model->get();
        if (!is_null($itemaposta)) {
            $this->response(array('response' => $itemaposta), 200);
        } else {
            $this->response(array('error' => 'No hay Itens Aposta en la base de datos...'), 200);
        }
    }

    public function find_get($id_aposta) {
        if (!$id_aposta) {
            $this->response(null, 400);
        }
        $itemaposta = $this->jogo_model->get($id_aposta);
        if (!is_null($itemaposta)) {
            $this->response(array('response' => $itemaposta), 200);
        } else {
            $this->response(array('error' => 'Item Aposta no encontrado...'), 200);
        }
    }

    public function index_post() {
        /*if (!$this->post('item_aposta')) {
            $this->response(null, 400);
        }
        
        $id = $this->jogo_model->save($this->post('item_aposta'));        
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }*/
        
        if (!$this->post('itens_aposta')) {
            $this->response(null, 400);
        }
        
        $this->db->trans_begin();
        
        $id = null;
        $itens = $this->post('itens_aposta');
        foreach($itens as $item) {
            $id = $this->jogo_model->save($item);
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put($id) {
        if (!$this->put('item_aposta') || !$id) {
            $this->response(null, 400);
        }

        $update = $this->jogo_model->update($id, $this->put('item_aposta'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Item Aposta actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        
        $delete = $this->jogo_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}