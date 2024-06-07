<?php
/**
 * Import massif d'echantillons ou de containers
 * et creation des mouvements afferents
 * Created : 18 août 2016
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2016 - All rights reserved
 */
include_once 'modules/classes/import.class.php';
include_once 'modules/classes/individu.class.php';
include_once 'modules/classes/piece.class.php';
include_once 'modules/classes/peche.class.php';
include_once 'modules/classes/piecemetadata.class.php';
include_once 'modules/classes/metadatatype.class.php';
include_once 'modules/classes/piecestype.class.php';
include_once 'modules/classes/espece.class.php';
include_once 'modules/classes/individu_experimentation.class.php';
include_once 'modules/classes/sexe.class.php';
include_once 'modules/classes/piecetype.class.php';
/*
 * Initialisations
 */
$import = new Import();
$piecetype = new Piecetype($bdd, $ObjetBDDParam);
$espece = new Espece($bdd, $ObjetBDDParam);
$individu = new Individu($bdd, $ObjetBDDParam);
$piece = new Piece($bdd, $ObjetBDDParam);
$peche = new Peche($bdd, $ObjetBDDParam);
$ie = new Individu_experimentation($bdd, $ObjetBDDParam);
$sexe = new Sexe($bdd, $ObjetBDDParam);
$pm = new Piecemetadata($bdd, $ObjetBDDParam);
$mt = new Metadatatype($bdd, $ObjetBDDParam);

$import->initClasses($individu, $piece, $ie, $peche, $pm);
$import->initControl($_SESSION["experimentations"], $piecetype->getList(), $espece->getList(), $sexe->getListe(), $mt->getListe());
/*
 * Traitement
 */

switch ($t_module["param"]) {
    case "change":
        /*
         * Affichage du masque de selection du fichier a importer
         */
        $vue->set("gestion/import.tpl", "corps");
        $vue->set($_REQUEST["separator"], "separator");
        $vue->set($_REQUEST["utf8_encode"], "utf8_encode");
        break;

    case "control":
        $vue->set("gestion/import.tpl", "corps");
        $vue->set($_REQUEST["separator"], "separator");
        $vue->set($_REQUEST["utf8_encode"], "utf8_encode");
        /*
         * Lancement des controles
         */
        unset($_SESSION["filename"]);
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            /*
             * Lancement du controle
             */
            try {
                $import->initFile($_FILES['upfile']['tmp_name'], $_REQUEST["separator"], $_REQUEST["utf8_encode"]);
                $resultat = $import->controlAll();
                if (count($resultat) > 0) {
                    /*
                     * Erreurs decouvertes
                     */
                    $vue->set(1, "erreur");
                    $vue->set($resultat, "erreurs");
                    $module_coderetour = -1;
                } else {
                    /*
                     * Deplacement du fichier dans le dossier temporaire
                     */
                    $filename = $APPLI_photoStockage . '/' . bin2hex(openssl_random_pseudo_bytes(4));
                    if (!copy($_FILES['upfile']['tmp_name'], $filename)) {
                        $message->set("Impossible de recopier le fichier importé dans le dossier temporaire", true);
                    } else {
                        $_SESSION["filename"] = $filename;
                        $_SESSION["separator"] = $_REQUEST["separator"];
                        $_SESSION["utf8_encode"] = $_REQUEST["utf8_encode"];
                        $vue->set(1, "controleOk");
                        $vue->set($_FILES['upfile']['name'], "filename");
                    }
                }
            } catch (Exception $e) {
                $message->set($e->getMessage(), true);
                $module_coderetour = -1;
            }
        }
        $import->fileClose();
        $module_coderetour = 1;
        break;
    case "import":
        if (isset($_SESSION["filename"])) {
            if (file_exists($_SESSION["filename"])) {
                $bdd->beginTransaction();
                try {
                    $import->initFile($_SESSION["filename"], $_SESSION["separator"], $_SESSION["utf8_encode"]);
                    $import->importAll();
                    $message->set("Import effectué. " . $import->nbTreated . " lignes traitées");
                    $message->set("Premier id généré : " . $import->minuid);
                    $message->set("Dernier id généré : " . $import->maxuid);
                    $bdd->commit();
                    $module_coderetour = 1;
                } catch (Exception $e) {
                    $message->set($e->getMessage(), true);
                    $module_coderetour = -1;
                    $bdd->rollBack();
                }
            }
        }
        unset($_SESSION["filename"]);
        break;
}
