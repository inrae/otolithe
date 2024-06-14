<?php

namespace App\Libraries;

use App\Libraries\Piece as AppLibrariesPiece;
use App\Models\Individu;
use App\Models\LumiereType;
use App\Models\Photo as ModelsPhoto;
use App\Models\Photolecture;
use App\Models\Piece as ModelsPiece;
use Piece;
use Ppci\Libraries\Piece as LibrariesPiece;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Photo extends PpciLibrary
{
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsPhoto();
        $keyName = "photo_id";
        if (isset($_REQUEST[$keyName])) {
            $this->id = $_REQUEST[$keyName];
        }
        $this->id = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
    }

    function display()
    {
        /*
         * Display the detail of the record
         */
        $this->vue = service("Smarty");
        $data = $this->dataClass->getDetail($this->id);
        $dataT = $_SESSION["it_photo"]->translateRow($data);
        $dataT = $_SESSION["it_piece"]->translateRow($dataT);
        /*
         * Lecture des informations concernant la piece
         */
        $piece = new ModelsPiece();
        $dataPiece = $piece->getDetail($data["piece_id"]);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $this->vue->set($dataPieceT, "piece");

        /*
         * Lecture des informations concernant le poisson
         */
        $individu = new Individu();
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");

        /*
         * Recuperation de la liste des lectures effectuees
         */
        $photolecture = new Photolecture();
        $dataLecture = $photolecture->getListeFromPhoto($this->id);
        $dataLecture = $_SESSION["it_photolecture"]->translateList($dataLecture);
        $dataLecture = $_SESSION["it_piece"]->translateList($dataLecture);
        $this->vue->set($dataLecture, "photolecture");

        /*
         * Recuperation de la demande d'affichage de l'age
         */
        $this->vue->set($_REQUEST["ageDisplay"], "ageDisplay");

        /*
         * Preparation de l'affichage de la miniature
         */
        $this->vue->set($this->dataClass->writeFilePhoto($this->id, 1), "photoPath");
        $this->vue->set($dataT, "data");
        $this->vue->set("gestion/photoDisplay.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        $this->vue = service('Smarty');
        /*
         * Recuperation des informations sur la piece et le poisson
         */
        $piece = new ModelsPiece();
        $piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $dataPiece = $piece->getDetail($piece_id);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $this->vue->set($dataPiece, "piece");


        /*
         * Lecture des informations concernant le poisson
         */
        $individu = new Individu();
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $this->vue->set($dataIndiv, "individu");

        /*
         * Lecture des types de lumiere
         */
        $lumieretype = new LumiereType();
        $this->vue->set($lumieretype->getListe(), "lumieretype");
        $data = $this->dataRead($this->id, "gestion/photoChange.tpl", $piece_id);
        $data = $_SESSION["it_photo"]->translateRow($data);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $this->vue->set($data, "data");
        /*
         * taille maximale de telechargement d'une photo
         */
        $this->vue->set($this->appConfig->APP_maxfilesize, "maxfilesize");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        /*
         * Recherche des erreurs de telechargement
         */
        if ($_FILES["photoload"]["error"] != 4 && $_FILES["photoload"]["error"] != UPLOAD_ERR_OK) {
            switch ($_FILES["photoload"]["error"]) {
                case (UPLOAD_ERR_INI_SIZE or UPLOAD_ERR_FORM_SIZE):
                    $this->message->set(_("La taille de la photo excède la taille autorisée"), true);
                    break;
                case UPLOAD_ERR_NO_FILE:
                    /**
                     * No action
                     */
                    break;
                default:
                    $this->message->set(_("Une erreur s'est produite lors du chargement de la photo. Si le problème persiste, contactez votre support technique"), true);
            }
        }

        /*
         * On recherche si une photo a ete telechargee
         */
        if ($_FILES["photoload"]["size"] > 10) {


            $_REQUEST["photoload"] = fread(fopen($_FILES["photoload"]["tmp_name"], "r"), $_FILES["photoload"]["size"]);
            $_REQUEST["photo_filename"] = $_FILES["photoload"]["name"];
        }
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        try {
            $this->id = $this->dataWrite($_REQUEST);
            if ($this->id > 0) {
                $_REQUEST["photo_id"] = $_SESSION["it_photo"]->setValue($this->id);
            }
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
            $piece = new AppLibrariesPiece();
            return $piece->display();
        } catch (PpciException) {
            return $this->change();
        }
    }
    function getPhoto()
    {
        /*
         * Affiche le contenu d'une photo
         */
        $this->vue = service('BinaryView');
        if (!isset($_REQUEST["sizeX"])) {
            $_REQUEST["sizeX"] = 0;
        }
        if (!isset($_REQUEST["sizeY"])) {
            $_REQUEST["sizeY"] = 0;
        }
        $_REQUEST["original_format"] == 1 ? $isOrigin = true : $isOrigin = false;
        try {
            $photopath = $this->dataClass->writeFilePhoto($this->id, 0, $_REQUEST["sizeX"], $_REQUEST["sizeY"], $isOrigin);
        } catch (PpciException $pe) {
            $this->message->setSyslog($pe->getMessage());
        }
        $pn = explode("/", $photopath);
        $photoname = $pn[(count($pn) - 1)];
        isset($_REQUEST["disposition"]) ? $disposition = $_REQUEST["disposition"] : $disposition = "inline";
        $this->vue->setParam(array("disposition" => $disposition, "filename" => $photoname, "tmp_name" => $photopath));
        $this->vue->send();
    }
    function getThumbnail()
    {
        /*
         * Affiche le contenu de la vignette
         */
        try {
            $photoname = $this->dataClass->getPhotoName($this->id, 1);
        } catch (PpciException $pe) {
            $this->message->setSyslog($pe->getMessage());
        }
        $this->vue = service('BinaryView');
        $this->vue->setParam(array("disposition" => "inline", "filename" => $photoname, "tmp_name" => $this->appConfig->APP_temp . "/" . $photoname));
        return $this->vue->send();
    }
    function photoDisplay()
    {
        /*
         * Affiche a l'ecran la photo en pleine resolution
         */
        $this->vue = service('BinaryView');
        $this->dataClass->writeFilePhoto($this->id, 0, 0, 0, true);
        $this->vue->set($_SESSION["it_photo"]->setValue($this->id), "photo_id");
        $this->vue->set("gestion/photoDisplayPhoto.tpl", "corps");
        return $this->vue->send();
    }
}
