<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confronto_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get($id_rodada = null) {
        if (!is_null($id_rodada)) {
            $sql  = " SELECT confronto.*
                            ,rodada.numero as numero_rodada
                            ,mandante.nome as nome_equipe_mandante
                            ,mandante.sigla as sigla_equipe_mandante
                            ,visitante.nome as nome_equipe_visitante
                            ,visitante.sigla as sigla_equipe_visitante
                      FROM confronto
                      INNER JOIN rodada ON (rodada.rodada_id = confronto.rodada_id)                  
                      INNER JOIN equipe as mandante ON (mandante.equipe_id = confronto.equipe_mandante)
                      INNER JOIN equipe as visitante ON (visitante.equipe_id = confronto.equipe_visitante)
                      WHERE rodada.rodada_id = ? AND rodada.campeonato_id = 1
                      ORDER BY confronto.horario ASC";

            $query = $this->db->query($sql, array($id_rodada)); // set parameter
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        
        $sql  = " SELECT confronto.*
                            ,rodada.numero as numero_rodada
                            ,mandante.nome as nome_equipe_mandante
                            ,mandante.sigla as sigla_equipe_mandante
                            ,visitante.nome as nome_equipe_visitante
                            ,visitante.sigla as sigla_equipe_visitante
                      FROM confronto
                      INNER JOIN rodada ON (rodada.rodada_id = confronto.rodada_id)                  
                      INNER JOIN equipe as mandante ON (mandante.equipe_id = confronto.equipe_mandante)
                      INNER JOIN equipe as visitante ON (visitante.equipe_id = confronto.equipe_visitante)
                      WHERE rodada.ativa = 1 
                        AND rodada.campeonato_id = 1
                      ORDER BY confronto.horario ASC";
        
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
    }

    public function save($confronto) {
        $this->db->set($this->_setConfronto($confronto))->insert('confronto');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($id, $confronto) {        
        $this->db->set($this->_setUpConfronto($confronto))->where('confronto_id', $id)->update('confronto');
        if ($this->db->affected_rows() === 1) {
            return $this->db->affected_rows();
        }
        return null;
    }

    public function delete($id) {
        $this->db->where('confronto_id', $id)->delete('confronto');
        if ($this->db->affected_rows() === 1) {
            return $this->db->affected_rows();
        }
        return null;
    }

    private function _setConfronto($confronto) {
        return array(
            'rodada_id' => $confronto['rodada_id'],
            'horario' => $confronto['horario'],
            'equipe_mandante' => $confronto['equipe_mandante'],
            'equipe_visitante' => $confronto['equipe_visitante']
        );
    }
    
    private function _setUpConfronto($confronto) {
        return array(
            'rodada_id' => $confronto['rodada_id'],
            'horario' => $confronto['horario'],
            'equipe_mandante' => $confronto['equipe_mandante'],
            'placar_equipe_mandante' => $confronto['placar_equipe_mandante'],
            'placar_equipe_visitante' => $confronto['placar_equipe_visitante'],
            'equipe_visitante' => $confronto['equipe_visitante']
        );
    }
}