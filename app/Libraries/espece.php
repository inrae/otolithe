<?php

/**
 * @author Eric Quinton
 * @copyright Copyright (c) 2015, IRSTEA / Eric Quinton
 * @license http://www.cecill.info/licences/Licence_CeCILL-C_V1-fr.html LICENCE DE LOGICIEL LIBRE CeCILL-C
 *  Creation 12 juin 2015
 */
include_once 'modules/classes/espece.class.php';
$dataClass = new Espece($bdd, $ObjetBDDParam);
$id = $_REQUEST["espece_id"];

switch ($t_module["param"]) {
	case "searchAjax":
		if (strlen($_REQUEST["libelle"]) > 2) {
			$vue->set($dataClass->getEspeceJSON($_REQUEST["libelle"]));
		}
		break;
	case "list":
		/*
		 * Display the list of all records of the table
		 */
		$vue->set($dataClass->getListe(), "data");
		$vue->set("gestion/especeList.tpl", "corps");
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		dataRead($dataClass, $id, "gestion/especeChange.tpl");
		break;
	case "write":
		/*
		 * write record in database
		 */
		dataWrite($dataClass, $_REQUEST);
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete($dataClass, $id);
		break;
}

?>