<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        if (!is_null($id)) {
            $sql = "  SELECT (NOW() >= MIN(confronto.horario) ) AS pode_gerar
                            ,DAYOFWEEK( MIN(confronto.horario) ) AS dia_semana
                            ,rodada.numero AS numero_rodada
                            ,(SELECT COUNT(aposta.aposta_id) FROM aposta WHERE rodada_id = rodada.rodada_id and aposta.valida = 1) AS apostas
                      FROM confronto
                      INNER JOIN rodada ON 
                      (rodada.rodada_id = confronto.rodada_id)
                      WHERE rodada.ativa = 1
                      AND rodada.campeonato_id = 1";                 
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }        
        $sql = "  SELECT concat(usuario.nome, ' - ', aposta.aposta_id) AS usuario_aposta
                        ,equipe_mandante.sigla as sigla_equipe_mandante
                        ,IF (item_aposta.opcao = 0,'X', '') AS MANDANTE
                        ,IF (item_aposta.opcao = 1,'X', '') AS EMPATE
                        ,IF (item_aposta.opcao = 2,'X', '') AS VISITANTE
                        ,equipe_visitante.sigla as sigla_equipe_visitante
                  FROM aposta
                  INNER JOIN item_aposta ON
                  (aposta.aposta_id = item_aposta.aposta_id)
                  INNER JOIN confronto ON
                  (confronto.confronto_id = item_aposta.confronto_id)
                  INNER JOIN equipe equipe_mandante ON
                  (equipe_mandante.equipe_id = confronto.equipe_mandante)
                  INNER JOIN equipe equipe_visitante ON
                  (equipe_visitante.equipe_id = confronto.equipe_visitante)
                  INNER JOIN usuario ON
                  (usuario.usuario_id = aposta.usuario_id)
                  WHERE aposta.valida = 1
                    and confronto.rodada_id = (select rodada_id from rodada where campeonato_id = 1 and ativa > 0)
                  ORDER BY usuario.nome, aposta.aposta_id, item_aposta.item_aposta_id";
                 
        $query = $this->db->query($sql);            
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }    
        return null;
    }
}