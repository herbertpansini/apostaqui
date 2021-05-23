<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendente_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($is_valid = null) {
        if (!is_null($is_valid)) {
            $sql = "select aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                          ,count(aposta.aposta_id) as apostas
                    from aposta
                    inner join usuario on
                         (usuario.usuario_id = aposta.usuario_id)
                    where aposta.valida = ?
                      and aposta.rodada_id = (select rodada.rodada_id from rodada where rodada.campeonato_id = 1 and rodada.ativa > 0)
                    group by aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                    order by usuario.nome";
            
            $query = $this->db->query($sql, array($is_valid)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        $sql = "select aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                          ,count(aposta.aposta_id) as apostas
                    from aposta
                    inner join usuario on
                         (usuario.usuario_id = aposta.usuario_id)
                    where aposta.valida = 0
                      and aposta.rodada_id = (select rodada.rodada_id from rodada where rodada.campeonato_id = 1 and rodada.ativa > 0)
                    group by aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                    order by usuario.nome";
            
            $query = $this->db->query($sql);
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
    }
}