<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table sexe
 *
 * @author quinton
 *
 */
class Sexe extends PpciModel
{

    function __construct()
    {
        $this->table = "sexe";
        $this->fields = array(
            "sexe_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "sexe_libelle" => array(
                "type" => 0,
                "requis" => 1
            ),
            "sexe_libellecourt" => array(
                "type" => 0,
                "requis" => 1
            )
        );
        parent::__construct();
    }
}
