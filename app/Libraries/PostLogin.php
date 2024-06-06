<?php
namespace App\Libraries;
use Ppci\Libraries\PpciLibrary;
class PostLogin extends PpciLibrary {
    static function index() {
    }
    
    function temp () {
		
		$lecteur = new Lecteur($bdd, $ObjetBDDParam);
$lecteur_id = $lecteur->getIdFromLogin($_SESSION['login']);
if ($lecteur_id > 0) {
    $_SESSION["droits"]["lecture"] = 1;
    $_SESSION["droits"]["consult"] = 1;
    $_SESSION["lecteur_id"] = $lecteur_id;
    $_SESSION["searchIndividu"]->setParam(array("lecteur_id" => $lecteur_id));
    $_SESSION["searchLecture"]->setParam(array("lecteur_id" => $lecteur_id));
    //$vue->set($_SESSION["droits"], "droits");

    /*
     * Recuperation des experimentations autorisees
     */
    include_once 'modules/classes/experimentation.class.php';
    $experimentation = new Experimentation($bdd, $ObjetBDDParam);
    $_SESSION["experimentations"] = $experimentation->getExpAutorisees($lecteur_id);
}
}
}
