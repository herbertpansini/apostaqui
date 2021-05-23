<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogo_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id_aposta = null) {
        if (!is_null($id_aposta)) {
            $query = $this->db->select('*')->from('item_aposta')->where('aposta_id', $id_aposta)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('item_aposta')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($itemaposta) {
        $this->db->set($this->_setItemAposta($itemaposta))->insert('item_aposta');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($id, $itemaposta) {
        $this->db->set($this->_setItemAposta($itemaposta))->where('item_aposta_id', $id)->update('item_aposta');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('aposta_id', $id)->delete('item_aposta');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    private function _setItemAposta($itemaposta) {
        return array(
            'aposta_id'    => $itemaposta['aposta_id'],
            'confronto_id' => $itemaposta['confronto_id'],
            'opcao' => $itemaposta['opcao']
        );
    }
}