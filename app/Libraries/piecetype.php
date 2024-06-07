<?php
/**
 * Created : 15 févr. 2017
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2017 - All rights reserved
 */
require_once 'modules/classes/piecetype.class.php';
$dataClass = new Piecetype($bdd, $ObjetBDDParam);
$id = $_REQUEST["piecetype_id"];

switch ($t_module["param"]) {
    case "list":
		/*
		 * Display the list of all records of the table
		 */
	    $vue->set($dataClass->getListe(1), "data");
        $vue->set("gestion/piecetypeList.tpl", "corps");

        break;

    case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		dataRead($dataClass, $id, "gestion/piecetypeChange.tpl");
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
