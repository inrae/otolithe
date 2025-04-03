<?php

namespace App\Libraries;

use App\Models\RemarkableType as ModelsRemarkableType;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class RemarkableType extends PpciLibrary
{
    function __construct()
    {
        parent::__construct();
        $this->dataclass = new ModelsRemarkableType();
        if (isset($_REQUEST["remarkable_type_id"])) {
            $this->id = $_REQUEST["remarkable_type_id"];
        }
    }

    function list()
    {
        /*
         * Display the list of all records of the table
         */
        $this->vue = service("Smarty");
        $this->vue->set($this->dataclass->getListe(1), "data");
        $this->vue->set("gestion/remarkabletypeList.tpl", "corps");
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
        $this->dataRead($this->id, "gestion/remarkabletypeChange.tpl");
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
