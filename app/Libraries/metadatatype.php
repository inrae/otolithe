<?php

/**
 * Created : 8 sept. 2016
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2016 - All rights reserved
 */
require_once 'modules/classes/metadatatype.class.php';
$dataClass = new Metadatatype($bdd, $ObjetBDDParam);
$keyName = "metadatatype_id";
$id = $_REQUEST[$keyName];

switch ($t_module["param"]) {
    case "list":
        /*
         * Display the list of all records of the table
         */
        try {
            $vue->set($dataClass->getListe(2), "data");
            $vue->set("param/metadatatypeList.tpl", "corps");
        } catch (Exception $e) {
            $message->set($e->getMessage());
        }
        break;
    case "change":
        /*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        dataRead($dataClass, $id, "param/metadatatypeChange.tpl");
        break;
    case "write":
        /*
         * write record in database
         */
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST[$keyName] = $id;
        }
        break;
    case "delete":
        /*
         * delete record
         */
        dataDelete($dataClass, $id);
        break;
    case "copy":
        /*
         * Duplication d'un modele
         */
        $data = $dataClass->lire($id);
        $data["metadatatype_id"] = 0;
        $data["metadatatype_name"] .= " - new version";
        $vue->set($data, "data");
        $vue->set("param/metadatatypeChange.tpl", "corps");
        break;
    case "getSchema":
        $data = $dataClass->lire($id);
        $vue->setJson($data["metadatatype_schema"]);
        break;
    case "isArray":
        $data = $dataClass->lire($id);
        $vue->setJson($data["is_array"]);
        break;
    case "export":
        $vue->set($dataClass->getListFromIds($_POST["metadatatype_id"]));
        break;
    case "import":
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            require_once 'framework/import/import.class.php';
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
                    $dataClass->ecrire($data);
                    $i++;
                }
                $message->set(sprintf(_("%s description(s) de métadonnée(s) importée(s)"), $i));
                $module_coderetour = 1;
            } catch (Exception $e) {
                $message->set(_("Impossible d'importer les métadonnées"));
                $message->set($e->getMessage());
                $module_coderetour = -1;
            }
        } else {
            $message->set(_("Impossible de charger le fichier à importer"));
            $module_coderetour = -1;
        }
        break;
}
?>