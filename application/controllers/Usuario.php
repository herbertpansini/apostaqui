<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Usuario extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }

    public function index_get() {
        $usuario = $this->usuario_model->get();
        if (!is_null($usuario)) {
            $this->response(array('response' => $usuario), 200);
        } else {
            $this->response(array('error' => 'No hay usuários en la base de datos...'), 200);
        }
    }

    public function find_get($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $usuario = $this->usuario_model->get($id);

        if (!is_null($usuario)) {
            $this->response(array('response' => $usuario), 200);
        } else {
            $this->response(array('error' => 'Usuário no encontrado...'), 200);
        }
    }

    public function index_post() {
        if (!$this->post('usuario')) {
            $this->response(null, 400);
        }

        $id = $this->usuario_model->save($this->post('usuario'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);            
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
    
    public function index_put($id) {
        if (!$this->put('usuario') || !$id) {
            $this->response(null, 400);
        }
        
        $update = $this->usuario_model->update($id, $this->put('usuario'));
        if (!is_null($update)) {
            $this->response(array('response' => $update), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->usuario_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Usuário eliminado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}