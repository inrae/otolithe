<?php

/**
 * Gestion de la lecture d'une photo
 */
require_once 'modules/classes/photolecture.class.php';
$dataClass = new Photolecture($bdd, $ObjetBDDParam);
if (is_array($_REQUEST["photolecture_id"])) {
    foreach ($_REQUEST["photolecture_id"] as $value) {
        $id[] = $_SESSION["it_photolecture"]->getValue($value);
    }
} else {
    $id = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id"]);
}

switch ($t_module["param"]) {
    case "display":
        /**
         * Affiche les lectures effectuees
         */
        /**
         * Lecture des informations concernant la photo
         */
        require_once "modules/classes/photo.class.php";
        $photo = new Photo($bdd, $ObjetBDDParam);
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
        $vue->set($image_width, "image_width");
        $vue->set($image_height, "image_height");
        $vue->set($coef, "coef_correcteur");

        /**
         * Generation de la photo dans le dossier temporaire, et du lien associe
         */
        $dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"], 0, $image_width, $image_height);
        /**
         * Recuperation des lectures effectuees
         */
        $data = $dataClass->getDetailLecture($id, $coef);
        $data = $_SESSION["it_photolecture"]->translateList($data);
        $data = $_SESSION["it_photo"]->translateList($data);
        $vue->set($data, "data");
        include_once 'modules/classes/piece.class.php';
        /**
         * Lecture des informations concernant la piece et le poisson
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $vue->set($dataPieceT, "piece");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $vue->set($dataIndiv, "individu");

        /**
         * Assignation du coefficient de transparence
         */
        if (!isset($_REQUEST["fill"])) {
            $_REQUEST["fill"] = 0;
        }
        $vue->set($_REQUEST["fill"], "fill");

        /**
         * Assignations finales
         */
        $dataPhoto = $_SESSION["it_photo"]->translateRow($dataPhoto);
        $dataPhoto = $_SESSION["it_piece"]->translateRow($dataPhoto);
        $vue->set($dataPhoto, "photo");
        $vue->set("photolecture/photolectureDisplay.tpl", "corps");
        break;
    case "change":
        /**
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        /**
         * Recuperation du lecteur
         */
        require_once "modules/classes/lecteur.class.php";
        $lecteur = new Lecteur($bdd, $ObjetBDDParam);
        /**
         * Traitement du cas ou les mesures precedentes sont affichees
         * $id contient le tableau des lectures a afficher, $photolecture_id_modif la lecture a modifier
         */
        if (isset($_REQUEST["photolecture_id_modif"])) {
            $mesurePrecId = $id;
            $id = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id_modif"]);
        }
        $data = $dataClass->getDetailLecture($id, $coef);
        $dataT = $_SESSION["it_photolecture"]->translateRow($data);
        $dataT = $_SESSION["it_photo"]->translateRow($dataT);
        $vue->set($dataT, "data");
        $lecteur_id = $lecteur->getIdFromLogin($_SESSION["login"]);
        if ($lecteur_id > 0) {
            if ($id > 0) {
                /**
                 * On verifie que le lecteur est celui qui a precedemment fait la lecture
                 */
                $data = $dataClass->lire($id);
                if ($data["lecteur_id"] != $lecteur_id) {
                    $message = "Vous n'êtes pas le lecteur initial : vous ne pouvez modifier cette lecture";
                    $module_coderetour = -1;
                }
            }
        } else {
            $module_coderetour = -1;
            $message->set(_("Vous ne disposez pas des droits nécessaires pour réaliser une lecture"), true);
        }
        if ($module_coderetour != -1) {
            $data = dataRead($dataClass, $id, "photolecture/photolectureChange.tpl", $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]));
            /**
             * Rajout de l'identifiant du lecteur
             */
            if (!$data["lecteur_id"] > 0) {
                $data["lecteur_id"] = $lecteur_id;
            }
            /**
             * Lecture des informations concernant la photo
             */
            require_once "modules/classes/photo.class.php";
            $photo = new Photo($bdd, $ObjetBDDParam);
            $dataPhoto = $photo->getDetail($_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]));
            /**
             * Lecture des informations concernant la piece et le poisson
             */
            include_once 'modules/classes/piece.class.php';
            $piece = new Piece($bdd, $ObjetBDDParam);
            $dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
            $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
            $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
            $vue->set($dataPieceT, "piece");

            include_once 'modules/classes/individu.class.php';
            $individu = new Individu($bdd, $ObjetBDDParam);
            $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
            $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
            $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
            $vue->set($dataIndiv, "individu");

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
            $vue->set($image_width, "image_width");
            $vue->set($image_height, "image_height");

            /**
             * Recuperation des lectures precedentes
             */
            if (isset($mesurePrecId)) {
                $mesurePrec = $dataClass->getDetailLecture($mesurePrecId, $coef, $id);
                $vue->set($mesurePrec, "mesurePrec");
            }
            $vue->set($coef, "coef_correcteur");

            /**
             * Calcul des points pour reaffichage en mode saisie
             */
            if ($data["photolecture_id"] > 0) {
                $dataPoint = $dataClass->lirePoints($data["photolecture_id"]);
                if (strlen($dataPoint["points"]) > 0) {
                    $data["points"] = $dataClass->calculPointsAffichage(
                        $dataPoint["points"],
                        $coef,
                        $data["remarkable_points"]
                    );
                }
                if (strlen($dataPoint["points_ref_lecture"]) > 0) {
                    $data["points_ref_lecture"] = $dataClass->calculPointsAffichage($dataPoint["points_ref_lecture"], $coef);
                }
            }
            /**
             * Recalcul du rayon d'affichage du premier point
             */
            $data["rayon_point_initial"] = floor($data["rayon_point_initial"] / $coef);
        }
        /**
         * Reecriture de data dans smarty
         */
        $data = $_SESSION["it_photolecture"]->translateRow($data);
        $data = $_SESSION["it_photo"]->translateRow($data);
        $vue->set($data, "data");

        /**
         * Generation de la photo dans le dossier temporaire, et du lien associe
         */
        $dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"], 0, $image_width, $image_height);
        $dataPhoto = $_SESSION["it_photo"]->translateRow($dataPhoto);
        $dataPhoto = $_SESSION["it_piece"]->translateRow($dataPhoto);
        $vue->set($dataPhoto, "photo");

        /**
         * Integration du facteur de transparence
         */
        if (!isset($_REQUEST["fill"])) {
            $_REQUEST["fill"] = 0;
        }
        $vue->set($_REQUEST["fill"], "fill");

        /**
         * Recuperation de la table des stries finales
         */
        require_once "modules/classes/final_stripe.class.php";
        $finalStripe = new Final_stripe($bdd, $ObjetBDDParam);
        $vue->set($finalStripe->getListe(1), "finalStripe");

        break;
    case "write":
        /**
         * write record in database
         */

        $_REQUEST["photolecture_id"] = $_SESSION["it_photolecture"]->getValue($_REQUEST["photolecture_id"]);
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST["photolecture_id"] = $_SESSION["it_photolecture"]->setValue($id);
        }
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->setValue($_REQUEST["photo_id"]);
        break;
    case "delete":
        /**
         * delete record
         */

        /**
         * Recherche si l'utilisateur dispose des droits de suppression
         */
        $deleteOk = false;

        foreach (array("admin", "gestionCompte") as $droit) {
            if ($_SESSION["droits"][$droit] == 1) {
                $deleteOk = true;
                break;
            }
        }
        if (!$deleteOk) {
            /**
             * Recherche si l'utilisateur modifie sa lecture
             */
            if ($dataClass->getLecteur($id)["login"] == $_SESSION["login"]) {
                $deleteOk = true;
            }
        }
        if ($deleteOk) {
            dataDelete($dataClass, $id);
        } else {
            $module_coderetour = -1;
            $message->set(_("Vous ne disposez pas des droits suffisants pour supprimer la lecture"), true);
        }
        break;
    case "list":
        /**
         * Lance la recherche des lectures effectuees
         */
        /**
         * Mise a jour du module d'affichage de la liste
         */
        $_SESSION["moduleListe"] = "photolectureList";
        /**
         * Gestion des criteres de recherche
         */
        if (isset($_REQUEST["exp_id"])) {
            $_REQUEST["exp_id"] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        }
        $searchLecture->setParam($_REQUEST);
        $dataRecherche = $searchLecture->getParam();
        if ($searchLecture->isSearch() == 1) {
            $data = $dataClass->getListSearch($dataRecherche);
            $data = $_SESSION["it_photolecture"]->translateList($data);
            $data = $_SESSION["it_photo"]->translateList($data);
            $data = $_SESSION["it_individu"]->translateList($data);
            $data = $_SESSION["it_piece"]->translateList($data);
            $vue->set($data, "data");
            $vue->set(1, "isSearch");
        }
        $dataRecherche["exp_id"] = $_SESSION["it_experimentation"]->setValue($dataRecherche["exp_id"]);
        $vue->set($dataRecherche, "lectureSearch");

        /**
         * Recuperation de l'ensemble des informations necessaires pour la recherche
         */
        include_once "modules/classes/peche.class.php";
        $peche = new Peche($bdd, $ObjetBDDParam);
        $vue->set($peche->getListeSite(), "site");
        $vue->set($peche->getListeZone(), "zone");

        /**
         * Integration des experimentations
         */
        $vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");
        include_once 'modules/classes/individu.class.php';
        require_once "modules/classes/lecteur.class.php";
        $lecteur = new Lecteur($bdd, $ObjetBDDParam);
        $vue->set($lecteur->getListe(), "lecteur");

        /**
         * Affichage
         */
        $vue->set("photolectureList", "modulePostSearch");
        $vue->set("photolecture/photolectureList.tpl", "corps");

        break;
    case "export":
        /**
         * Creation d'un fichier au format csv pour exporter les lectures selectionnees
         */
        /**
         * Recuperation des parametres de recherche
         */

        $dataRecherche = $searchLecture->getParam();
        $data = $dataClass->getListSearch($dataRecherche);
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
                    $dataPoints["points"] = $dataClass->calculPointsAffichage($row["points"], 1);
                }

                /**
                 * On rajoute les points a la suite
                 */
                $i = 0;
                foreach ($dataPoints["points"] as $value1) {
                    $ligne["pointX" . $i] = $value1["x"];
                    $ligne["pointY" . $i] = $value1["y"];
                    if ($i > 0) {
                        /**
                         * Rajout de la distance au point precedent
                         */
                        $ligne["dist-" . ($i - 1) . "-" . $i] = $dataClass->calculDistance($x1, $y1, $value1["x"], $value1["y"]);
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

            /**
             * Ecriture de l'entete
             */
            //$export->setLigneCSV($entete);
            /**
             * Ecriture des donnees
             */
            //$export->setTableau($data);
            /**
             * Envoi du fichier
             */
            //$export->exportCSV();
            //$vue->setFilename("otolithe_reads_" . date("Y-m-d") . ".csv");
            //$vue->setDelimiter("tab");

            $vue->set($dataExport);
            $vue->regenerateHeader();
        }

        break;
    case "swap":
        /**
         * Permet de choisir le mode de visualisation : visualisation simple ou modification/creation d'une lecture
         */
        if (isset($_REQUEST["photolecture_id_modif"])) {
            $module_coderetour = 1;
        } else {
            $module_coderetour = -1;
        }
}
