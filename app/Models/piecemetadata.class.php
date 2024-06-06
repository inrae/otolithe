<?php

/**
 * Classe ORM de la table Piecemetadata
 */
class Piecemetadata extends ObjetBDD
{
    /**
     * Constructeur
     *
     * @param pdo $bdd
     * @param array $param
     */
    public function __construct($bdd, $param = array())
    {
        $this->table = "piecemetadata";
        $this->colonnes = array(
            "piecemetadata_id" => array("type" => 1, "key" => 1, "requis" => 1, "defaultValue" => 0),
            "piece_id" => array("type" => 1, "parentAttrib" => 1, "requis" => 1),
            "metadatatype_id" => array("type" => 1, "requis" => 1),
            "metadata" => array("type" => 0),
            "piecemetadata_date" => array("type" => 2),
            "piecemetadata_comment" => array("type" => 0)
        );
        parent::__construct($bdd, $param);
    }
    /**
     * Retourne la liste des métadonnées attachées à une pièce
     *
     * @param int $id
     * @return array
     */
    function getListFromPiece($id)
    {
        $sql = "select piecemetadata_id, piece_id, metadatatype_id, piecemetadata_date, piecemetadata_comment,
        metadatatype_name
        from piecemetadata
        join metadatatype using (metadatatype_id)
        where piece_id = :piece_id
        ";
        return $this->getListeParamAsPrepared($sql, array("piece_id" => $id));
    }
}