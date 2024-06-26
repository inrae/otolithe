<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table individu_experimentation
 *
 * @author quinton
 *
 */
class Individu_experimentation extends PpciModel
{

    function __construct()
    {
        $this->table = "individu_experimentation";
        $this->useAutoIncrement = false;
        $this->fields = array(
            "individu_id" => array(
                "type" => 1,
                "requis" => 1,
                "parentAttrib" => 1
            ),
            "exp_id" => array(
                "type" => 1,
                "requis" => 1,
            )
        );
        parent::__construct();
    }

    /**
     * Retourne la liste des experimentations rattachees a un individu
     *
     * @param int $individu_id
     * @return array
     */
    function getListeFromIndividu(int $individu_id)
    {
        if ($individu_id > 0) {
            $sql = "select * from individu_experimentation
                join experimentation using (exp_id)
                where individu_id = :id:";
            return $this->getListeParam($sql, ["id" => $individu_id]);
        } else {
            return [];
        }
    }
}
