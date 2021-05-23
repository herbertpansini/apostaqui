<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Pendencia extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('pendencia_model');
    }
    
    public function find_get($id_rodada) {
        if (!$id_rodada) {
            $this->response(null, 400);
        }
        $pendentes = $this->pendencia_model->get($id_rodada);
        if (!is_null($pendentes)) {
            $this->response(array('response' => $pendentes), 200);
        } else {
            $this->response(array('error' => 'No data...'), 404);
        }
    }
}