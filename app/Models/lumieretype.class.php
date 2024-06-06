<?php
/**
 * Table de reference des types de lumiere
 *
 * @author quinton
 *
 */
class LumiereType extends ObjetBDD
{

    public function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "lumieretype";
        $this->id_auto = "0";
        $this->colonnes = array(
            "lumieretype_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0,
            ),
            "lumieretype_libelle" => array(
                "type" => 0,
                "requis" => 1,
                "longueur" => 255,
            ),
        );
        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }
}
