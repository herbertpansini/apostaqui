<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Perfil extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('perfil_model');
    }

    public function index_get() {
        $perfil = $this->perfil_model->get();
        if (!is_null($perfil)) {
            $this->response(array('response' => $perfil), 200);
        } else {
            $this->response(array('error' => 'No hay Profiles en la base de datos...'), 200);
        }
    }

    public function find_get($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        
        $perfil = $this->perfil_model->get($id);
        if (!is_null($perfil)) {
            $this->response(array('response' => $perfil), 200);
        } else {
            $this->response(array('error' => 'Profile no encontrado...'), 200);
        }
    }
}