<?php
/**
 * ORM de gestion de la table individu_experimentation
 *
 * @author quinton
 *
 */
class Individu_experimentation extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "individu_experimentation";
        $this->id_auto = "0";
        $this->colonnes = array(
            "individu_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "parentAttrib" => 1
            ),
            "exp_id" => array(
                "type" => 1,
                "requis" => 1,
                "key" => 1
            )
        );
        $param["fullDescription"] = 1;
        $param["id_auto"] = 0;
        parent::__construct($bdd, $param);
    }

    /**
     * Retourne la liste des experimentations rattachees a un individu
     *
     * @param int $individu_id
     * @return array
     */
    function getListeFromIndividu($individu_id)
    {
        if ($individu_id > 0) {
            $sql = "select * from " . $this->table . "
				inner join experimentation using (exp_id)
				where individu_id = " . $individu_id;
            return $this->getListeParam($sql);
        } else {
            return null;
        }
    }
}
