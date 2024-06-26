<?php

namespace App\Models;

use Ppci\Libraries\PpciException;
use Ppci\Models\PpciModel;

/**
 * Classe de gestion des photos
 * @author quinton
 *
 */
class Photo extends PpciModel
{

    public $format_thumbnail;

    public function __construct()
    {
        $this->table = "photo";
        $this->fields = array(
            "photo_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0,
            ),
            "piece_id" => array(
                "type" => 1,
                "requis" => 1,
                "parentAttrib" => 1,
            ),
            "photo_nom" => array(
                "type" => 0,
            ),
            "description" => array(
                "type" => 0,
            ),
            "photo_filename" => array(
                "type" => 0,
            ),
            "photo_date" => array(
                "type" => 2,
                "defaultValue" => "getDateJour",
            ),
            "color" => array(
                "type" => 2,
            ),
            "lumieretype_id" => array(
                "type" => 1,
                "defaultValue" => 2,
            ),
            "grossissement" => array(
                "type" => 1,
            ),
            "repere" => array(
                "type" => 1,
            ),
            "photo_data" => array(
                "type" => 0,
            ),
            "photo_thumbnail" => array(
                "type" => 0,
            ),
            "uri" => array(
                "type" => 0,
            ),
            "long_reference" => array(
                "type" => 0,
                "defaultValue" => 100,
            ),
            "photo_height" => array(
                "type" => 1,
            ),
            "photo_width" => array(
                "type" => 1,
            ),
            "long_ref_pixel" => array(
                "type" => 1,
            ),
        );
        $this->format_thumbnail = 200;
        parent::__construct();
    }

    public function write($data): int
    {
        /*
         * On recherche si une photo a ete telechargee
         */
        $flag_photo = 0;
        if (isset($data["photoload"])) {
            $dataPhoto = array();
            $flag_photo = 1;
            /*
             * Traitement de la photo
             */
            /*
             * Donnees "peripheriques"
             */
            if (strlen($data["photo_nom"]) == 0 && strlen($data["photo_filename"]) > 0) {
                $data["photo_nom"] = $data["photo_filename"];
            }
            /*
             * Gestion de l'extension du fichier
             * on force celle fournie dans le fichier telecharge
             */
            $filenameOri = explode(".", $data["photo_filename"]);
            $filenameCible = explode(".", $data["photo_nom"]);
            $nbsegmentOri = count($filenameOri);
            $nbsegmentCible = count($filenameCible);
            if ($filenameOri[$nbsegmentOri] != $filenameCible[$nbsegmentCible]) {
                $filenameCible[$nbsegmentCible] = $filenameOri[$nbsegmentOri];
                $data["photo_nom"] = "";
                for ($i = 0; $i < $nbsegmentCible; $i++) {
                    $data["photo_nom"] .= $filenameCible[$i];
                    if ($i < ($nbsegmentCible - 1)) {
                        $data["photo_nom"] .= ".";
                    }
                }
            }
            // pixel cache max size
            // IMagick::setResourceLimit(imagick::RESOURCETYPE_MEMORY, 33554432);
            // maximum amount of memory map to allocate for the pixel cache
            // IMagick::setResourceLimit(imagick::RESOURCETYPE_MAP, 33554432);
            $image = new \Imagick();
            try {
                $image->readImageBlob($data["photoload"]);
            } catch (\ImagickException $ie) {
                $message = _("Imagick - impossible de charger la photo ");
                $message .= $ie->getMessage();
                throw new PpciException($message);
            }
            $geo = $image->getimagegeometry();
            $data["photo_width"] = $geo["width"];
            $data["photo_height"] = $geo["height"];
            $dataPhoto["photo_data"] = pg_escape_bytea($data["photoload"]);
            unset($data["photoload"]);
            /*
             * Generation du thumbnail
             */
            try {
                $image->resizeImage($this->format_thumbnail, $this->format_thumbnail, \Imagick::FILTER_LANCZOS, 1, true);
            } catch (\ImagickException $ie) {
                $message = _("Imagick - impossible de redimensionner la photo");
                $message .= $ie->getMessage();
                throw new PpciException($message);
            }
            try {
                $image->setformat("jpeg");
            } catch (\ImagickException $ie) {
                $message = _("Imagick - impossible de définir le format de la photo");
                $message .= $ie->getMessage();
                throw new PpciException($message);
            }
            $dataPhoto["photo_thumbnail"] = pg_escape_bytea($this->db->connID, $image->getimageblob());
            /*
             * Suppression le cas echeant de la photo dans le dossier img
             */
            if ($data["photo_id"] > 0) {
                global $APPLI_photoStockage;
                try {
                    $dossier = opendir($APPLI_photoStockage);
                    while (false !== ($entry = readdir($dossier))) {
                        $racineFichier = "photo" . $data["photo_id"] . "-";
                        if (substr($entry, 0, strlen($racineFichier)) == $racineFichier) {
                            /*
                             * On supprime le fichier
                             */
                            unlink($APPLI_photoStockage . "/" . $entry);
                        }
                        /*
                         * Meme chose pour la miniature
                         */
                        $racineFichier = "thumbnail" . $data["photo_id"] . "-";
                        if (substr($entry, 0, strlen($racineFichier)) == $racineFichier) {
                            /*
                             * On supprime le fichier
                             */
                            unlink($APPLI_photoStockage . "/" . $entry);
                        }
                    }
                } catch (\Exception $e) {
                    $message = _("Problème rencontré lors du parcours des photos existantes ou de leur suppression");
                    $message .= $e->getMessage();
                    throw new PpciException($message);
                }
            }
        }
        $id = parent::write($data);
        if ($id > 0 && $flag_photo == 1) {
            /*
             * Ecriture de la photo en base
             */
            $sql = "update photo set photo_data = '" . $dataPhoto["photo_data"] . "', photo_thumbnail = '" . $dataPhoto["photo_thumbnail"] . "' where photo_id = :id:";
            $this->executeSQL($sql, ["id" => $id], true);
        }
        return $id;
    }
    /**
     * Suppression d'une photo et des lectures attachees
     *
     * @param int $id
     * @return void
     */
    function supprimer($id)
    {
        if (is_numeric($id) && $id > 0) {
            $photoLecture = new Photolecture($this->connection, $this->paramori);
            $photoLecture->supprimerChamp($id, "photo_id");
            parent::supprimer($id);
        } else {
            throw new PpciException(_("La suppression d'une clé nulle ou non numérique n'est pas possible"));
        }
    }

    /**
     * Retourne la liste des photos attachees a une piece
     *
     * @param int $piece_id
     * @return array
     */
    public function getListePhotoFromPiece($piece_id)
    {
        if ($piece_id > 0) {
            $sql = "select photo_id, piece_id, photo_nom, description, photo_date, color, photo_height, photo_width
                from photo where piece_id = :id:";
            return $this->getListParam($sql, ["id" => $piece_id]);
        } else {
            return [];
        }
    }

    /**
     * Retourne le nom de la photo
     *
     * @param int $id
     * @param number $thumbnail
     * @param number $sizeX
     * @param number $sizeY
     * @return string
     */
    public function getPhotoName($id, $thumbnail = 0, $sizeX = 0, $sizeY = 0, $is_origin = false)
    {
        $extension = "jpg";
        if ($thumbnail == 1) {
            $nomPhoto = "thumbnail";
        } else {
            $nomPhoto = "photo";
            if ($is_origin) {
                /*
                 * Recuperation de l'extension a partir du nom du fichier
                 */
                $sql = "select photo_filename from photo where photo_id = :photo_id:";

                $dphoto = $this->lireParamAsPrepared($sql, array(
                    "photo_id" => $id,
                ));
                $photoname = explode(".", $dphoto["photo_filename"]);
                $extension = $photoname[count($photoname) - 1];
            }
        }
        $nomPhoto .= $id . '-' . $sizeX . 'x' . $sizeY . "." . $extension;
        return $nomPhoto;
    }

    /**
     * Fonction permettant d'ecrire la photo dans un dossier temporaire, pour telechargement depuis le navigateur
     *
     * @param int $id
     * @param number $thumbnail
     * @param number $sizeX
     * @param number $sizeY
     * @param string $chemin
     * @return string
     */
    public function writeFilePhoto($id, $thumbnail = 0, $sizeX = 0, $sizeY = 0, $isOrigin = false)
    {
        if ($id > 0) {
            if ($thumbnail == 1) {
                $colonne = "photo_thumbnail";
            } else {
                $colonne = "photo_data";
            }
            $sql = "select $colonne as picture from photo where photo_id = :id:";
            $data = $this->readParam($sql, ["id" => $id]);
            if (empty($data)) {
                throw new PpciException(_("La photo demandée n'existe pas"));
            }
            $nomPhoto = $this->getPhotoName($id, $thumbnail, $sizeX, $sizeY, $isOrigin);
            /*
             * On recherche si la photo existe ou non
             */
            /**
             * @var App
             */
            $appParam = service("AppConfig");
            $path = $appParam->APP_temp . '/' . $nomPhoto;
            if (!file_exists($path) && !empty($data["picture"])) {
                /*
                 * On cree la photo
                 */
                $image = new \Imagick();
                try {
                    $image->readImageBlob(pg_unescape_bytea($data["picture"]));
                    if ($sizeX > 0 && $sizeY > 0) {
                        /*
                             * Mise a l'image de la photo
                             */
                        $geo = $image->getimagegeometry();
                        if ($geo["width"] > $sizeX || $geo["height"] > $sizeY) {
                            $image->resizeImage($sizeX, $sizeY, \Imagick::FILTER_LANCZOS, 1, true);
                        }
                        /*
                             * Transformation le cas echeant en jpeg
                             */
                        if (!$isOrigin) {
                            $image->setformat("JPEG");
                        }
                    }
                    /*
                         * Ecriture de la photo
                         */
                    $image->writeImage($path);
                } catch (\Exception $e) {
                    $message = _("Problème d'écriture de la photo dans le dossier temporaire");
                    $message .= $e->getMessage();
                    throw new PpciException($message);
                }
            }
            return $path;
        }
    }

    /**
     * Lit les informations generales d'une photo
     *
     * @param int $id
     * @return array
     */
    public function getDetail($id)
    {
        if ($id > 0) {
            $sql = "select photo_id, piece_id, photo_nom, description, photo_filename, photo_date, color,
                lumieretype_libelle, grossissement, repere, uri, long_reference, photo_width, photo_height, long_ref_pixel
                from photo
                left outer join lumieretype using(lumieretype_id)
                where photo_id = :id:";
            return $this->lireParam($sql, ["id" => $id]);
        } else {
            return [];
        }
    }
}
