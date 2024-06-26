<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * Classe de description des modèles de métadonnées
 *
 */

class Metadatatype extends PpciModel
{
    public function __construct()
    {
        $this->table = "metadatatype";
        $this->fields = array(
            "metadatatype_id" => array("type" => 1, "key" => 1, "requis" => 1, "defaultValue" => 0),
            "metadatatype_name" => array("requis" => 1),
            "metadatatype_comment" => array('type' => 0),
            "metadatatype_description" => array("type" => 0),
            "is_array" => array("type" => 0),
            "metadatatype_schema" => array("type" => 0)
        );
        parent::__construct();
    }
    /**
     * Retourne la liste des types de metadonnees a partir de la liste fournie
     *
     * @param array $ids
     * @return array
     */
    function getListFromIds(array $ids)
    {
        $comma = "";
        $sql = "select metadatatype_id, metadatatype_name, is_array, metadatatype_schema from metadatatype";
        $where = " where metadatatype_id in (";
        $i = 0;
        $param = [];
        foreach ($ids as $id) {
            $where .= $comma . ":id" . $i.':';
            $param["id" . $i] = $id;
            $comma = ",";
            $i++;
        }
        $where .= ")";
        return $this->getListeParam($sql . $where, $param);
    }
}
