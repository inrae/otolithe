<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table traitement
 *
 * @author quinton
 *
 */
class Traitementpiece extends PpciModel
{
    function __construct()
    {
        $this->table = "traitementpiece";
        $this->fields = array(
            "traitementpiece_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "traitementpiece_libelle" => array(
                "type" => 0
            )
        );
        $this->fields = array(
            "traitement_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "traitement_libelle" => array(
                "type" => 0
            )
        );
        parent::__construct();
    }
}
