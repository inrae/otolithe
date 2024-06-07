<?php
include_once 'modules/classes/piecemetadata.class.php';
$dataClass = new Piecemetadata($bdd, $ObjetBDDParam);
$id = $_SESSION["it_piecemetadata"]->getValue($_REQUEST["piecemetadata_id"]);
$piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
switch ($t_module["param"]) {
    case "display":
        $data = dataRead($dataClass, $id, "gestion/piecemetadataDisplay.tpl", $piece_id);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $data = $_SESSION["it_piecemetadata"]->translateRow($data);
        $vue->set($data, "data");
        /** Recuperation des donnees des objets precedents */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dpiece = $piece->getDetail($piece_id);
        $vue->set($_SESSION["it_piece"]->translateRow($dpiece), "piece");
        /** Recuperation du modele de metadonnees */
        include_once 'modules/classes/metadatatype.class.php';
        $mt = new Metadatatype($bdd, $ObjetBDDParam);
        $vue->set($mt->lire($data["metadatatype_id"]),"metadatatype");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $vue->set($_SESSION["it_individu"]->translateRow($individu->getDetail($dpiece["individu_id"])), "individu");

        break;
    case "change":
        $data = dataRead($dataClass, $id, "gestion/piecemetadataChange.tpl", $piece_id);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $data = $_SESSION["it_piecemetadata"]->translateRow($data);
        $vue->set($data, "data");
        /** Recuperation des donnees des objets precedents */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dpiece = $piece->getDetail($piece_id);
        $vue->set($_SESSION["it_piece"]->translateRow($dpiece), "piece");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $vue->set($_SESSION["it_individu"]->translateRow($individu->getDetail($dpiece["individu_id"])), "individu");
        /** Liste des types de metadonnees disponibles */
        include_once 'modules/classes/metadatatype.class.php';
        $mdt = new Metadatatype($bdd, $ObjetBDDParam);
        $vue->set($mdt->getListe(), "metadatatypes");
        break;
    case "write":
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $_REQUEST["piecemetadata_id"] = $id;
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST["piecemetadata_id"] = $_SESSION["it_piecemetadata"]->setValue($id);
        }
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($_REQUEST["piece_id"]);
        break;
    case "delete":
        /*
         * delete record
         */
        dataDelete($dataClass, $id);
        break;
    case "import":
        /** Recuperation de la liste des champs disponibles */
        include_once 'modules/classes/metadatatype.class.php';
        $mdt = new Metadatatype($bdd, $ObjetBDDParam);
        $metadata = $mdt->lire($_REQUEST["metadatatype_id"]);
        $cm = json_decode($metadata["metadatatype_schema"], true);
        $colonnes = array();
        foreach ($cm as $row) {
            $colonnes[] = $row["name"];
        }
        if (file_exists($_FILES['upfile']['tmp_name'])) {
            require_once 'framework/import/import.class.php';
            try {
                $import = new Import($_FILES['upfile']['tmp_name'], $_REQUEST["separateur"], false, $colonnes);
                /** Preparation de l'enregistrement */
                $data = array();
                $data["piecemetadata_id"] = 0;
                $data["piece_id"] = $piece_id;
                $data["metadatatype_id"] = $_REQUEST["metadatatype_id"];
                $data["piecemetadata_date"] = $_REQUEST["piecemetadata_date"];
                $data["piecemetadata_comment"] = $_REQUEST["piecemetadata_comment"];
                $data["metadata"] = json_encode($import->getContentAsArray());
                $dataClass->ecrire($data);
                $message->set(_("Importation du jeu de métadonnées effectué"));
            } catch (Exception $e) {
                $message->set($e->getMessage(), true);
            }
        } else {
            $message->set(_("Impossible de charger le fichier à importer"));
        }
        $module_coderetour = 1;
        break;
    case "export":
        $data = $dataClass->lire($id);
        $vue->set(json_decode($data["metadata"], true));
        break;
}
?>