<?php
include_once 'modules/classes/photo.class.php';
$dataClass = new Photo($bdd, $ObjetBDDParam);
$id = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
switch ($t_module["param"]) {

    case "display":
		/*
         * Display the detail of the record
         */
        $data = $dataClass->getDetail($id);
        $dataT = $_SESSION["it_photo"]->translateRow($data);
        $dataT = $_SESSION["it_piece"]->translateRow($dataT);
        /*
         * Lecture des informations concernant la piece
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dataPiece = $piece->getDetail($data["piece_id"]);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $vue->set($dataPieceT, "piece");

        /*
         * Lecture des informations concernant le poisson
         */
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $vue->set($dataIndiv, "individu");

        /*
         * Recuperation de la liste des lectures effectuees
         */
        include_once "modules/classes/photolecture.class.php";
        $photolecture = new Photolecture($bdd, $ObjetBDDParam);
        $dataLecture = $photolecture->getListeFromPhoto($id);
        $dataLecture = $_SESSION["it_photolecture"]->translateList($dataLecture);
        $dataLecture = $_SESSION["it_piece"]->translateList($dataLecture);
        $vue->set($dataLecture, "photolecture");

        /*
         * Recuperation de la demande d'affichage de l'age
         */
        $vue->set($_REQUEST["ageDisplay"], "ageDisplay");

        /*
         * Preparation de l'affichage de la miniature
         */
        $vue->set($dataClass->writeFilePhoto($id, 1), "photoPath");
        $vue->set($dataT, "data");
        $vue->set("gestion/photoDisplay.tpl", "corps");
        break;
    case "change":
		/*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
		/*
         * Recuperation des informations sur la piece et le poisson
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $dataPiece = $piece->getDetail($piece_id);
        $dataPieceT = $_SESSION["it_piece"]->translateRow($dataPiece);
        $dataPieceT = $_SESSION["it_individu"]->translateRow($dataPieceT);
        $vue->set($dataPiece, "piece");

        /*
         * Lecture des informations concernant le poisson
         */
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $dataIndiv = $individu->getDetail($dataPiece["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $vue->set($dataIndiv, "individu");

        /*
         * Lecture des types de lumiere
         */
        include_once "modules/classes/lumieretype.class.php";
        $lumieretype = new LumiereType($bdd, $ObjetBDDParam);
        $vue->set($lumieretype->getListe(), "lumieretype");
        $data = dataRead($dataClass, $id, "gestion/photoChange.tpl", $piece_id);
        $data = $_SESSION["it_photo"]->translateRow($data);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $vue->set($data, "data");
        /*
         * taille maximale de telechargement d'une photo
         */
        $vue->set($APPLI_maxfilesize, "maxfilesize");
        break;
    case "write":
		/*
         * write record in database
         */
        /*
         * Recherche des erreurs de telechargement
         */
        if (isset($_FILES["photoload"]["error"]) && $_FILES["photoload"]["error"] != UPLOAD_ERR_OK) {
            switch ($_FILES["photoload"]["error"]) {
                case (UPLOAD_ERR_INI_SIZE or UPLOAD_ERR_FORM_SIZE):
                    $message->set(_("La taille de la photo excède la taille autorisée"),true);
                    break;
                case UPLOAD_ERR_NO_FILE:
                /*
                     * No action
                     */
                    break;
                default:
                    $message->set(_("Une erreur s'est produite lors du chargement de la photo. Si le problème persiste, contactez votre support technique"), true);
            }
        }

		/*
         * On recherche si une photo a ete telechargee
         */
        if ($_FILES["photoload"]["size"] > 10) {
            /*
             * Recherche antivirale
             */
            $virus = false;
            if (extension_loaded('clamav') && $APPLI_virusscan) {
                $retcode = cl_scanfile($_FILES["photoload"]["tmp_name"], $virusname);
                if ($retcode == CL_VIRUS) {
                    $virus = true;
                    $texte_erreur = $file["name"] . " : " . cl_pretcode($retcode) . ". Virus found name : " . $virusname;
                    $message->set($texte_erreur, true);
                    $log->setLog($_SESSION["login"], "Document-ecrire", $texte_erreur);
                }
            }
            if (!$virus) {

                $_REQUEST["photoload"] = fread(fopen($_FILES["photoload"]["tmp_name"], "r"), $_FILES["photoload"]["size"]);
                $_REQUEST["photo_filename"] = $_FILES["photoload"]["name"];
            }
        }
        $_REQUEST["photo_id"] = $_SESSION["it_photo"]->getValue($_REQUEST["photo_id"]);
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST["photo_id"] = $_SESSION["it_photo"]->setValue($id);
        }
        break;
    case "delete":
		/*
         * delete record
         */
        dataDelete($dataClass, $id);
        break;
    case "getPhoto":
		/*
         * Affiche le contenu d'une photo
         */
        if (!isset($_REQUEST["sizeX"])) {
            $_REQUEST["sizeX"] = 0;
        }
        if (!isset($_REQUEST["sizeY"])) {
            $_REQUEST["sizeY"] = 0;
        }
        $_REQUEST["original_format"] == 1 ? $isOrigin = true : $isOrigin = false;
        try {
            $photopath = $dataClass->writeFilePhoto($id, 0, $_REQUEST["sizeX"], $_REQUEST["sizeY"], $isOrigin);
        } catch (PhotoException $pe) {
            $message->setSyslog($pe->getMessage());
        }
        $pn = explode("/", $photopath);
        $pnn = count($pn);
        $photoname = $pn[(count($pn)-1)];
        isset($_REQUEST["disposition"]) ? $disposition = $_REQUEST["disposition"] : $disposition = "inline";
        $vue->setParam(array("disposition" => $disposition, "filename" => $photoname, "tmp_name" => $photopath));
        break;
    case "getThumbnail":
		/*
         * Affiche le contenu de la vignette
         */
        try {
            $photoname = $dataClass->getPhotoName($id, 1);
        } catch (PhotoException $pe) {
            $message->setSyslog($pe->getMessage());
        }
        $vue->setParam(array("disposition" => "inline", "filename" => $dataClass->getPhotoName($id, 1), "tmp_name" => $APPLI_photoStockage . "/" . $photoname));
        break;
    case "photoDisplay":
		/*
         * Affiche a l'ecran la photo en pleine resolution
         */
        $dataClass->writeFilePhoto($id, 0, 0, 0, true);
        $vue->set($_SESSION["it_photo"]->setValue($id), "photo_id");
        $vue->set("gestion/photoDisplayPhoto.tpl", "corps");
        break;
}
