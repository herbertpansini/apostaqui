<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogos_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get($id_usuario = null) {
        if (!is_null($id_usuario)) {
            $sql = "SELECT aposta.aposta_id   
                          ,rodada.numero
                          ,equipe_mandante.nome as nome_equipe_mandante
                          ,equipe_mandante.sigla as sigla_equipe_mandante
                          ,item_aposta.opcao
                          ,equipe_visitante.sigla as sigla_equipe_visitante
                          ,equipe_visitante.nome as nome_equipe_visitante                          
                          ,IF (confronto.confronto_id IN (181, 186, 232, 236, 240), 1, IFNULL(confronto.placar_equipe_mandante, -1)) as jogou
                          ,IF (confronto.confronto_id IN (181, 186, 232, 236, 240), 1, CASE WHEN (case when (confronto.placar_equipe_mandante > confronto.placar_equipe_visitante) THEN 0 
                                           when (confronto.placar_equipe_mandante = confronto.placar_equipe_visitante) THEN 1 
                                           when (confronto.placar_equipe_mandante < confronto.placar_equipe_visitante) THEN 2 END = item_aposta.opcao) THEN 1 
                           ELSE 0 END) as acertou
                    FROM aposta
                    INNER JOIN item_aposta ON
                    (aposta.aposta_id = item_aposta.aposta_id)
                    INNER JOIN rodada ON
                    (rodada.rodada_id = aposta.rodada_id)
                    INNER JOIN confronto ON
                    (confronto.confronto_id = item_aposta.confronto_id)
                    INNER JOIN equipe equipe_mandante ON 
                    (equipe_mandante.equipe_id = confronto.equipe_mandante)
                    INNER JOIN equipe equipe_visitante ON 
                    (equipe_visitante.equipe_id = confronto.equipe_visitante)
                    WHERE confronto.rodada_id >= (select rodada_id from rodada where campeonato_id = 1 and ativa > 0)
                      and aposta.usuario_id = ?
                    ORDER BY aposta.aposta_id asc, item_aposta.item_aposta_id asc, confronto.horario asc";
            
            $query = $this->db->query($sql, array($id_usuario)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        return null;
    }

    public function find($id_rodada = null, $id_usuario = null) {
        if (!is_null($id_rodada) && !is_null($id_usuario)) {
            $sql = "SELECT aposta.aposta_id   
                          ,rodada.numero                          
                          ,equipe_mandante.nome as nome_equipe_mandante
                          ,equipe_mandante.sigla as sigla_equipe_mandante
                          ,item_aposta.opcao
                          ,equipe_visitante.sigla as sigla_equipe_visitante
                          ,equipe_visitante.nome as nome_equipe_visitante                          
                          ,IF (confronto.confronto_id IN (181, 186, 232, 236, 240), 1, IFNULL(confronto.placar_equipe_mandante, -1)) as jogou
                          ,IF (confronto.confronto_id IN (181, 186, 232, 236, 240), 1,CASE WHEN (case when (confronto.placar_equipe_mandante > confronto.placar_equipe_visitante) THEN 0 
                                           when (confronto.placar_equipe_mandante = confronto.placar_equipe_visitante) THEN 1 
                                           when (confronto.placar_equipe_mandante < confronto.placar_equipe_visitante) THEN 2 END = item_aposta.opcao) THEN 1 
                           ELSE 0 END) as acertou
                    FROM aposta
                    INNER JOIN item_aposta ON
                    (aposta.aposta_id = item_aposta.aposta_id)
                    INNER JOIN rodada ON
                    (rodada.rodada_id = aposta.rodada_id)
                    INNER JOIN confronto ON
                    (confronto.confronto_id = item_aposta.confronto_id)
                    INNER JOIN equipe equipe_mandante ON 
                    (equipe_mandante.equipe_id = confronto.equipe_mandante)
                    INNER JOIN equipe equipe_visitante ON 
                    (equipe_visitante.equipe_id = confronto.equipe_visitante)
                    WHERE confronto.rodada_id = ?
                      and aposta.usuario_id = ?
                    ORDER BY aposta.aposta_id asc, item_aposta.item_aposta_id asc, confronto.horario asc";
            
            $query = $this->db->query($sql, array($id_rodada, $id_usuario)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        return null;
    }
}