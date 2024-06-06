<?php
class Individu extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "individu";
        $this->id_auto = "1";
        $this->colonnes = array(
            "individu_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "espece_id" => array(
                "type" => 1
            ),
            "peche_id" => array(
                "type" => 1
            ),
            "sexe_id" => array(
                "type" => 1
            ),
            "codeindividu" => array(
                "longueur" => 100,
                "requis" => 1
            ),
            "tag" => array(
                "longueur" => 255
            ),
            "longueur" => array(
                "type" => 1
            ),
            "poids" => array(
                "type" => 1
            ),
            "remarque" => array(
                "type" => 0
            ),
            "parasite" => array(
                "longueur" => 255
            ),
            "age" => array(
                "type" => 1
            ),
            "uuid" => array("type" => 0, "defaultValue" => "getUUID"),
            "wgs84_x" => array("type" => 1),
            "wgs84_y" => array("type" => 1)
        );

        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }

    /**
     * Recherche les animaux selon les criteres de selection fournis
     *
     * @param array $data
     * @return array
     */
    function getListSearch($data)
    {
        $data = $this->encodeData($data);
        $sql = "select i.individu_id, i.codeindividu, i.tag, e.nom_id, count (pc.piece_id) as nbrepiece,
                s.sexe_libellecourt, p.peche_date, p.site, p.zonesite, ex.exp_nom, i.age, i.uuid
                ,wgs84_x, wgs84_y
				from individu i
					left outer join espece e on (e.espece_id = i.espece_id)
					left outer join piece pc on (pc.individu_id = i.individu_id)
					left outer join individu_experimentation ie on (ie.individu_id = i.individu_id)
					left outer join experimentation ex on (ex.exp_id = ie.exp_id)
					left outer join peche p on (p.peche_id = i.peche_id)
					left outer join sexe s on (s.sexe_id = i.sexe_id)
						";
        /*
         * Preparation de la clause where
         */
        $where = "";
        $and = " and ";
        if (strlen($data["exp_id"]) == 0) {
            $data["exp_id"] = 0;
        }
        $where = " where ie.exp_id = " . $data["exp_id"];

        if (strlen($data["codeindividu"]) > 0) {
            $where .= $and . "(upper(i.codeindividu) like upper('%" . $data["codeindividu"] . "%')
					or upper(i.tag) like upper('%" . $data["codeindividu"] . "%')
							)";
        }
        if ($data["sexe"] > 0) {
            $where .= $and . "i.sexe_id = " . $data["sexe"];
        }
        if (strlen($data["site"]) > 0) {
            $where .= $and . "p.site = '" . $data["site"] . "'";
        }
        if (strlen($data["zone"]) > 0) {
            $where .= $and . "p.zonesite = '" . $data["zone"] . "'";
        }
        if ($data["espece_id"] > 0) {
            $where .= $and . "e.espece_id = " . $data["espece_id"];
        }
        /**
         * Recherche des lectures non réalisées
         */
        if ($data["isNotRead"] == 1 && $data["lecteur_id"] > 0) {
            $where .= $and . " i.individu_id not in (
                select i2.individu_id
                from individu  i2
                join individu_experimentation ie2 on (i2.individu_id = ie2.individu_id)
                join piece pc2 on (i2.individu_id = pc2.individu_id)
                join photo ph on (ph.piece_id = pc2.piece_id)
                join photolecture phl on (phl.photo_id = ph.photo_id)
                where ie2.exp_id = " . $data["exp_id"] . "
                    and phl.lecteur_id = " . $data["lecteur_id"] . "
                )
            ";
        }
        /*
         * Preparation du group by
         */
        $group = " group by i.individu_id, i.codeindividu, e.nom_id, s.sexe_libellecourt, p.peche_date, p.site, p.zonesite, ex.exp_nom, i.tag, i.uuid, wgs84_x, wgs84_y";
        /*
         * Preparation de la clause de tri
         */
        $tri = " order by codeindividu";
        $listData = $this->getListeParam($sql . $where . $group . $tri);
        /*
         * Mise en forme des dates
         */
        foreach ($listData as $key => $value) {
            $listData[$key]["peche_date"] = $this->formatDateDBversLocal($value["peche_date"]);
        }
        return $listData;
    }

    /**
     * Retourne la liste des espèces utilisées pour une expérimentation
     *
     * @param [int] $exp_id
     * @return array
     */
    function getListEspeceFromExp($exp_id)
    {
        $sql = "select distinct espece_id, nom_id
                from individu
                join espece using (espece_id)
                join individu_experimentation using (individu_id)
                where exp_id = :exp_id
        ";
        return $this->getListeParamAsPrepared($sql, array("exp_id" => $exp_id));
    }

    /**
     * Retourne le detail d'un poisson
     *
     * @param int $id
     * @return array
     */
    function getDetail($id)
    {
        if ($id > 0 && is_numeric($id)) {
            $sql = "select individu_id, nom_id, peche_id, codeindividu, tag, longueur, poids,
                    remarque, parasite, age, sexe_libelle, peche_date, uuid
                    ,wgs84_x, wgs84_y
				from " . $this->table . "
						left outer join sexe using (sexe_id)
						left outer join espece using (espece_id)
						left outer join peche using (peche_id)
						where individu_id = " . $id;
            $data = $this->lireParam($sql);
            /*
             * Mise en forme de la date de peche
             */

            if (strlen($data["peche_date"]) > 0) {
                $data["peche_date"] = $this->formatDateDBversLocal($data["peche_date"]);
            }
            return $data;
        }
    }

    /**
     * Reecriture de la fonction lire pour integrer l'espece
     * (non-PHPdoc)
     *
     * @see ObjetBDD::lire()
     */
    function lire($id)
    {
        if ($id > 0) {
            $sql = "select individu_id, nom_id,
                    peche_id, espece_id, codeindividu, tag, longueur, poids,
                    remarque, parasite, age, sexe_id, uuid
                    ,wgs84_x, wgs84_y
				from " . $this->table . "
						left outer join espece using (espece_id)
						where individu_id = :id";
            return $this->lireParamAsPrepared($sql, array("id" => $id));
        } else {
            return $this->getDefaultValue();
        }
    }

    /**
     * Surcharge de la fonction ecrire pour enregistrer les experimentations
     * (non-PHPdoc)
     *
     * @see ObjetBDD::write()
     */
    function ecrire($data)
    {
        $id = parent::ecrire($data);
        if ($id > 0 && is_array($data["exp_id"])) {
            /*
             * Ecriture des experimentations
             */
            $this->ecrireTableNN("individu_experimentation", "individu_id", "exp_id", $id, $data["exp_id"]);
        }
        return $id;
    }

    function supprimer($id)
    {
        if ($id > 0 && is_numeric($id)) {
            /*
             * Recherche s'il existe des photos rattachees. Si oui, suppression refusee
             */
            $sql = "select count(*) as nb from individu
                    join piece using (individu_id)
                    join photo using (piece_id)
                    where individu_id = :individu_id
                    ";
            $aid = array(
                "individu_id" => $id
            );
            $res = $this->lireParamAsPrepared($sql, $aid);
            if ($res["nb"] > 0) {
                $this->addMessage(_("Des photos sont rattachées au poisson, sa suppression est impossible"));
                throw new ObjetBDDException(_("Des photos sont rattachées au poisson, sa suppression est impossible"));
            }
        }
        /*
         * Suppression des pieces rattachees
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($this->connection, $this->paramori);
        $piece->supprimerFromIndividu($id);
        /*
         * Suppression dans la table des experimentations
         */
        $sql = "delete from individu_experimentation where individu_id = :individu_id";
        $this->executeAsPrepared($sql, $aid, true);
        return parent::supprimer($id);
    }
}
