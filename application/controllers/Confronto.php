<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Confronto extends REST_Controller {
  
    public function __construct() {
        parent::__construct();
        $this->load->model('confronto_model');
    }
    
    public function index_get() {
        $confronto = $this->confronto_model->get();
        if (!is_null($confronto)) {
            $this->response(array('response' => $confronto), 200);
        } else {
            $this->response(array('error' => 'No hay apostas en la base de datos...'), 200);
        }
    }

    public function find_get($id_rodada) {
        if (!$id_rodada) {
            $this->response(null, 400);
        }
        $confronto = $this->confronto_model->get($id_rodada);
        if (!is_null($confronto)) {
            $this->response(array('response' => $confronto), 200);
        } else {
            $this->response(array('error' => 'Confronto no encontrado...'), 200);
        }
    }

    public function index_post() {
        if (!$this->post('confronto')) {
            $this->response(null, 400);
        }
        $id = $this->confronto_model->save($this->post('confronto'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put($id) {
        if (!$this->put('confronto') || !$id) {
            $this->response(null, 400);
        }
        $update = $this->confronto_model->update($id, $this->put('confronto'));
        if (!is_null($update)) {
            $this->response(array('response' => $update), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->confronto_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => $delete), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}