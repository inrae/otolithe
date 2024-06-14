<?php

namespace App\Libraries;

use App\Models\Experimentation;
use App\Models\Lecteur;
use Ppci\Libraries\PpciLibrary;

class PostLogin extends PpciLibrary
{
    static function index()
    {
        $lecteur = new Lecteur();
        $lecteur_id = $lecteur->getIdFromLogin($_SESSION['login']);
        if ($lecteur_id > 0) {
            $_SESSION["userRights"]["read"] = 1;
            $_SESSION["userRights"]["consult"] = 1;
            $_SESSION["lecteur_id"] = $lecteur_id;
            $_SESSION["searchIndividu"]->setParam(array("lecteur_id" => $lecteur_id));
            $_SESSION["searchLecture"]->setParam(array("lecteur_id" => $lecteur_id));
            $experimentation = new Experimentation();
            $_SESSION["experimentations"] = $experimentation->getExpAutorisees($lecteur_id);
        }
    }
}
