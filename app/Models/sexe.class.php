<?php
/**
 * ORM de gestion de la table sexe
 *
 * @author quinton
 *
 */
class Sexe extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "sexe";
        $this->id_auto = "0";
        $this->colonnes = array(
            "sexe_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "sexe_libelle" => array(
                "longueur" => 255,
                "requis" => 1
            ),
            "sexe_libellecourt" => array(
                "longueur" => 255,
                "requis" => 1
            )
        );
        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }
}
