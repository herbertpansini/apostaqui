<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id_rodada = null) {
        if (!is_null($id_rodada)) {
        $sql = "SELECT DATE_ADD(DATE_ADD(NOW(),INTERVAL -0 HOUR_MINUTE), INTERVAL (60 * (SELECT QUANTIDADE_HORAS FROM configuracao WHERE 1)) HOUR_MINUTE) 
                        <= MIN(confronto.horario) as pode_apostar
                FROM confronto
                INNER JOIN rodada ON 
                      (rodada.rodada_id = confronto.rodada_id)
                WHERE rodada.rodada_id = ? 
                  AND rodada.campeonato_id = 1
                ORDER BY confronto.horario ASC";
        
            $query = $this->db->query($sql, array($id_rodada)); // set parameter
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }  
            return null;
        }
        
        $query = $this->db->select('*')->from('configuracao')->where('configuracao_id', 1)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return null;
    }

    public function save($configuracao) {
        $this->db->set($this->_setConfiguracao($configuracao))->insert('configuracao');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($id, $configuracao) {
        $this->db->set($this->_setConfiguracao($configuracao))->where('configuracao_id', $id)->update('configuracao');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('configuracao_id', $id)->delete('configuracao');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return false;
    }

    private function _setConfiguracao($configuracao) {
        return array(
            'quantidade_horas' => $configuracao['quantidade_horas']
        );
    }
}