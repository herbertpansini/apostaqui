<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Relatorio extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('relatorio_model');
    }
    
    public function index_get() {        
        $relatorio = $this->relatorio_model->get();
        
        if (!is_null($relatorio)) {
            $this->response(array('response' => $relatorio), 200);
        } else {
            $this->response(array('error' => 'Relatório no encontrado...'), 200);
        }
    }
    
    public function find_get($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $relatorio = $this->relatorio_model->get($id);

        if (!is_null($relatorio)) {
            $this->response(array('response' => $relatorio), 200);
        } else {
            $this->response(array('error' => 'Relatório no encontrado...'), 200);
        }
    }
}