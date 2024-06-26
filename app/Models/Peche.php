<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table peche
 * @author quinton
 *
 */
class Peche extends PpciModel
{
    public function __construct()
    {
        $this->table = "peche";
        $this->fields = array(
            "peche_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
            ),
            "site" => array(
                "type" => 0,
            ),
            "zonesite" => array(
                "type" => 0,
            ),
            "peche_date" => array(
                "type" => 2,
            ),
            "campagne" => array(
                "type" => 0,
            ),
            "peche_engin" => array(
                "type" => 0,
            ),
            "personne" => array(
                "type" => 0,
            ),
            "operateur" => array(
                "type" => 0,
            ),
        );
        parent::__construct();
    }
    /**
     * Retourne la liste des sites peches
     *
     * @return array
     */
    public function getListeSite()
    {
        $sql = "select distinct site from peche
                order by site
                ";
        return $this->getListParam($sql);
    }
    /**
     * Retourne la liste des zones de peche
     *
     * @return array
     */
    public function getListeZone()
    {
        $sql = "select distinct zonesite from peche
                order by zonesite
                ";
        return $this->getListParam($sql);
    }
}
