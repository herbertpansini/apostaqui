<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Pendente extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('pendente_model');
    }
    
    public function index_get() {        
        $pendentes = $this->pendente_model->get();
        if (!is_null($pendentes)) {
            $this->response(array('response' => $pendentes), 200);
        } else {
            $this->response(array('error' => 'No data...'), 200);
        }
    }
    
    public function find_get($is_valid) {
        if (!$is_valid) {
            $this->response(null, 400);
        }
        $pendentes = $this->pendente_model->get($is_valid);
        if (!is_null($pendentes)) {
            $this->response(array('response' => $pendentes), 200);
        } else {
            $this->response(array('error' => 'No data...'), 200);
        }
    }
}