<?php

/**
 * ORM de gestion de la table traitement
 *
 * @author quinton
 *
 */
class Traitementpiece extends ObjetBdd
{
  function __construct($bdd, $param = array())
  {
    $this->param = $param;
    $this->table = "traitementpiece";
    $this->id_auto = "1";
    $this->colonnes = array(
      "traitementpiece_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1,
        "defaultValue" => 0
      ),
      "traitementpiece_libelle" => array(
        "longueur" => 255
      )
    );
    $this->id_auto = "1";
    $this->colonnes = array(
      "traitement_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1,
        "defaultValue" => 0
      ),
      "traitement_libelle" => array(
        "longueur" => 255
      )
    );
    $param["fullDescription"] = 1;
    parent::__construct($bdd, $param);
  }
}
