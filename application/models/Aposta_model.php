<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aposta_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id_usuario = null) {
        if (!is_null($id_usuario)) {
            $query = $this->db->select('*')->from('aposta')->where('usuario_id', $id_usuario)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('aposta')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($aposta) {
        if ($aposta['usuario_id'] === 0) {
           return null;
        }
        
        $this->db->set($this->_setAposta($aposta))->insert('aposta');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }
    
    public function validate($aposta) {
        $sql = "update aposta set valida = ?
                                 ,usuario_id_adm = ? 
                where usuario_id = ?                  
                  and  rodada_id = ?";
        
        $this->db->query($sql, array($aposta['valida'], $aposta['usuario_id_adm'], $aposta['usuario_id'], $aposta['rodada_id'])); // set parameter
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return null;
    }
    
    public function validated() {
        $sql = "SELECT aposta.usuario_id_adm
                    ,usuario.nome
                      ,COUNT(*) AS quantidade
                FROM aposta
                INNER JOIN rodada ON
                (rodada.rodada_id = aposta.rodada_id)
                INNER JOIN usuario ON
                (usuario.usuario_id = aposta.usuario_id_adm)
                WHERE rodada.ativa = 1
                  AND aposta.valida = 1
                GROUP BY aposta.usuario_id_adm
                          ,usuario.nome
                ORDER BY usuario.nome ASC";
        
        $query = $this->db->query($sql);
            
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }     

    public function update($id, $aposta) {
        $this->db->set($this->_setAposta($aposta))->where('aposta_id', $id)->update('aposta');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('aposta_id', $id)->delete('aposta');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return false;
    }

    private function _setAposta($aposta) {
        return array(
            'aposta_id'    => $aposta['aposta_id'],
            'usuario_id' => $aposta['usuario_id'],
            'rodada_id' => $aposta['rodada_id'],
            'valida' => $aposta['valida']
        );
    }
}