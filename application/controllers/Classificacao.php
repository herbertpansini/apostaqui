<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Classificacao extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('classificacao_model');
    }
    
    public function index_get() {        
        $classificacao = $this->classificacao_model->get();
        
        if (!is_null($classificacao)) {
            $this->response(array('response' => $classificacao), 200);
        } else {
            $this->response(array('error' => 'Clasificados no encontrados...'), 200);
        }
    }
    
    public function find_get($id_usuario) {
        if (!$id_usuario) {
            $this->response(null, 400);
        }
        
        $classificacao = $this->classificacao_model->get($id_usuario);
        if (!is_null($classificacao)) {
            $this->response(array('response' => $classificacao), 200);
        } else {
            $this->response(array('error' => 'Pontuação no encontrada...'), 200);
        }
    }
}