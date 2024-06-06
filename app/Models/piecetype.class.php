<?php

/**
 * ORM de gestion de la table piecetype
 *
 * @author quinton
 *
 */
class Piecetype extends ObjetBdd
{
  function __construct($bdd, $param = array())
  {
    $this->param = $param;
    $this->table = "piecetype";
    $this->id_auto = "1";
    $this->colonnes = array(
      "piecetype_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1,
        "defaultValue" => 0
      ),
      "piecetype_libelle" => array(
        "longueur" => 255
      )
    );
    $param["fullDescription"] = 1;
    parent::__construct($bdd, $param);
  }
}
