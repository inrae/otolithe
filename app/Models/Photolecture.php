<?php

namespace App\Models;

use Ppci\Models\PpciModel;

/***
 * ORM de gestion de la table photolecture
 *
 * @author quinton
 *
 */
class Photolecture extends PpciModel
{

    public function __construct()
    {
        $this->table = "photolecture";
        $this->fields = array(
            "photolecture_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0,
            ),
            "photo_id" => array(
                "type" => 1,
                "requis" => 1,
                "parentAttrib" => 1,
            ),
            "lecteur_id" => array(
                "type" => 1,
                "requis" => 1,
            ),
            "centre" => array(
                "type" => 0,
            ),
            "bordure" => array(
                "type" => 0,
            ),
            "points" => array(
                "type" => 4,
            ),
            "photolecture_date" => array(
                "type" => 3,
                "defaultValue" => "getDateHeure",
            ),
            "points_ref_lecture" => array(
                "type" => 4,
            ),
            "long_ref_mesuree" => array(
                "type" => 1,
            ),
            "photolecture_width" => array(
                "type" => 1,
            ),
            "photolecture_height" => array(
                "type" => 1,
            ),
            "long_totale_lue" => array(
                "type" => 1,
            ),
            "long_totale_reel" => array(
                "type" => 1,
            ),
            "rayon_point_initial" => array(
                "type" => 1,
                "defaultValue" => 7,
            ),
            "final_stripe_id" => array(
                "type" => 1,
            ),
            "read_fiability" => array(
                "type" => 1,
            ),
            "consensual_reading" => array(
                "type" => 1,
            ),
            "annee_naissance" => array(
                "type" => 1,
            ),
            "commentaire" => array(
                "type" => 0,
            ),
            "remarkable_points" => array(
                "type" => 0,
            ),
        );
        $param["srid"] = -1;
        parent::__construct();
    }

    /***
     * Reecriture de la fonction ecrire, pour preparer les points et realiser les calculs
     * (non-PHPdoc)
     *
     * @see ObjetBDD::ecrire()
     */
    public function write($data): int
    {
        /**
         * Mise a jour de l'heure
         */
        $data["photolecture_date"] = $this->getDateHeure();
        /**
         * Traitement des points
         */
        $points = array();
        $pointsMesure = array();
        $coef = $data["coef_correcteur"];
        /**
         * Calcul du rayon du cercle initial
         */
        $data["rayon_point_initial"] = $data["rayon_point_initial"] * $coef;
        /**
         * Gestion des points
         */
        foreach ($data as $key => $value) {
            $nomChamp = preg_replace('#[^a-zA-Z]+#', "", $key);
            if ($nomChamp == "rang") {
                /**
                 * Recuperation du numero de ligne
                 */
                $num = preg_replace('#[^0-9]#', "", $key);
                /**
                 * Mise en tableau
                 */
                if ($data["pointRef" . $num] == 1) {
                    $pointsMesure[$data["rang" . $num]]["x"] = $data["pointx" . $num];
                    $pointsMesure[$data["rang" . $num]]["y"] = $data["pointy" . $num];
                } else {
                    $points[$data["rang" . $num]]["x"] = $data["pointx" . $num];
                    $points[$data["rang" . $num]]["y"] = $data["pointy" . $num];
                    $points[$data["rang" . $num]]["remarkablePoint"] = $data["remarkablePoint" . $num];
                }
            }
        }
        /**
         * Tri des tableaux
         */
        ksort($points, SORT_NUMERIC);
        ksort($pointsMesure, SORT_NUMERIC);
        if ($data["calculAuto"] == 1) {
            /**
             * Recalcul automatique de l'ordonnancement des points
             */
            $pointTemp = $points;
            $points = array();
            /**
             * Recuperation de la premiere position
             */
            foreach ($pointTemp as $key => $value) {
                $points[0]["x"] = $value["x"];
                $points[0]["y"] = $value["y"];
                /**
                 * Suppression du premier point dans $pointTemp
                 */
                unset($pointTemp[$key]);
                break;
            }
            /**
             * Traitement de chaque point successivement
             */
            $nbPoint = count($pointTemp);
            $i = 1;
            for ($i = 1; $i <= $nbPoint; $i++) {
                $x = $points[$i - 1]["x"];
                $y = $points[$i - 1]["y"];
                $min = 999999;
                $ref = "";
                /**
                 * Calcul de la distance de chaque point par rapport au point precedent
                 */
                foreach ($pointTemp as $key => $value) {
                    $dist = $this->calculDistance($x, $y, $value["x"], $value["y"]);
                    if ($dist < $min) {
                        $min = $dist;
                        $ref = $key;
                    }
                }
                /**
                 * Ecriture du point le plus pres
                 */
                $points[$i] = $pointTemp[$ref];
                /**
                 * Suppression du point traite
                 */
                unset($pointTemp[$ref]);
            }
        }
        /**
         * Initialisation des points remarquables
         */
        $rp = array();
        $pointNumber = 0;
        /**
         * Mise en forme des coordonnees
         */
        if (!empty($points)) {
            $data["points"] = "MULTIPOINT(";
            $virgule = "";
            $x0 = 0;
            $y0 = 0;
            $i = 0;
            $longueur_totale = 0;
            foreach ($points as $key => $value) {
                $data["points"] .= $virgule . floor($value["x"] * $coef) . " " . floor($value["y"] * $coef);
                /**
                 * Calcul de la longueur par rapport au point precedent
                 */
                if ($i > 0) {
                    $long = $this->calculDistance($x0, $y0, $value["x"], $value["y"]);
                    $longueur_totale = $longueur_totale + $long;
                }
                $x0 = $value["x"];
                $y0 = $value["y"];
                $i++;
                $virgule = ",";
                /**
                 * Traitement des points remarquables
                 */
                if ($value["remarkablePoint"] == 1) {
                    $rp[] = $pointNumber;
                }
                $pointNumber++;
            }
            $data["points"] .= ')';
            $data["long_totale_lue"] = $longueur_totale * $coef;
        }
        /**
         * Encodage de la liste des points remarquables
         */
        !empty($rp) ? $data["remarkable_points"] = json_encode($rp) : $data["remarkable_points"] = "";

        /**
         * Gestion de la longueur de reference
         */
        if (!empty($pointsMesure)) {
            $data["points_ref_lecture"] = "MULTIPOINT(";
            $virgule = "";
            $i = 0;
            $mesure = array();
            foreach ($pointsMesure as $key => $value) {
                $i++;
                $data["points_ref_lecture"] .= $virgule . floor($value["x"] * $coef) . " " . floor($value["y"] * $coef);
                $mesure[$i]["x"] = $value["x"];
                $mesure[$i]["y"] = $value["y"];
                $virgule = ",";
            }
            $data["points_ref_lecture"] .= ')';
            /**
             * Calcul de la distance de la lecture de reference
             */
            if ($i >= 2) {
                $data["long_ref_mesuree"] = $this->calculDistance($mesure[1]["x"], $mesure[1]["y"], $mesure[2]["x"], $mesure[2]["y"]) * $coef;
            }
        }
        /**
         * Recuperation de la valeur de la longueur de reference dans la photo et de la longueur en pixels
         */
        $photo = new Photo();
        $dataPhoto = $photo->getDetail($data["photo_id"]);
        /**
         * On traite le cas ou la longueur de reference n'a pas ete mesuree. La valeur est recuperee depuis les donnees de la photo
         */
        if (($data["long_ref_mesuree"] == 0 || is_null($data["long_ref_mesuree"])) && $dataPhoto["long_ref_pixel"] > 0) {
            $data["long_ref_mesuree"] = $dataPhoto["long_ref_pixel"];
        }

        /**
         * Calcul de la distance reelle
         */
        if ($data["long_ref_mesuree"] > 0 && $data["long_totale_lue"] > 0 && $dataPhoto["long_reference"] > 0) {
            $data["long_totale_reel"] = $data["long_totale_lue"] / $data["long_ref_mesuree"] * $dataPhoto["long_reference"];
        }
        return parent::write($data);
    }

    /***
     * Calcul de la distance geometrique entre deux points
     *
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @return float
     */
    public function calculDistance($x1, $y1, $x2, $y2)
    {
        return sqrt(pow(abs($x2 - $x1), 2) + (pow(abs($y2 - $y1), 2)));
    }

    /***
     * Retourne la liste des lectures realisees sur une photo
     *
     * @param int $photo_id
     * @return array
     */
    public function getListeFromPhoto($photo_id)
    {
        if ($photo_id > 0) {
            $sql = "select photolecture_id, photo_id, lecteur_id, lecteur_nom, lecteur_prenom, photolecture_date,
                            ST_NumGeometries(points) - 1 as age,
                            long_totale_lue,
                            long_totale_reel,
                            long_ref_mesuree,
                            photolecture_width,
                            photolecture_height,
                            read_fiability, consensual_reading, annee_naissance,
                            final_stripe.*,
                            commentaire, remarkable_points
                            from photolecture
                            left outer join lecteur using(lecteur_id)
                            left outer join final_stripe using(final_stripe_id)
                            where photo_id = :photo_id: order by photolecture_date desc";
            return $this->getListeParamAsPrepared($sql, array("photo_id" => $photo_id));
        } else {
            return [];
        }
    }

    /***
     * Retourne la liste des lectures effectuees
     * $id contient soit le numero unique de phototolecture_id, soit un tableau contenant la liste des identifiants a traiter
     *
     * @param <int|array> $id
     * @param float $coef
     * @return array
     */
    public function getDetailLecture($id, $coef, $id_exclu = 0)
    {
        if (is_array($id) || $id > 0) {
            $sql = "select photolecture_id, photo_id, lecteur_id, lecteur_nom, lecteur_prenom, photolecture_date,
                            st_astext(points) as listepoint,
                            long_totale_lue,
                            long_totale_reel,
                            long_ref_mesuree,
                            photolecture_width,
                            photolecture_height,
                            rayon_point_initial,
                            final_stripe_code,
                            final_stripe_id,
                            final_stripe_libelle,
                            read_fiability, consensual_reading, annee_naissance, remarkable_points
                            from photolecture
                            left outer join lecteur using (lecteur_id)
                            left outer join final_stripe using (final_stripe_id)";
            /**
             * Preparation de la clause where
             */
            $param = [];
            $i = 0;
            if (!is_array($id)) {
                $where = " where photolecture_id = :id:";
                $param["id"] = $id;
            } else {
                /**
                 * Les identifiants sont en tableau
                 */
                $where = " where photolecture_id in (";
                $virgule = "";
                foreach ($id as $value) {
                    if ($value != $id_exclu && $value > 0) {
                        $where .= $virgule . ":id" . $i . ':';
                        $param["id" . $i] = $value;
                        $virgule = ",";
                        $i++;
                    }
                }
                $where .= ")";
            }
            $couleur = array(
                "0" => "green",
                "1" => "magenta",
                "2" => "blue",
                "3" => "orange",
                "4" => "darkred",
                "5" => "darkgreen",
                "6" => "darkmagenta",
                "7" => "darkblue",
                "8" => "darkorange",
                "9" => "darkcyan",
                "10" => "darksalmon",
                "11" => "darkseagreen",
            );
            /**
             * Lecture de la liste concernee
             */
            $icolor = 0;
            $data = $this->getListeParam($sql . $where, $param);
            foreach ($data as $key => $value) {
                if (strlen($data[$key]["listepoint"]) > 0) {
                    $data[$key]["points"] = $this->calculPointsAffichage($data[$key]["listepoint"], $coef);
                    /**
                     * Rajout de la couleur
                     */
                    $data[$key]["couleur"] = $couleur[$icolor];
                    $icolor++;
                }
                /**
                 * Recalcul du rayon initial
                 */
                $data[$key]["rayon_point_initial"] = floor($data[$key]["rayon_point_initial"] / $coef);
            }
            return $data;
        }
    }

    /***
     * Retourne le nom du lecteur qui a realise la lecture
     *
     * @param int $id : key of row
     *
     * @return string
     */
    public function getLecteur($id)
    {
        $sql = "select login
                        from photolecture
                        join lecteur using (lecteur_id)
                        where photolecture_id = :photolecture_id:
                        ";
        return $this->lireParamAsPrepared($sql, array("photolecture_id" => $id));
    }

    /***
     * Calcule la position des points en pixels, pour affichage
     * dans la resolution consideree
     *
     * @param string $listepoint        liste des points sous forme st_astext
     * @param float $coef              coefficient de projection
     * @param string $remarkable_points liste des points remarquables 
     *
     * @return array
     */
    public function calculPointsAffichage($listepoint, $coef, $remarkable_points = "")
    {
        /**
         * Nettoyage des donnees
         */
        $lpt = preg_replace('#[^0-9 .,]#', "", $listepoint);
        $alpt = explode(",", $lpt);
        $i = 0;
        $data = array();
        /**
         * Decodage du champ json
         */
        $rp = json_decode($remarkable_points);
        foreach ($alpt as $value1) {
            /**
             * Separation des valeurs x et y
             */
            $xy = explode(" ", $value1);
            /**
             * Calcul de l'emplacement en fonction de la resolution/coef de transformation
             */
            $data[$i]["x"] = floor($xy[0] / $coef);
            $data[$i]["y"] = floor($xy[1] / $coef);
            /**
             * Ajout du point remarquable
             */
            if (!is_null($rp) && in_array($i, $rp)) {
                $data[$i]["remarkablePoint"] = 1;
            }
            $i++;
        }
        return $data;
    }

    /**
     * Retourne les points saisis en format lisible (st_astext)
     *
     * @param integer $id
     *
     * @return array
     */
    public function lirePoints($id)
    {
        $data = array();
        if ($id > 0) {
            $sql = "select photolecture_id,
                            st_astext(points) as points,
                            st_astext(points_ref_lecture) as points_ref_lecture,
                            remarkable_points
                            from photolecture where photolecture_id = :id:";
            $data = $this->lireParamAsPrepared($sql, array("id" => $id));
            /**
             * recuperation des points remarquables
             */
        }
        return $data;
    }

    /**
     * Retourne la liste des lectures effectuees en fonction des criteres de recherche indiques
     *
     * @param array $param
     * @return array
     */
    public function getListSearch($param)
    {
        $sql = "select photolecture_id, photo_id, lecteur_id, piece_id, individu_id,
                        codeindividu, tag,
                        site, zonesite, peche_date, campagne,
                        lecteur_nom, lecteur_prenom,
                        photolecture_date,
                        read_fiability, consensual_reading, annee_naissance,
                        final_stripe_id, final_stripe_code,
                        st_astext(points) as points,
                        st_astext(points_ref_lecture) as points_ref_lecture,
                        ST_NumGeometries(points) - 1 as age,
                        long_ref_mesuree, long_totale_reel,
                        photolecture_width, photolecture_height,
                        photo_nom, photo_date, color, long_reference, photo_height, photo_width,
                        piecetype_libelle, traitementpiece_libelle,
                        rayon_point_initial, commentaire, remarkable_points

                        from photolecture left join lecteur using(lecteur_id)
                        left join photo using (photo_id)
                        left join piece using (piece_id)
                        left join individu using (individu_id)
                        LEFT OUTER JOIN individu_experimentation using (individu_id)
                        left outer join piecetype using (piecetype_id)
                        left outer join traitementpiece using (traitementpiece_id)
                        left outer join peche using (peche_id)
                        left outer join final_stripe using (final_stripe_id)
                        ";
        $where = " where exp_id = :id:";
        $sqlparam["id"] = $param["exp_id"];
        $and = " and ";

        if (strlen($param["codeindividu"]) > 0) {
            $where .= $and . "(upper(codeindividu) like upper(:codeindividu:)
                            or upper(tag) like upper(:tag:))";
            $sqlparam["codeindividu"] = "%" . $param["codeindividu"] . "%";
            $sqlparam["tag"] = $sqlparam["codeindividu"];
        }


        if (strlen($param["site"]) > 0) {
            $where .= $and . " site = :site:";
            $sqlparam["site"] = $param["site"];
        }
        if (strlen($param["zonesite"]) > 0) {
            $where .= $and . "zonesite = :zonesite:";
            $sqlparam["zonesite"] = $param["zonesite"];
        }
        if ($param["lecteur_id"] > 0) {
            $where .= $and . "lecteur_id = :lecteur_id:";
            $sqlparam["lecteur_id"] = $param["lecteur_id"];
        }
        if ($param["espece_id"] > 0) {
            $where .= $and . "espece_id = :espece_id:";
            $sqlparam["espece_id"] = $param["espece_id"];
        }
        if ($param["consensual"] == 1) {
            $where .= $and . "consensual_reading = 1";
        }
        $order = " order by codeindividu, tag, piece_id, photo_id, photolecture_date";
        $this->fields["photo_date"] = ["type" => 2];
        return $this->getListeParam($sql . $where . $order, $sqlparam);
    }
}
