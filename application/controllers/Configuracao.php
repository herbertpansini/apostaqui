<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Configuracao extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracao_model');
    }

    public function index_get() {
        $config = $this->configuracao_model->get();

        if (!is_null($config)) {
            $this->response(array('response' => $config), 200);
        } else {
            $this->response(array('error' => 'No hay configuraciones en la base de datos...'), 200);
        }
    }

    public function find_get($id_rodada) {
        if (!$id_rodada) {
            $this->response(null, 400);
        }
        $config = $this->configuracao_model->get($id_rodada);

        if (!is_null($config)) {
            $this->response(array('response' => $config), 200);
        } else {
            $this->response(array('error' => 'Configuración no encontrada...'), 200);
        }
    }

    public function index_post($id) {
        if (!$this->post('configuracao') || !$id) {
            $this->response(null, 400);
        }

        $update = $this->configuracao_model->update($id, $this->post('configuracao'));

        if (!is_null($update)) {
            $this->response(array('response' => 1), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->configuracao_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Configuración eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }
}