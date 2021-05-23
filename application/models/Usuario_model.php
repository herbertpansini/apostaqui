<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('usuario')->where('usuario_id', $id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }

        $query = $this->db->select('*')->from('usuario')->order_by("nome", "asc")->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($usuario) {
        $this->db->set($this->_setUsuario($usuario))->insert('usuario');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();            
        }
        return null;
    }
    
    public function update($id, $usuario) {
        $this->db->set($this->_setUsuario($usuario))->where('usuario_id', $id)->update('usuario');
        if ($this->db->affected_rows() === 1) {
            return $this->db->affected_rows();
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('usuario_id', $id)->delete('usuario');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setUsuario($usuario) {
        return array(
            'nome' => $usuario['nome'],
            'telefone' => $usuario['telefone'],
            'email' => $usuario['email'],
            'senha' => $usuario['senha'],
            'perfil_id' => $usuario['perfil_id']
        );
    }
}