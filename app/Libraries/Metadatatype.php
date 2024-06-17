<?php

namespace App\Libraries;

use App\Models\Metadatatype as ModelsMetadatatype;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;
use Ppci\Models\Import;

class Metadatatype extends PpciLibrary
{
    protected array $ids;
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsMetadatatype();
        $keyName = "metadatatype_id";
        if (isset($_REQUEST[$keyName])) {
            if (is_array($_REQUEST[$keyName])) {
                $this->ids = $_REQUEST[$keyName];
            } else {
                $this->id = $_REQUEST[$keyName];
            }
        }
    }

    function list()
    {
        /*
         * Display the list of all records of the table
         */
        $this->vue = service("Smarty");
        $this->vue->set($this->dataClass->getListe(2), "data");
        $this->vue->set("param/metadatatypeList.tpl", "corps");
        return $this->vue->send();
    }

    function change()
    {
        /*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        $this->vue = service("Smarty");
        $this->dataRead($this->id, "param/metadatatypeChange.tpl");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        try {
            $this->id = $this->dataWrite($_REQUEST);
            $_REQUEST["metadatatype_id"] = $this->id;
            return $this->list();
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
        } catch (PpciException) {
            return $this->change();
        }
    }
    function copy()
    {
        /*
         * Duplication d'un modele
         */
        $this->vue = service("Smarty");
        $data = $this->dataClass->lire($this->id);
        $data["metadatatype_id"] = 0;
        $data["metadatatype_name"] .= " - new version";
        $this->vue->set($data, "data");
        $this->vue->set("param/metadatatypeChange.tpl", "corps");
        return $this->vue->send();
    }
    function getSchema()
    {
        $this->vue = service("AjaxView");
        $data = $this->dataClass->lire($this->id);
        $this->vue->setJson($data["metadatatype_schema"]);
        return $this->vue->send();
    }
    function isArray()
    {
        $this->vue = service("AjaxView");
        $data = $this->dataClass->lire($this->id);
        $this->vue->setJson($data["is_array"]);
    }
    function export()
    {
        $this->vue = service("CsvView");
        $this->vue->set($this->dataClass->getListFromIds($this->ids));
        return $this->vue->send();
    }
    function import()
    {
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            try {
                $import = new Import($_FILES['upfile']['tmp_name'], ";", false, array(
                    "metadatatype_name",
                    "metadatatype_schema",
                    "metadatatype_id",
                    "metadatatype_comment",
                    "is_array"
                ));
                $rows = $import->getContentAsArray();
                $i = 0;
                foreach ($rows as $row) {
                    $data = array(
                        "metadatatype_name" => $row["metadatatype_name"],
                        "metadatatype_schema" => $row["metadatatype_schema"],
                        "metadatatype_id" => 0,
                        "is_array" => $row["is_array"],
                        "metadatatype_comment" => $row["metadatatype_comment"]
                    );
                    $this->dataClass->ecrire($data);
                    $i++;
                }
                $this->message->set(sprintf(_("%s description(s) de métadonnée(s) importée(s)"), $i));
                return $this->list();
            } catch (PpciException $e) {
                $this->message->set(_("Impossible d'importer les métadonnées"));
                $this->message->set($e->getMessage());
                return $this->list();
            }
        } else {
            $this->message->set(_("Impossible de charger le fichier à importer"));
            return $this->list();
        }
    }
}
