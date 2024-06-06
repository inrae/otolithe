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
    function __construct()
    {
        $this->table = "naturetraitement";
        $this->fields = array(
            "naturetraitement_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1
            ),
            "naturetraitement_libelle" => array(
                "type" => 0,
                "requis" => 1
            )
        );
        parent::__construct();
    }
}
