<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendencia_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id_rodada = null) {
        if (!is_null($id_rodada)) {
            $sql = "select aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                          ,count(aposta.aposta_id) as apostas
                    from aposta
                    inner join usuario on
                         (usuario.usuario_id = aposta.usuario_id)
                    where aposta.valida = 0
                      and aposta.rodada_id = ?
                    group by aposta.usuario_id
                          ,aposta.rodada_id
                          ,usuario.nome
                    order by usuario.nome";
            
            $query = $this->db->query($sql, array($id_rodada)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        return null;
    }
}