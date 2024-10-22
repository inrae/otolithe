<?php

namespace App\Libraries;

use App\Models\Espece as ModelsEspece;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Espece extends PpciLibrary
{
    /**
     * @var ModelsEspece
     */
    
    function __construct()
    {
        parent::__construct();
        $this->dataclass = new ModelsEspece();
        $keyName = "espece_id";
        if (isset($_REQUEST[$keyName])) {
            $this->id = $_REQUEST[$keyName];
        }
    }

    function searchAjax()
    {
        $this->vue = service('AjaxView');
        if (strlen($_REQUEST["libelle"]) > 2) {
            $this->vue->set($this->dataclass->getEspeceJSON($_REQUEST["libelle"]));
            return $this->vue->send();
        }
    }
    function list()
    {
        /*
         * Display the list of all records of the table
         */
        $this->vue = service('Smarty');
        $this->vue->set($this->dataclass->getListe(), "data");
        $this->vue->set("gestion/especeList.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        /*
         * open the form to modify the record
         * If is a new record, generate a new record with default value :
         * $_REQUEST["idParent"] contains the identifiant of the parent record
         */
        $this->dataRead($this->id, "gestion/especeChange.tpl");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        $this->dataWrite($_REQUEST);
        return $this->list();
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
