<?php
namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de la table naturetraitement
 *
 * @author quinton
 *
 */
class Naturetraitement extends PpciModel
{
  function __construct($bdd, $param = array())
  {
        $this->table = "naturetraitement";
        $this->fields = array(
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
        parent::__construct();
  }
}
