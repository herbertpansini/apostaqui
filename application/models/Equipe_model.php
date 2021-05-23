<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('equipe')->where('equipe_id', $id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('equipe')->order_by('nome', 'asc')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($equipe) {
        $this->db->set($this->_setEquipe($equipe))->insert('equipe');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($id, $equipe) {
        $this->db->set($this->_setEquipe($equipe))->where('equipe_id', $id)->update('equipe');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('equipe_id', $id)->delete('equipe');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return false;
    }

    private function _setEquipe($equipe) {
        return array(
            'nome' => $equipe['nome'],
            'sigla' => $equipe['sigla']
        );
    }
}