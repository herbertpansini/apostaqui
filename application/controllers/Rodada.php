<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Rodada extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('rodada_model');
    }

    public function index_get() {
        $rodada = $this->rodada_model->get();
        if (!is_null($rodada)) {
            $this->response(array('response' => $rodada), 200);
        } else {
            $this->response(array('error' => 'No hay rodadas en la base de datos...'), 200);
        }
    }

    public function find_get($id_campeonato) {
        if (!$id_campeonato) {
            $this->response(null, 400);
        }
        
        $rodada = $this->rodada_model->get($id_campeonato);
        if (!is_null($rodada)) {
            $this->response(array('response' => $rodada), 200);
        } else {
            $this->response(array('error' => 'Rodada no encontrada...'), 200);
        }
    }

    public function index_post() {
        if (!$this->post('rodada')) {
            $this->response(null, 400);
        }
        $id = $this->rodada_model->save($this->post('rodada'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put($id) {
        if (!$this->put('rodada') || !$id) {
            $this->response(null, 400);
        }
        $update = $this->rodada_model->update($id, $this->put('rodada'));
        if (!is_null($update)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->rodada_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Rodada eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}