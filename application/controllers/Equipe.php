<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Equipe extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('equipe_model');
    }

    public function index_get() {
        $equipe = $this->equipe_model->get();
        if (!is_null($equipe)) {
            $this->response(array('response' => $equipe), 200);
        } else {
            $this->response(array('error' => 'No hay equipes en la base de datos...'), 200);
        }
    }

    public function find_get($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $equipe = $this->equipe_model->get($id);
        if (!is_null($equipe)) {
            $this->response(array($equipe), 200);
        } else {
            $this->response(array('error' => 'Equipe no encontrada...'), 200);
        }
    }

    public function index_post() {
        if (!$this->post('equipe')) {
            $this->response(null, 400);
        }
        $id = $this->equipe_model->save($this->post('equipe'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put($id) {
        if (!$this->put('equipe') || !$id) {
            $this->response(null, 400);
        }

        $update = $this->equipe_model->update($id, $this->put('equipe'));

        if (!is_null($update)) {
            $this->response(array('response' => 'Equipe actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id) {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->equipe_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Equipe eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}