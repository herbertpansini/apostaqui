<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function signin($login) {
        if (!is_null($login)) {
            $sql = "SELECT usuario_id, nome, telefone, email, senha, perfil_id
                    FROM usuario
                    WHERE email = ?
                      AND senha = ?";
            
            $query = $this->db->query($sql, array($login['email'], $login['senha'])); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        return null;
    }
}