<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Tabela extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('tabela_model');
    }
    
    public function index_get($id_rodada) {  
        if (!$id_rodada) {
            $this->response(null, 400);
        }
        $tabela = $this->tabela_model->get($id_rodada);
        
        if (!is_null($tabela)) {
            $this->response(array('response' => $tabela), 200);
        } else {
            $this->response(array('error' => 'Clasificados no encontrados...'), 200);
        }
    }
    
    public function find_get($id_rodada, $id_usuario) {
        if (!$id_rodada || !$id_usuario) {
            $this->response(null, 400);
        }
        
        $tabela = $this->tabela_model->find($id_rodada, $id_usuario);
        if (!is_null($tabela)) {
            $this->response(array('response' => $tabela), 200);
        } else {
            $this->response(array('error' => 'Pontuação no encontrada...'), 200);
        }
    }
}