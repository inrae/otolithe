<?php

namespace App\Libraries;

use App\Models\Piecetype as ModelsPiecetype;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Piecetype extends PpciLibrary
{
    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsPiecetype();
        if (isset($_REQUEST["piecetype_id"])) {
            $this->id = $_REQUEST["piecetype_id"];
        }
    }

    function list()
    {
        /*
		 * Display the list of all records of the table
		 */
        $this->vue = service("Smarty");
        $this->vue->set($this->dataClass->getListe(1), "data");
        $this->vue->set("gestion/piecetypeList.tpl", "corps");
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
        $this->dataRead($this->id, "gestion/piecetypeChange.tpl");
        return $this->vue->send();
    }
    function write()
    {
        /*
		 * write record in database
		 */
        try {
            $this->dataWrite($_REQUEST);
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
}
