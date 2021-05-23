<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classificacao_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id_usuario = null) {
        if (!is_null($id_usuario)) {
            $sql = "SELECT tmp.usuario_id, tmp.aposta_id, tmp.rodada_id, tmp.pontos, tmp.valida
                    FROM (
                        select a.usuario_id
                        ,a.aposta_id
                        ,a.rodada_id
                        ,a.valida
                        ,sum( IF (c.confronto_id IN (181, 186, 232, 236, 240), 1, CASE WHEN (case when (c.placar_equipe_mandante > c.placar_equipe_visitante) THEN 0 
                            		             when (c.placar_equipe_mandante = c.placar_equipe_visitante) THEN 1 
                                    		     when (c.placar_equipe_mandante < c.placar_equipe_visitante) THEN 2 END = ia.opcao) THEN 1 
                             ELSE 0 END )) as pontos
                        from confronto c 
                        inner join item_aposta ia on 
                        (ia.confronto_id = c.confronto_id) 
                        inner join aposta a on 
                        (a.aposta_id = ia.aposta_id)
                        where c.rodada_id >= (select rodada_id from rodada where campeonato_id = 1 and ativa > 0)
                        group by a.usuario_id, a.aposta_id
                    ) as tmp
                    inner join usuario on
                    (tmp.usuario_id = usuario.usuario_id)
                    WHERE tmp.usuario_id = ?
                    ORDER BY tmp.pontos desc";
            
            $query = $this->db->query($sql, array($id_usuario)); // set parameter
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        
        
        $sql = "select tmp.rodada_id, tmp.usuario_id, usuario.nome, count(tmp.usuario_id) as apostas, max(tmp.pontos) as pontos, tmp.valida from 
                (
                 select a.usuario_id
                       ,a.rodada_id
                       ,a.aposta_id
                       ,a.valida
                       ,sum( IF (c.confronto_id IN (181, 186, 232, 236, 240), 1, CASE WHEN (case when (c.placar_equipe_mandante > c.placar_equipe_visitante) THEN 0 
                            		             when (c.placar_equipe_mandante = c.placar_equipe_visitante) THEN 1 
                                    		     when (c.placar_equipe_mandante < c.placar_equipe_visitante) THEN 2 END = ia.opcao) THEN 1 
                             ELSE 0 END )) as pontos
                 from confronto c 
                 inner join item_aposta ia on 
                 (ia.confronto_id = c.confronto_id) 
                 inner join aposta a on 
                 (a.aposta_id = ia.aposta_id)
                 where c.rodada_id = (select rodada_id from rodada where campeonato_id = 1 and ativa > 0)
                   and a.valida = 1
                 group by a.usuario_id, a.aposta_id
                 ) as tmp
                 inner join usuario on
                 (tmp.usuario_id = usuario.usuario_id)
                 group by tmp.usuario_id, usuario.nome
                 ORDER BY max(tmp.pontos) desc";
                 
        $query = $this->db->query($sql); // set parameter
            
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }    
        return null;
    }
}