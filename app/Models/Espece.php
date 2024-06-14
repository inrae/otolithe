<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table espece
 *
 * @author quinton
 *
 */
class Espece extends PpciModel
{

    public function __construct()
    {
        $this->table = "espece";
        $this->fields = array(
            "espece_id" => array(
                "type" => 1,
                "requis" => 1,
                "key" => 1,
                "defaultValue" => 0
            ),
            "nom_id" => array(
                "type" => 0,
                "requis" => 1
            ),
            "nom_fr" => array(
                "type" => 0
            )
        );
        parent::__construct();
    }

    /**
     * recherche une espece par rapport a son nom latin ou vernaculaire
     * Retourne le resultat au format JSON, pour utilisation en ajax
     *
     * @param string $nom
     * @return array
     */
    function getEspeceJSON($nom)
    {
        if (strlen($nom) > 2) {
            $sql = "select espece_id as id, nom_id ||' - ' || nom_fr as val
				from espece
				where upper(nom_id) like upper(:nom:)
						or upper(nom_fr) like upper (:nomfr:)
				order by nom_id";
            return $this->getListeParam($sql, ["nom"=>"%$nom%", "nomfr"=>"%$nom%"]);
        }
    }
}
