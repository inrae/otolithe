<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table des lecteurs
 *
 * @author quinton
 *
 */
class Lecteur extends PpciModel
{

    public function __construct()
    {
        $this->table = "lecteur";
        $this->fields = array(
            "lecteur_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0,
            ),
            "login" => array(
                "type" => 0,
                "requis" => 1,
            ),
            "lecteur_nom" => array(
                "type" => 0,
            ),
            "lecteur_prenom" => array(
                "type" => 0,
            ),
        );
        parent::__construct();
    }

    /**
     * Retourne l'identifiant du lecteur
     *
     * @param int $login
     * @return number
     */
    public function getIdFromLogin($login)
    {
        if (strlen($login) > 0) {
            $sql = "select lecteur_id from lecteur where login = :login:";
            $res = $this->lireParam($sql, ["login" => $login]);
            if ($res["lecteur_id"] > 0) {
                return $res["lecteur_id"];
            } else {
                return -1;
            }
        } else {
            return null;
        }
    }

    /**
     * Retourne la liste des lecteurs rattaches a une experimentation
     *
     * @param [int] $exp_id
     * @return array
     */
    public function getListFromExp($exp_id)
    {
        $sql = "select l.*
                from lecteur l
                join lecteur_experimentation using (lecteur_id)
                where exp_id = :exp_id:
                order by lecteur_nom, lecteur_prenom
        ";
        return $this->getListeParamAsPrepared($sql, array("exp_id" => $exp_id));
    }

    /**
     * Surcharge de la fonction ecrire pour enregistrer les experimentations autorisees
     * (non-PHPdoc)
     *
     * @see ObjetBDD::write()
     */
    public function write($data): int
    {
        $id = parent::write($data);

        if ($id > 0) {
            $this->ecrireTableNN("lecteur_experimentation", "lecteur_id", "exp_id", $id, $data["exp_id"]);
        }
        return $id;
    }
}
