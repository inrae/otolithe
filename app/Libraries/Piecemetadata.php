<?php

namespace App\Libraries;

use App\Libraries\Piece as AppLibrariesPiece;
use App\Models\Individu;
use App\Models\Metadatatype;
use App\Models\Piece;
use App\Models\Piecemetadata as ModelsPiecemetadata;
use Ppci\Libraries\Piece as LibrariesPiece;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;
use Ppci\Models\Import as ModelsImport;

class Piecemetadata extends PpciLibrary
{
    protected int $piece_id;
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsPiecemetadata();
        $this->id = $_SESSION["it_piecemetadata"]->getValue($_REQUEST["piecemetadata_id"]);
        $this->piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
    }

    function display()
    {
        $this->vue = service("Smarty");
        $data = $this->dataRead($this->id, "gestion/piecemetadataDisplay.tpl", $this->piece_id);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $data = $_SESSION["it_piecemetadata"]->translateRow($data);
        $this->vue->set($data, "data");
        /** Recuperation des donnees des objets precedents */
        $piece = new Piece();
        $dpiece = $piece->getDetail($this->piece_id);
        $this->vue->set($_SESSION["it_piece"]->translateRow($dpiece), "piece");
        /** Recuperation du modele de metadonnees */
        include_once 'modules/classes/metadatatype.class.php';
        $mt = new Metadatatype();
        $this->vue->set($mt->lire($data["metadatatype_id"]), "metadatatype");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu();
        $this->vue->set($_SESSION["it_individu"]->translateRow($individu->getDetail($dpiece["individu_id"])), "individu");
        $this->vue->set($_SESSION["moduleListe"],"moduleListe");
        return $this->vue->send();
    }
    function change()
    {
        $this->vue = service("Smarty");
        $data = $this->dataRead($this->id, "gestion/piecemetadataChange.tpl", $this->piece_id);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $data = $_SESSION["it_piecemetadata"]->translateRow($data);
        $this->vue->set($data, "data");
        /** Recuperation des donnees des objets precedents */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece();
        $dpiece = $piece->getDetail($this->piece_id);
        $this->vue->set($_SESSION["it_piece"]->translateRow($dpiece), "piece");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu();
        $this->vue->set($_SESSION["it_individu"]->translateRow($individu->getDetail($dpiece["individu_id"])), "individu");
        /** Liste des types de metadonnees disponibles */
        include_once 'modules/classes/metadatatype.class.php';
        $mdt = new Metadatatype();
        $this->vue->set($mdt->getListe(), "metadatatypes");
        $this->vue->set($_SESSION["moduleListe"],"moduleListe");
        return $this->vue->send();
    }
    function write()
    {
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $_REQUEST["piecemetadata_id"] = $this->id;
        try {
            $this->id = $this->dataWrite($_REQUEST);
            if ($this->id > 0) {
                $_REQUEST["piecemetadata_id"] = $_SESSION["it_piecemetadata"]->setValue($this->id);
            }
            $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($_REQUEST["piece_id"]);
            $piece = new AppLibrariesPiece();
            return $piece->display();
        } catch (PpciException) {
            $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($_REQUEST["piece_id"]);
            return $this->change();
        }
    }
    function delete()
    {
        /**
         * delete record
         */
        try {
            $this->dataDelete($this->id);
            $piece = new AppLibrariesPiece();
            return $piece->display();
        } catch (PpciException) {
            return $this->change();
        }
    }
    function import()
    {
        /** Recuperation de la liste des champs disponibles */
        $mdt = new Metadatatype();
        $metadata = $mdt->lire($_REQUEST["metadatatype_id"]);
        $cm = json_decode($metadata["metadatatype_schema"], true);
        $colonnes = array();
        foreach ($cm as $row) {
            $colonnes[] = $row["name"];
        }
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            try {
                $import = new ModelsImport($_FILES['upfile']['tmp_name'], $_REQUEST["separateur"], false, $colonnes);
                /** Preparation de l'enregistrement */
                $data = array();
                $data["piecemetadata_id"] = 0;
                $data["piece_id"] = $this->piece_id;
                $data["metadatatype_id"] = $_REQUEST["metadatatype_id"];
                $data["piecemetadata_date"] = $_REQUEST["piecemetadata_date"];
                $data["piecemetadata_comment"] = $_REQUEST["piecemetadata_comment"];
                $data["metadata"] = json_encode($import->getContentAsArray());
                $this->dataClass->ecrire($data);
                $this->message->set(_("Importation du jeu de métadonnées effectué"));
            } catch (PpciException $e) {
                $this->message->set($e->getMessage(), true);
            }
        } else {
            $this->message->set(_("Impossible de charger le fichier à importer"));
        }
        $piece = new AppLibrariesPiece();
            return $piece->display();
    }
    function export()
    {
        $this->vue = service ("CsvView");
        $data = $this->dataClass->lire($this->id);
        $this->vue->set(json_decode($data["metadata"], true));
        return $this->vue->send();
    }
}
