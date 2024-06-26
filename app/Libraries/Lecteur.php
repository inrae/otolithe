<?php

namespace App\Libraries;

use App\Models\Experimentation;
use App\Models\Lecteur as ModelsLecteur;
use Ppci\Libraries\PpciException;
use ppci\Libraries\PpciLibrary;
use Ppci\Models\PpciModel;

class Lecteur extends PpciLibrary
{
    /**
     * 
     *
     * @var ModelsLecteur
     */
    protected PpciModel $dataClass;

    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsLecteur();
        $keyName = "lecteur_id";
        if (isset($_REQUEST[$keyName])) {
            $this->id = $_REQUEST[$keyName];
        }
    }



    function list()
    {
        /*
         * Display the list of all records of the table
         */
        $this->vue = service ('Smarty');
        $this->vue->set($this->dataClass->getListe(), "data");
        $this->vue->set("gestion/lecteurListe.tpl", "corps");
        return $this->vue->send();
    }
    function change()
    {
        $this->dataRead($this->id, "gestion/lecteurChange.tpl");
        $experimentation = new Experimentation();
        $this->vue->set($experimentation->getAllListFromLecteur($this->id), "exps");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        try {
            $this->id = $this->dataWrite($_REQUEST);
            if ($this->id > 0) {
                $_REQUEST["lecteur_id"] = $this->id;
                if ($this->id == $this->dataClass->getIdFromLogin($_SESSION["login"])) {
                    /*
                 * Rechargement des droits
                 */
                    $experimentation = new Experimentation();
                    $_SESSION["experimentations"] = $experimentation->getExpAutorisees($this->id);
                }
            }
            return $this->list();
        } catch (PpciException $e) {
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
        } catch (PpciException $e) {
            return $this->change();
        }
    }
    function listFromExp()
    {
        $this->vue = service('AjaxView');
        $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
        $this->vue->set($this->dataClass->getListFromExp($exp_id));
        return $this->vue->send();
    }
}
