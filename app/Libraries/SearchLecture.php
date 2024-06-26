<?php

namespace App\Libraries;

/**
 * Classe de recherche des lectures de pieces
 * @author quinton
 *
 */
class SearchLecture extends SearchParam
{
    function __construct()
    {
        $this->param = array("codeindividu" => "", "exp_id" => "", "site" => "", "zonesite" => "", "lecteur_id" => 0, "consensual" => 0, "espece_id" => 0);
        parent::__construct();
    }
}
