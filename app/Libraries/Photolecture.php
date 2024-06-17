<?php

namespace App\Libraries;

use App\Models\Final_stripe;
use App\Models\Individu;
use App\Models\Lecteur;
use App\Models\Peche;
use App\Models\Photo;
use App\Models\Photolecture as ModelsPhotolecture;
use App\Models\Piece;
use Ppci\Libraries\PpciLibrary;

class Photolecture extends PpciLibrary
{
    protected $ids = [];
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsPhotolecture();
        if (is_array($_REQUEST["photolecture_id"])) {
            foreach ($_REQUEST["photolecture_id"] as $value) {
                $this->ids[] = $_SESSION["it_photolecture"]->getValue($value);
            }
        } else {
            $this->id = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id"]);
        }
    }

    function display()
    {
        /**
         * Affiche les lectures effectuees
         */
        /**
         * Lecture des informations concernant la photo
         */
        $this->vue = service("Smarty");
        $photo = new Photo();
        $dataPhoto = $photo->getDetail($_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]));
        /**
         * Recuperation de la taille de l'image
         */
        switch ($_REQUEST["resolution"]) {
            case 2:
                $image_width = 1024;
                $image_height = 768;
                break;
            case 3:
                $image_width = 1280;
                $image_height = 1024;
                break;
            case 4:
                $image_width = 1600;
                $image_height = 1300;
                break;
            case 5:
                $image_width = 20000;
                $image_height = 20000;
                break;
            default:
                $image_width = 800;
                $image_height = 600;
        }
        /**
         * Verification qu'on ne depasse pas la resolution initiale
         */
        if ($image_width > $dataPhoto["photo_width"]) {
            $image_width = $dataPhoto["photo_width"];
        }
        if ($image_height > $dataPhoto["photo_height"]) {
            $image_height = $dataPhoto["photo_height"];
        }
        /**
         * Calcul du coefficient de correction
         */
        $coefx = $dataPhoto["photo_width"] / $image_width;
        $coefy = $dataPhoto["photo_height"] / $image_height;
        if ($coefx > $coefy) {
            $coef = $coefy;
        } else {
            $coef = $coefx;
        }
        $image_width = floor($dataPhoto["photo_width"] / $coef);
        $image_height = floor($dataPhoto["photo_height"] / $coef);
        $this->vue->set($image_width, "image_width");
        $this->vue->set($image_height, "image_height");
        $this->vue->set($coef, "coef_correcteur");

        /**
         * Generation de la photo dans le dossier temporaire, et du lien associe
         */
        $dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"], 0, $image_width, $image_height);
        /**
         * Recuperation des lectures effectuees
         */
        if (!empty($this->ids)) {
            $data = $this->dataClass->getDetailLecture($this->ids, $coef);
        } else {
            $data = $this->dataClass->getDetailLecture($this->id, $coef);
        }
        $data = $_SESSION["it_photolecture"]->translateList($data);
        $data = $_SESSION["it_photo"]->translateList($data);
        $this->vue->set($data, "data");
        /**
         * Lecture des informations concernant la piece et le poisson
         */
        $piece = new Piece();
        $dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $this->vue->set($dataPieceT, "piece");
        $individu = new Individu();
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");

        /**
         * Assignation du coefficient de transparence
         */
        if (!isset($_REQUEST["fill"])) {
            $_REQUEST["fill"] = 0.5;
        }
        $this->vue->set($_REQUEST["fill"], "fill");

        /**
         * Assignations finales
         */
        $dataPhoto = $_SESSION["it_photo"]->translateRow($dataPhoto);
        $dataPhoto = $_SESSION["it_piece"]->translateRow($dataPhoto);
        $this->vue->set($dataPhoto, "photo");
        $this->vue->set($_SESSION["moduleListe"],"moduleListe");
        $this->vue->set("photolecture/photolectureDisplay.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        $this->vue = service("Smarty");
        /**
         * Recuperation du lecteur
         */
        $lecteur = new Lecteur();
        /**
         * Traitement du cas ou les mesures precedentes sont affichees
         * $this->id contient le tableau des lectures a afficher, $photolecture_id_modif la lecture a modifier
         */
        if (isset($_REQUEST["photolecture_id_modif"])) {
            if (!empty($this->ids)) {
                $mesurePrecId = $this->ids;
            } else {
                $mesurePrecId = $this->id;
            }
            $this->id = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id_modif"]);
        }
        $lecteur_id = $lecteur->getIdFromLogin($_SESSION["login"]);
        if ($lecteur_id > 0) {
            if ($this->id > 0) {
                /**
                 * On verifie que le lecteur est celui qui a precedemment fait la lecture
                 */
                $data = $this->dataClass->lire($this->id);
                if ($data["lecteur_id"] != $lecteur_id) {
                    $this->message->set(_("Vous n'êtes pas le lecteur initial : vous ne pouvez modifier cette lecture"), true);
                    return $this->display();
                }
            }
        } else {
            $this->message->set(_("Vous ne disposez pas des droits nécessaires pour réaliser une lecture"), true);
            return $this->display();
        }

        $data = $this->dataRead($this->id, "photolecture/photolectureChange.tpl", $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]));
        /**
         * Rajout de l'identifiant du lecteur
         */
        if (!$data["lecteur_id"] > 0) {
            $data["lecteur_id"] = $lecteur_id;
        }
        /**
         * Lecture des informations concernant la photo
         */
        $photo = new Photo();
        $dataPhoto = $photo->getDetail($_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]));
        /**
         * Lecture des informations concernant la piece et le poisson
         */
        $piece = new Piece();
        $dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $this->vue->set($dataPieceT, "piece");

        $individu = new Individu();
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");

        /**
         * Recuperation de la taille de l'image
         */
        if ($data["photolecture_id"] == 0) {
            switch ($_REQUEST["resolution"]) {
                case 2:
                    $image_width = 1024;
                    $image_height = 768;
                    break;
                case 3:
                    $image_width = 1280;
                    $image_height = 1024;
                    break;
                case 4:
                    $image_width = 1600;
                    $image_height = 1300;
                    break;
                case 5:
                    $image_width = 10000;
                    $image_height = 10000;
                    break;
                default:
                    $image_width = 800;
                    $image_height = 600;
            }
        } else {
            $image_width = $data["photolecture_width"];
            $image_height = $data["photolecture_height"];
            /**
             * Gestion des anomalies
             */
            if (!$image_width > 0 && $image_height > 0) {
                $image_width = 800;
                $image_height = 600;
            }
        }
        /**
         * Verification qu'on ne depasse pas la resolution initiale
         */
        if ($image_width > $dataPhoto["photo_width"]) {
            $image_width = $dataPhoto["photo_width"];
        }
        if ($image_height > $dataPhoto["photo_height"]) {
            $image_height = $dataPhoto["photo_height"];
        }
        /**
         * Calcul du coefficient de correction
         */
        $coefx = $dataPhoto["photo_width"] / $image_width;
        $coefy = $dataPhoto["photo_height"] / $image_height;
        if ($coefx > $coefy) {
            $coef = $coefy;
        } else {
            $coef = $coefx;
        }
        $image_width = floor($dataPhoto["photo_width"] / $coef);
        $image_height = floor($dataPhoto["photo_height"] / $coef);
        $this->vue->set($image_width, "image_width");
        $this->vue->set($image_height, "image_height");
        $dataDetail = $this->dataClass->getDetailLecture($this->id, $coef);
        $dataT = $_SESSION["it_photolecture"]->translateRow($dataDetail);
        $dataT = $_SESSION["it_photo"]->translateRow($dataT);
        $this->vue->set($dataT, "data");

        /**
         * Recuperation des lectures precedentes
         */
        if (isset($mesurePrecId)) {
            $mesurePrec = $this->dataClass->getDetailLecture($mesurePrecId, $coef, $this->id);
            $this->vue->set($mesurePrec, "mesurePrec");
        }
        $this->vue->set($coef, "coef_correcteur");

        /**
         * Calcul des points pour reaffichage en mode saisie
         */
        if ($data["photolecture_id"] > 0) {
            $dataPoint = $this->dataClass->lirePoints($data["photolecture_id"]);
            if (strlen($dataPoint["points"]) > 0) {
                $data["points"] = $this->dataClass->calculPointsAffichage(
                    $dataPoint["points"],
                    $coef,
                    $data["remarkable_points"]
                );
            }
            if (strlen($dataPoint["points_ref_lecture"]) > 0) {
                $data["points_ref_lecture"] = $this->dataClass->calculPointsAffichage($dataPoint["points_ref_lecture"], $coef);
            }
        }
        /**
         * Recalcul du rayon d'affichage du premier point
         */
        $data["rayon_point_initial"] = floor($data["rayon_point_initial"] / $coef);

        /**
         * Reecriture de data dans smarty
         */
        $data = $_SESSION["it_photolecture"]->translateRow($data);
        $data = $_SESSION["it_photo"]->translateRow($data);
        $this->vue->set($data, "data");

        /**
         * Generation de la photo dans le dossier temporaire, et du lien associe
         */
        $dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"], 0, $image_width, $image_height);
        $dataPhoto = $_SESSION["it_photo"]->translateRow($dataPhoto);
        $dataPhoto = $_SESSION["it_piece"]->translateRow($dataPhoto);
        $this->vue->set($dataPhoto, "photo");
        /**
         * Integration du facteur de transparence
         */
        if (!isset($_REQUEST["fill"])) {
            $_REQUEST["fill"] = 0;
        }
        $this->vue->set($_REQUEST["fill"], "fill");

        /**
         * Recuperation de la table des stries finales
         */
        $finalStripe = new Final_stripe();
        $this->vue->set($finalStripe->getListe(1), "finalStripe");
        $this->vue->set($_SESSION["moduleListe"],"moduleListe");
        return $this->vue->send();
    }


    function write()
    {
        /**
         * write record in database
         */

        $_REQUEST["photolecture_id"] = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id"]);
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
        $this->id = $this->dataWrite($_REQUEST);
        if ($this->id > 0) {
            $_REQUEST["photolecture_id"] = $_SESSION["it_photolecture"]->setValue($this->id);
        }
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->setValue($_REQUEST["photo_id"]);
        return $this->display();
    }
    function delete()
    {
        /**
         * delete record
         */

        /**
         * Recherche si l'utilisateur dispose des droits de suppression
         */
        $deleteOk = false;

        foreach (array("admin", "param") as $droit) {
            if ($_SESSION["droits"][$droit] == 1) {
                $deleteOk = true;
            }
        }
        if (!$deleteOk) {
            /**
             * Recherche si l'utilisateur modifie sa lecture
             */
            if ($this->dataClass->getLecteur($this->id)["login"] == $_SESSION["login"]) {
                $deleteOk = true;
            }
        }
        if ($deleteOk) {
            if ($this->dataDelete($this->id)) {
                return $this->list();
            } else {
                return $this->change();
            }
        } else {
            $this->message->set(_("Vous ne disposez pas des droits suffisants pour supprimer la lecture"), true);
            return $this->display();
        }
    }
    function list()
    {
        /**
         * Lance la recherche des lectures effectuees
         */
        /**
         * Mise a jour du module d'affichage de la liste
         */
        $this->vue = service("Smarty");
        $_SESSION["moduleListe"] = "photolectureList";
        /**
         * Gestion des criteres de recherche
         */
        if (isset($_REQUEST["exp_id"])) {
            $_REQUEST["exp_id"] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        }
        $_SESSION["searchLecture"]->setParam($_REQUEST);
        $dataRecherche = $_SESSION["searchLecture"]->getParam();
        if ($_SESSION["searchLecture"]->isSearch() == 1) {
            $data = $this->dataClass->getListSearch($dataRecherche);
            $data = $_SESSION["it_photolecture"]->translateList($data);
            $data = $_SESSION["it_photo"]->translateList($data);
            $data = $_SESSION["it_individu"]->translateList($data);
            $data = $_SESSION["it_piece"]->translateList($data);
            $this->vue->set($data, "data");
            $this->vue->set(1, "isSearch");
        }
        $dataRecherche["exp_id"] = $_SESSION["it_experimentation"]->setValue($dataRecherche["exp_id"]);
        $this->vue->set($dataRecherche, "lectureSearch");

        /**
         * Recuperation de l'ensemble des informations necessaires pour la recherche
         */
        $peche = new Peche();
        $this->vue->set($peche->getListeSite(), "site");
        $this->vue->set($peche->getListeZone(), "zone");

        /**
         * Integration des experimentations
         */
        $this->vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");
        $lecteur = new Lecteur();
        $this->vue->set($lecteur->getListe(), "lecteur");

        /**
         * Affichage
         */
        $this->vue->set("photolectureList", "modulePostSearch");
        $this->vue->set("photolecture/photolectureList.tpl", "corps");
        return $this->vue->send();
    }
    function export()
    {
        /**
         * Creation d'un fichier au format csv pour exporter les lectures selectionnees
         */
        /**
         * Recuperation des parametres de recherche
         */

        $dataRecherche = $_SESSION["searchLecture"]->getParam();
        $data = $this->dataClass->getListSearch($dataRecherche);
        $data = $_SESSION["it_photolecture"]->translateList($data);
        $data = $_SESSION["it_photo"]->translateList($data);
        $data = $_SESSION["it_individu"]->translateList($data);
        $data = $_SESSION["it_piece"]->translateList($data);
        if (count($data) > 0) {
            /**
             * Recuperation de la classe permettant l'export
             */
            //include_once 'modules/classes/importDataFile.class.php';
            //$export = new ImportDataFile();
            //$nomfichier = "lecture";
            //$export->exportCSVinit($nomfichier, 'tab');
            $colExclude = array(
                "photolecture_id", "photo_id", "lecteur_id", "piece_id", "individu_id", "points", "points_ref_lecture", "final_stripe_id", "remarkable_points"
            );
            $dataExport = array();

            /**
             * Traitement des lignes - on rajoute les coordonnees des points
             */
            $nbPoint = 0;
            foreach ($data as $row) {
                $ligne = array();
                /**
                 * Recuperation des colonnes necessaires dans l'export
                 */
                foreach ($row as $kcol => $vcol) {
                    if (!in_array($kcol, $colExclude)) {
                        $ligne[$kcol] = $vcol;
                    }
                }
                /** Traitement des points remarquables */
                $rp = json_decode($row["remarkable_points"]);
                $i = 0;
                $drp = "";
                foreach ($rp as $vrp) {
                    if ($i > 0) {
                        $drp .= ",";
                    }
                    $drp .= $vrp + 1;
                    $i++;
                }
                $ligne["remarkable_points"] = $drp;

                /** Traitement des points - calcul des coordonnees */
                if (strlen($row["points"]) > 0) {
                    $dataPoints["points"] = $this->dataClass->calculPointsAffichage($row["points"], 1);
                }

                /**
                 * On rajoute les points a la suite
                 */
                $i = 0;
                $x1 = 0;
                $y1 = 0;
                foreach ($dataPoints["points"] as $value1) {
                    $ligne["pointX" . $i] = $value1["x"];
                    $ligne["pointY" . $i] = $value1["y"];
                    if ($i > 0) {
                        /**
                         * Rajout de la distance au point precedent
                         */
                        $ligne["dist-" . ($i - 1) . "-" . $i] = $this->dataClass->calculDistance($x1, $y1, $value1["x"], $value1["y"]);
                    }

                    $x1 = $value1["x"];
                    $y1 = $value1["y"];
                    $i++;
                }
                if ($i > $nbPoint) {
                    $nbPoint = $i;
                }

                $dataExport[] = $ligne;
            }
            $this->vue = service('CsvView');
            $this->vue->set($dataExport);
            $this->vue->regenerateHeader();
            $this->vue->send();
        }
    }
    function swap()
    {
        /**
         * Permet de choisir le mode de visualisation : visualisation simple ou modification/creation d'une lecture
         */
        if (isset($_REQUEST["photolecture_id_modif"])) {
            return $this->change();
        } else {
            return $this->display();
        }
    }
}
