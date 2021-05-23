<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('perfil')->where('perfil_id', $id)->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('perfil')->order_by('descricao', 'ASC')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }
}