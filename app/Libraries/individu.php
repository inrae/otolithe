<?php

require_once 'modules/classes/individu.class.php';

$dataClass = new Individu($bdd, $ObjetBDDParam);
/*
 * Initialisation de la classe de traduction des cles
 */
$_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
$id = $_REQUEST["individu_id"];

switch ($t_module["param"]) {
    case "list":
        /*
         * Display the list of all records of the table
         */
        /*
         * Mise a jour du module d'affichage de la liste
         */
        $_SESSION["moduleListe"] = "individuList";
        /*
         * Gestion des criteres de recherche
         */
        if (isset($_REQUEST["exp_id"])) {
            $_REQUEST["exp_id"] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        }
        $searchIndividu->setParam($_REQUEST);
        $dataRecherche = $searchIndividu->getParam();
        if ($searchIndividu->isSearch() == 1) {
            $data = $_SESSION["it_individu"]->translateList($dataClass->getListSearch($dataRecherche), true);
            $data = $_SESSION["it_peche"]->translateList($data);
            $vue->set($data, "data");
            $vue->set(1, "isSearch");
        }
        require_once 'modules/classes/sexe.class.php';
        $sexe = new Sexe($bdd, $ObjetBDDParam);
        $vue->set($sexe->getListe(), "sexe");



        /*
         * Integration des experimentations
         */
        $vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");

        /*
         * Recherche des zones de peche
         */
        include_once "modules/classes/peche.class.php";
        $peche = new Peche($bdd, $ObjetBDDParam);
        $vue->set($peche->getListeSite(), "site");
        $vue->set($peche->getListeZone(), "zone");
        $dataRecherche["exp_id"] = $_SESSION["it_experimentation"]->setValue($dataRecherche["exp_id"]);
        $vue->set($dataRecherche, "individuSearch");

        /*
         * Affectation du nom du module pour le cartouche de recherche
         */
        $vue->set("individuList", "modulePostSearch");
        $vue->set($data, "data");
        $vue->set("gestion/individuListe.tpl", "corps");

        break;
    case "display":
        /*
         * Display the detail of the record
         */
        $data = $dataClass->getDetail($id);
        $dataT = $_SESSION["it_individu"]->translateRow($data);
        $dataT = $_SESSION["it_peche"]->translateRow($dataT);
        $vue->set($dataT, "data");

        /*
         * Lecture des experimentations
         */
        require_once "modules/classes/individu_experimentation.class.php";
        $individu_experimentation = new Individu_experimentation($bdd, $ObjetBDDParam);
        $dataIE = $individu_experimentation->getListeFromIndividu($id);
        $dataIE = $_SESSION["it_experimentation"]->translateList($dataIE);
        $dataIE = $_SESSION["it_individu"]->translateList($dataIE);
        $vue->set($dataIE, "experimentation");

        /*
         * Lecture des pieces
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dataPiece = $piece->getListFromIndividu($id);
        $dataPiece = $_SESSION["it_piece"]->translateList($dataPiece);
        $dataPiece = $_SESSION["it_individu"]->translateList($dataPiece);
        $vue->set($dataPiece, "piece");
        /*
         * Lecture des donnees sur la peche
         */
        include_once 'modules/classes/peche.class.php';
        $peche = new Peche($bdd, $ObjetBDDParam);
        if ($data["peche_id"] > 0) {
            $dataPeche = $peche->lire($data["peche_id"]);
            $dataPeche = $_SESSION["it_peche"]->translateRow($dataPeche);
            $vue->set($dataPeche, "peche");
        }
        $vue->set("gestion/individuDisplay.tpl", "corps");

        break;
    case "change":
        /*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        $data = dataRead($dataClass, $id, "gestion/individuChange.tpl");
        $dataT = $_SESSION["it_individu"]->translateRow($data);
        $dataT = $_SESSION["it_peche"]->translateRow($dataT);
        $vue->set($dataT, "data");
        include_once 'modules/classes/peche.class.php';
        /*
         * Lecture des donnees de peche
         */
        $peche = new Peche($bdd, $ObjetBDDParam);
        if ($data["peche_id"] > 0) {
            $dataPeche = $peche->lire($data["peche_id"]);
            $dataPeche = $_SESSION["it_peche"]->translateRow($dataPeche);
            $vue->set($dataPeche, "peche");
        }
        /*
         * Lecture des sexes
         */
        require_once "modules/classes/sexe.class.php";
        $sexe = new Sexe($bdd, $ObjetBDDParam);
        $vue->set($sexe->getListe(), "sexes");

        /*
         * Liste des experimentations
         */
        require_once "modules/classes/experimentation.class.php";
        $experimentation = new Experimentation($bdd, $ObjetBDDParam);
        $vue->set($_SESSION["it_experimentation"]->translateList($experimentation->getAllListFromIndividu($id)), "experimentations");

        break;
    case "write":
        /*
         * write record in database
         */
        /*
         * Recuperation des cles reelles
         */
        if (is_array($_REQUEST["exp_id"])) {
            $exp_id = array();
            foreach ($_REQUEST["exp_id"] as $value) {
                $exp_id[] = $_SESSION["it_experimentation"]->getValue($value);
            }
            $_REQUEST["exp_id"] = $exp_id;
        } else {
            $_REQUEST["exp_id"] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        }
        $_REQUEST["peche_id"] = $_SESSION["it_peche"]->getValue($_REQUEST["peche_id"]);

        $isPeche = false;
        if ($_REQUEST["peche_id"] == 0) {
            /*
             * Recherche si un enregistrement peche doit etre cree ou non
             */

            foreach (array("site", "zonesite", "peche_date", "campagne", "peche_engin", "personne", "operateur") as $value) {
                if (strlen($_REQUEST[$value]) > 0) {
                    $isPeche = true;
                    break;
                }
            }
            if (!$isPeche) {
                unset($_REQUEST["peche_id"]);
            }
        } else {
            $isPeche = true;
        }
        if ($isPeche) {
            include_once 'modules/classes/peche.class.php';
            $peche = new Peche($bdd, $ObjetBDDParam);
            $_REQUEST["peche_id"] = $peche->ecrire($_REQUEST);
        }
        $id = dataWrite($dataClass, $_REQUEST);
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->setValue($id);
        break;
    case "delete":
        /*
         * delete record
         */

        dataDelete($dataClass, $id);

        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->setValue($id);

        break;
    case "listEspece":
        $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        $vue->set($dataClass->getListEspeceFromExp($exp_id));
        break;
}
