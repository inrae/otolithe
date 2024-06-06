<?php

/**
 * ORM de la table naturetraitement
 *
 * @author quinton
 *
 */
class Naturetraitement extends ObjetBdd
{
  function __construct($bdd, $param = array())
  {
    $this->param = $param;
    $this->table = "naturetraitement";
    $this->id_auto = 1;
    $this->colonnes = array(
      "naturetraitement_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1
      ),
      "naturetraitement_libelle" => array(
        "longueur" => 255,
        "requis" => 1
      )
    );
    $param["fullDescription"] = 1;
    parent::__construct($bdd, $param);
  }
}
