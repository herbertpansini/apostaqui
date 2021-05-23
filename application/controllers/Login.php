<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }    

    public function index_post() {
        if (!$this->post('login')) {
            $this->response(null, 400);
        }

        $usuario = $this->login_model->signin($this->post('login'));
        if (!is_null($usuario)) {
            $this->response(array('response' => $usuario), 200);            
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}