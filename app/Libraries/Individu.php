<?php

namespace App\Libraries;

use \Ppci\Libraries\PpciLibrary;
use App\Models\Experimentation;
use App\Models\Individu as ModelsIndividu;
use App\Models\Individu_experimentation;
use App\Models\Peche;
use App\Models\Piece;
use App\Models\Sexe;
use Ppci\Libraries\PpciException;
use Ppci\Models\PpciModel;

class Individu extends PpciLibrary
{
    /**
     * 
     *
     * @var ModelsIndividu
     */
    protected PpciModel $dataclass;

    function __construct()
    {
        parent::__construct();
        $this->dataclass = new ModelsIndividu();
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
        $this->id = $_REQUEST["individu_id"];
    }



    function list()
    {
        $this->vue = service('Smarty');
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
        if (isset($_REQUEST["exp_id"])&& !is_array($_REQUEST["exp_id"])) {
            $_REQUEST["exp_id"] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        }
        $_SESSION["searchIndividu"]->setParam($_REQUEST);
        $dataRecherche = $_SESSION["searchIndividu"]->getParam();
        if ($_SESSION["searchIndividu"]->isSearch() == 1) {
            $data = $_SESSION["it_individu"]->translateList($this->dataclass->getListSearch($dataRecherche), true);
            $data = $_SESSION["it_peche"]->translateList($data);
            $this->vue->set($data, "data");
            $this->vue->set(1, "isSearch");
        }
        $sexe = new Sexe();
        $this->vue->set($sexe->getListe(), "sexe");

        /*
         * Integration des experimentations
         */
        $this->vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");

        /*
         * Recherche des zones de peche
         */
        $peche = new Peche();
        $this->vue->set($peche->getListeSite(), "site");
        $this->vue->set($peche->getListeZone(), "zone");
        if (is_array($dataRecherche["exp_id"])) {
            $dataRecherche["exp_id"] = $dataRecherche["exp_id"][0];
        }
        $dataRecherche["exp_id"] = $_SESSION["it_experimentation"]->setValue($dataRecherche["exp_id"]);
        $this->vue->set($dataRecherche, "individuSearch");

        /*
         * Affectation du nom du module pour le cartouche de recherche
         */
        $this->vue->set("individuList", "modulePostSearch");
        $this->vue->set($data, "data");
        $this->vue->set("gestion/individuListe.tpl", "corps");
        return $this->vue->send();
    }
    function display()
    {
        $this->vue = service('Smarty');
        /*
         * Display the detail of the record
         */
        $data = $this->dataclass->getDetail($this->id);
        $dataT = $_SESSION["it_individu"]->translateRow($data);
        $dataT = $_SESSION["it_peche"]->translateRow($dataT);
        $this->vue->set($dataT, "data");

        /*
         * Lecture des experimentations
         */
        $individu_experimentation = new Individu_experimentation();
        $dataIE = $individu_experimentation->getListeFromIndividu($this->id);
        $dataIE = $_SESSION["it_experimentation"]->translateList($dataIE);
        $dataIE = $_SESSION["it_individu"]->translateList($dataIE);
        $this->vue->set($dataIE, "experimentation");

        /*
         * Lecture des pieces
         */
        $piece = new Piece();
        $dataPiece = $piece->getListFromIndividu($this->id);
        $dataPiece = $_SESSION["it_piece"]->translateList($dataPiece);
        $dataPiece = $_SESSION["it_individu"]->translateList($dataPiece);
        $this->vue->set($dataPiece, "piece");
        /*
         * Lecture des donnees sur la peche
         */
        $peche = new Peche();
        if ($data["peche_id"] > 0) {
            $dataPeche = $peche->lire($data["peche_id"]);
            $dataPeche = $_SESSION["it_peche"]->translateRow($dataPeche);
            $this->vue->set($dataPeche, "peche");
        }
        $this->vue->set($_SESSION["moduleListe"], "moduleListe");
        $this->vue->set("gestion/individuDisplay.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        /*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        $data = $this->dataRead($this->id, "gestion/individuChange.tpl");
        $dataT = $_SESSION["it_individu"]->translateRow($data);
        $dataT = $_SESSION["it_peche"]->translateRow($dataT);
        $this->vue->set($dataT, "data");
        /*
         * Lecture des donnees de peche
         */
        $peche = new Peche();
        if ($data["peche_id"] > 0) {
            $dataPeche = $peche->lire($data["peche_id"]);
            $dataPeche = $_SESSION["it_peche"]->translateRow($dataPeche);
            $this->vue->set($dataPeche, "peche");
        }
        /*
         * Lecture des sexes
         */
        $sexe = new Sexe();
        $this->vue->set($sexe->getListe(), "sexes");

        /*
         * Liste des experimentations
         */
        $experimentation = new Experimentation();
        $this->vue->set($_SESSION["it_experimentation"]->translateList($experimentation->getAllListFromIndividu($this->id)), "experimentations");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        try {
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
                $_REQUEST["exp_id"][0] = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
            }
            if (empty($_REQUEST["exp_id"])) {
                $this->message->set(_("Au moins une expérimentation doit être associée avec le poisson"), true);
                die;
                throw new PpciException();
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
                    }
                }
                if (!$isPeche) {
                    unset($_REQUEST["peche_id"]);
                }
            } else {
                $isPeche = true;
            }
            if ($isPeche) {
                $peche = new Peche();
                $_REQUEST["peche_id"] = $peche->ecrire($_REQUEST);
            }

            $this->id = $this->dataWrite($_REQUEST);
            $_REQUEST["individu_id"] = $_SESSION["it_individu"]->setValue($this->id);
            return $this->display();
        } catch (PpciException) {
            return $this->change();
        }
    }
    function delete()
    {
        /*
         * delete record
         */

        try {
            $this->dataDelete($this->id);
            return $this->list();
        } catch (PpciException $e) {
            return $this->change();
        }
    }
    function listEspece()
    {
        $this->vue = service('AjaxView');
        $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        $this->vue->set($this->dataclass->getListEspeceFromExp($exp_id));
        return $this->vue->send();
    }
}
