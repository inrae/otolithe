<?php

namespace App\Models;

use Ppci\Libraries\PpciException;
use Ppci\Models\PpciModel;

/**
 * ORM de gestion de la table experimentation
 *
 * @author quinton
 *
 */
class Experimentation extends PpciModel
{

    function initialize()
    {
        $this->table = "experimentation";
        $this->fields = array(
            "exp_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "exp_nom" => array(
                "type" => 0
            ),
            "exp_description" => array(
                "type" => 0
            ),
            "exp_debut" => array(
                "type" => 2,
                "defaultValue" => "getDebutAnnee"
            ),
            "exp_fin" => array(
                "type" => 2,
                "defaultValue" => "getFinAnnee"
            )
        );

        parent::initialize();
    }

    /**
     * Ajout de la mise a jour de la liste des lecteurs
     *
     * {@inheritdoc}
     * @see ObjetBDD::ecrire()
     */
    function write($data): int
    {
        $id = parent::write($data);
        if ($id > 0) {
            $this->ecrireTableNN("lecteur_experimentation", "exp_id", "lecteur_id", $id, $data["lecteur_id"]);
        }
        return $id;
    }
    /**
     * Add the deletion of readers when delete an experimentation
     *
     * @param [type] $id
     * @param boolean $purge
     * @return void
     */
    function delete($id = null, bool $purge = false)
    {
        /**
         * Verify if the deletion is available
         */
        $sql = "select count(*) as nb from individu_experimentation where exp_id = :id:";
        $param = ["id" => $id];
        $res = $this->executeSQL($sql, $param);
        if ($res[0]["nb"] > 0) {
            throw new PpciException(sprintf(_("%s individus sont rattachés à l'expérimentation, elle ne peut pas être supprimée"), $res[0]["nb"]));
        }
        $sql = "delete from lecteur_experimentation where exp_id = :id:";
        $this->executeSQL($sql, $param, true);
        parent::delete($id);
    }

    /**
     * Fonction permettant de calculer la date de debut d'annee
     *
     * @return string
     */
    function getDebutAnnee()
    {
        $data = date("Y") . "-01-01";
        return $this->formatDateDBversLocal($data);
    }

    /**
     * Fonction permettant de calculer la date de fin d'annee
     *
     * @return string
     */
    function getFinAnnee()
    {
        $data = date("Y") . "-12-31";
        return $this->formatDateDBversLocal($data);
    }

    /**
     * Retourne la liste de toutes les experimentations, avec le lecteur associe
     * (saisie des experimentations autorisees)
     *
     * @param int $lecteur_id
     * @return array
     */
    function getAllListFromLecteur($lecteur_id)
    {
        if ($lecteur_id >= 0) {
            $sql = "select e.exp_id, exp_nom, lecteur_id
					from experimentation e
					left outer join lecteur_experimentation l
					on (e.exp_id = l.exp_id and l.lecteur_id = :id:)
					order by exp_nom";
            return $this->getListeParam($sql, ["id" => $lecteur_id]);
        } else {
            return [];
        }
    }

    /**
     * Retourne la liste de toutes les experimentations, pour saisie par individu
     *
     * @param int $individu_id
     * @return array
     */
    function getAllListFromIndividu($individu_id)
    {
        if ($individu_id > 0) {
            $sql = "select e.exp_id, exp_nom, individu_id
					from experimentation e
					left outer join individu_experimentation ie
					on (e.exp_id = ie.exp_id and ie.individu_id = :individu_id:)
                    order by exp_nom";
            $data = $this->getListeParamAsPrepared(
                $sql,
                array("individu_id" => $individu_id)
            );
        } else {
            $sql = "select e.exp_id, exp_nom
            from experimentation e
            order by exp_nom";
            $data = $this->getListeParam($sql);
        }
        return $data;
    }

    /**
     * Retourne les lecteurs associes a une experimentation
     *
     * @param int $exp_id
     * @return array
     */
    function getReaders($exp_id)
    {
        $sql = "select l.lecteur_id, login, lecteur_nom, lecteur_prenom,
                case when exp_id is not null then 1 else 0 end as is_reader
                from lecteur l
                left outer join lecteur_experimentation le on (l.lecteur_id = le.lecteur_id and exp_id = :exp_id:)
               order by lecteur_nom, lecteur_prenom
	           ";
        return $this->getListeParamAsPrepared($sql, array(
            "exp_id" => $exp_id
        ));
    }

    /**
     * Retourne la liste des experimentations autorisees pour un lecteur
     *
     * @param int $lecteur_id
     * @return array
     */
    function getExpAutorisees($lecteur_id)
    {
        if ($lecteur_id >= 0) {
            $sql = "select e.exp_id, e.exp_nom
					from experimentation e
					join lecteur_experimentation using (exp_id)
					where lecteur_id = :id:
					order by e.exp_nom";
            return $this->getListeParam($sql, ["id" => $lecteur_id]);
        } else {
            return [];
        }
    }
}
