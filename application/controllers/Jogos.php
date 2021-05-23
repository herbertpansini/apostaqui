<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Jogos extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('jogos_model');
    }
    
    public function index_get($id_usuario) {
        if (!$id_usuario) {
            $this->response(null, 400);
        }
        $jogos = $this->jogos_model->get($id_usuario);
        if (!is_null($jogos)) {
            $this->response(array('response' => $jogos), 200);
        } else {
            $this->response(array('error' => 'Jogos no encontrados...'), 200);
        }
    }
    
    public function find_get($id_rodada, $id_usuario) {
        if (!$id_rodada || !$id_usuario) {
            $this->response(null, 400);
        }
        $jogos = $this->jogos_model->find($id_rodada, $id_usuario);
        if (!is_null($jogos)) {
            $this->response(array('response' => $jogos), 200);
        } else {
            $this->response(array('error' => 'Jogos no encontrados...'), 200);
        }
    }
}