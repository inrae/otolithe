<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table piecetype
 *
 * @author quinton
 *
 */
class Piecetype extends PpciModel
{
    function __construct()
    {
        $this->table = "piecetype";
        $this->fields = array(
            "piecetype_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "piecetype_libelle" => array(
                "type" => 0
            )
        );
        parent::__construct();
    }
}
