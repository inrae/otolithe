<?php

namespace App\Libraries;

use App\Models\Experimentation as ModelsExperimentation;
use App\Models\Lecteur;
use Ppci\Libraries\PpciException;
use Ppci\Libraries\PpciLibrary;

class Experimentation extends PpciLibrary
{
    /**
     * @var ModelsExperimentation
     */
    protected $dataclass;

    function __construct()
    {
        parent::__construct();
        $this->dataClass = new ModelsExperimentation();
        $keyName = "exp_id";
        if (isset($_REQUEST[$keyName])) {
            $this->id = $_REQUEST[$keyName];
        }
    }

    function list()
    {
        $this->vue = service('Smarty');
        /*
         * Display the list of all records of the table
         */
        $this->vue->set($this->dataClass->getListe(), "data");
        $this->vue->set("gestion/experimentationList.tpl", "corps");
        return $this->vue->send();
    }

    function change()
    {
        $this->vue = service('Smarty');
        $this->dataRead($this->id, "gestion/experimentationChange.tpl");
        $this->vue->set($this->dataClass->getReaders($this->id), "lecteurs");
        return $this->vue->send();
    }
    function write()
    {
        /*
         * write record in database
         */
        try {
            $this->dataWrite($_REQUEST);
            /*
             * Rechargement des experimentations autorisees pour l'operateur apres modification
             */
            $lecteur = new Lecteur();
            $lecteur_id = $lecteur->getIdFromLogin($_SESSION['login']);
            if ($lecteur_id > 0) {
                $experimentation = new ModelsExperimentation();
                $_SESSION["experimentations"] = $experimentation->getExpAutorisees($lecteur_id);
            }
            return $this->list();
        } catch (\Exception $e) {
            $this->message->set($e->getMessage(), true);
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
