<?php

namespace App\Libraries;

use App\Models\Espece;
use App\Models\Import as ModelsImport;
use App\Models\Individu;
use App\Models\Individu_experimentation;
use App\Models\Metadatatype;
use App\Models\Peche;
use App\Models\Piece;
use App\Models\Piecemetadata;
use App\Models\Piecetype;
use App\Models\Sexe;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Import extends PpciLibrary
{
    /**
     * Import massif d'echantillons ou de containers
     * et creation des mouvements afferents
     * Created : 18 août 2016
     * Creator : quinton
     * Encoding : UTF-8
     * Copyright 2016 - All rights reserved
     */

    protected ModelsImport $import;
    protected Piecetype $piecetype;
    protected Espece $espece;
    protected Individu $individu;
    protected Piece $piece;
    protected Peche $peche;
    protected Individu_experimentation $ie;
    protected Sexe $sexe;
    protected Piecemetadata $pm;
    protected Metadatatype $mt;

    function __construct()
    {
        parent::__construct();
        $this->import = new ModelsImport();
        $this->piecetype = new Piecetype();
        $this->espece = new Espece();
        $this->individu = new Individu();
        $this->piece = new Piece();
        $this->peche = new Peche();
        $this->ie = new Individu_experimentation();
        $this->sexe = new Sexe();
        $this->pm = new Piecemetadata();
        $this->mt = new Metadatatype();
        $this->import->initControl($_SESSION["experimentations"], $this->piecetype->getList(), $this->espece->getList(), $this->sexe->getListe(), $this->mt->getList());
    }

    function change()
    {
        /*
         * Affichage du masque de selection du fichier a importer
         */
        $this->vue = service("Smarty");
        $this->vue->set("gestion/import.tpl", "corps");
        $this->vue->set($_REQUEST["separator"], "separator");
        $this->vue->set($_REQUEST["utf8_encode"], "utf8_encode");
        return $this->vue->send();
    }

    function control()
    {
        $this->vue = service("Smarty");
        $this->vue->set("gestion/import.tpl", "corps");
        $this->vue->set($_REQUEST["separator"], "separator");
        $this->vue->set($_REQUEST["utf8_encode"], "utf8_encode");
        /*
         * Lancement des controles
         */
        unset($_SESSION["filename"]);
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            /*
             * Lancement du controle
             */
            try {
                $this->import->initFile($_FILES['upfile']['tmp_name'], $_REQUEST["separator"], $_REQUEST["utf8_encode"]);
                $resultat = $this->import->controlAll();
                if (count($resultat) > 0) {
                    /*
                     * Erreurs decouvertes
                     */
                    $this->vue->set(1, "erreur");
                    $this->vue->set($resultat, "erreurs");
                } else {
                    /*
                     * Deplacement du fichier dans le dossier temporaire
                     */

                    $filename = $this->appConfig->APP_temp . '/' . bin2hex(openssl_random_pseudo_bytes(4));
                    if (!copy($_FILES['upfile']['tmp_name'], $filename)) {
                        $this->message->set("Impossible de recopier le fichier importé dans le dossier temporaire", true);
                    } else {
                        $_SESSION["filename"] = $filename;
                        $_SESSION["separator"] = $_REQUEST["separator"];
                        $_SESSION["utf8_encode"] = $_REQUEST["utf8_encode"];
                        $this->vue->set(1, "controleOk");
                        $this->vue->set($_FILES['upfile']['name'], "filename");
                    }
                }
            } catch (PpciException $e) {
                $this->message->set($e->getMessage(), true);
            }
        }
        $this->import->fileClose();
        return $this->vue->send();
    }
    function import()
    {
        if (isset($_SESSION["filename"])) {
            if (file_exists($_SESSION["filename"])) {
                try {
                    $db = db_connect();
                    $db->transException(true)->transStart();
                    $this->import->initFile($_SESSION["filename"], $_SESSION["separator"], $_SESSION["utf8_encode"]);
                    $this->import->importAll();
                    $this->message->set("Import effectué. " . $this->import->nbTreated . " lignes traitées");
                    $this->message->set("Premier id généré : " . $this->import->minuid);
                    $this->message->set("Dernier id généré : " . $this->import->maxuid);
                    $this->log->setLog(
                        $_SESSION["login"],
                        "importImportResult",
                        $this->import->nbTreated . " records - min: " . $this->import->minuid . " max: " . $this->import->maxuid
                    );
                    $db->transComplete();
                    unset($_SESSION["filename"]);
                    return defaultPage();
                } catch (PpciException | DatabaseException $e) {
                    $this->message->set($e->getMessage(), true);
                    $this->message->setSyslog($e->getMessage());
                    unset($_SESSION["filename"]);
                    $this->log->setLog($_SESSION["login"], "importImportResult", "ko");
                    return $this->change();
                }
            }
        }
    }
}
