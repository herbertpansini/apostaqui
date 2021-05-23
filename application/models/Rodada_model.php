<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rodada_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id_campeonato = null) {
        if (!is_null($id_campeonato)) {
            $sql = "SELECT *
                    FROM rodada
                    WHERE campeonato_id = ?
                    ORDER BY numero ASC";
            
            $query = $this->db->query($sql, array($id_campeonato)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        
        $query = $this->db->select('*')->from('rodada')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($rodada) {
        $this->db->set($this->_setRodada($rodada))->insert('rodada');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($id, $rodada) {        
        $this->db->set($this->_setRodada($rodada))->where('rodada_id', $id)->update('rodada');
        
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('rodada_id', $id)->delete('rodada');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setRodada($rodada) {
        return array(
            'ano' => $rodada['ano'],
            'numero' => $rodada['numero'],
            'campeonato_id' => $rodada['campeonato_id'],
            'ativa' => $rodada['ativa']
        );
    }
}