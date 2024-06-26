<?php

namespace App\Libraries;

use App\Models\Experimentation;
use App\Models\Individu;
use App\Models\Metadatatype;
use App\Models\Photo;
use App\Models\Piece as ModelsPiece;
use App\Models\Piecemetadata;
use App\Models\Piecetype;
use App\Models\Traitementpiece;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Piece extends PpciLibrary
{
    /**
     *
     * @var Piece
     */
    protected $dataclass;
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsPiece();

        $this->id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
    }

    function list()
    {
        $this->vue = service("Smarty");
        $_SESSION["moduleListe"] = "pieceList";
        /**
         * Integration des experimentations
         */
        if (isset($_REQUEST["exp_id"])) {
            $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
            $_SESSION["searchIndividu"]->setParam(array("exp_id" => $exp_id));
        } else {
            $exp_id = $_SESSION["searchIndividu"]->getParam("exp_id");
        }
        $this->vue->set($_SESSION["it_experimentation"]->setValue($exp_id), "exp_id");
        $this->vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");
        /**
         * Recherche des pieces
         */
        if ($exp_id > 0) {
            $data = $this->dataClass->getListFromExperimentation($exp_id);
            $this->vue->set(
                $_SESSION["it_piece"]->translateList(
                    $_SESSION["it_individu"]->translateList(
                        $data
                    )
                ),
                "data"
            );
        }
        $this->vue->set("gestion/pieceListe.tpl", "corps");
        return $this->vue->send();
    }
    function display()
    {
        $this->vue = service("Smarty");
        /**
         * Display the detail of the record
         */
        $data = $this->dataClass->getDetail($this->id);
        $dataT = $_SESSION["it_piece"]->translateRow($data);
        $dataT = $_SESSION["it_individu"]->translateRow($dataT);
        $this->vue->set($dataT, "data");

        /**
         * Lecture des photos
         */
        $photo = new Photo();
        /**
         * Lecture du poisson
         */
        $individu = new Individu();
        $dataIndiv = $individu->getDetail($data["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");
        $listePhoto = $photo->getListePhotoFromPiece($this->id);

        /** Lecture des metadonnees */

        $pm = new Piecemetadata();
        try {
            $metadatas = $pm->getListFromPiece($this->id);
            $metadatas = $_SESSION["it_piece"]->translateList($metadatas);
            $this->vue->set($_SESSION["it_piecemetadata"]->translateList($metadatas), "metadatas");
        } catch (PpciException $e) {
            $this->message->set(_("Problème lors de la lecture des métadonnées rattachées à la pièce"), true);
            $this->message->setSyslog($e->getMessage());
        }
        $mdt = new Metadatatype();
        $this->vue->set($mdt->getListe(), "metadatatypes");
        /**
         * Rajout du lien vers l'image
         */
        foreach ($listePhoto as $key => $value) {
            $listePhoto[$key]["photoPath"] = $photo->writeFilePhoto($value["photo_id"], 1);
        }
        $this->vue->set($_SESSION["it_photo"]->translateList($listePhoto), "photo");
        $this->vue->set($_SESSION["moduleListe"], "moduleListe");
        $this->vue->set("gestion/pieceDisplay.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        $this->vue = service("Smarty");
        $traitementpiece = new Traitementpiece();
        $this->vue->set($traitementpiece->getListe(), "traitementpiece");
        $piecetype = new Piecetype();
        $this->vue->set($piecetype->getListe(), "piecetype");

        /**
         * Lecture du poisson
         */
        $individu = new Individu();
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
        $dataIndiv = $individu->getDetail($_REQUEST["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");
        $data = $this->dataRead($this->id, "gestion/pieceChange.tpl", $_REQUEST["individu_id"]);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $this->vue->set($data, "data");
        return $this->vue->send();
    }
    function write()
    {
        /**
         * write record in database
         */
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
        try {
            $this->id = $this->dataWrite($_REQUEST);
            $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($this->id);
            return $this->display();
        } catch (PpciException) {
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
            return $this->list();
        } catch (PpciException) {
            return $this->change();
        }
        if ($this->dataDelete($this->id)) {
            return $this->list();
        } else {
            $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($this->id);
            /**
             * Reaffectation de l'identifiant en cas d'échec de la suppression
             *
             **/
            return $this->change();
        }
    }

    function exportCS()
    {
        /**
         * Export the list in a format usable by Collec-Science
         */
        /**
         * Get the name of experimentation
         */
        try {
            $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
            $experimentation = new Experimentation();
            $dexp = $experimentation->lire($exp_id);
            $exp_name = $dexp["exp_nom"];
            if (strlen($exp_name) == 0) {
                throw new PpciException(_("Le nom de l'expérimentation n'a pas été fournie"));
            }
            if (count($_REQUEST["pieces"]) == 0) {
                throw new PpciException((_("Pas de pièces à exporter")));
            }
            /**
             * Get the piece_id to treat
             */
            $pieces = array();
            foreach ($_REQUEST["pieces"] as $value) {
                $pieces[] = $_SESSION["it_piece"]->getValue($value);
            }
            $data = $this->dataClass->getListForCollec($pieces, $exp_name);
            if (count($data) == 0) {
                throw new PpciException(_("Aucune pièce n'a été sélectionnée dans la base de données"));
            }
            $this->vue = service('CsvView');
            $this->vue->set($data);
            return $this->vue->send();
        } catch (PpciException $e) {
            $this->message->set(_("L'exportation n'a pas été réalisée"), true);
            $this->message->set($e->getMessage());
            return $this->list();
        }
    }
}
