<?php
/**
 * ORM de gestion de la table espece
 *
 * @author quinton
 *
 */
class Espece extends ObjetBDD
{

    public function __construct($p_connection, $param = array())
    {
        $this->table = "espece";
        $this->id_auto = 1;
        $this->colonnes = array(
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
        $param["fullDescription"] = 1;
        parent::__construct($p_connection, $param);
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
            $nom = $this->encodeData($nom);
            $sql = "select espece_id as id, nom_id ||' - ' || nom_fr as val
				from " . $this->table . "
				where upper(nom_id) like upper('%" . $nom . "%')
						or upper(nom_fr) like upper ('%" . $nom . "%')
				order by nom_id";
            return $this->getListeParam($sql);
        }
    }
}
