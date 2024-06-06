<?php
namespace App\Models;

use Ppci\Models\PpciModel;
/**
 * Table de reference des types de lumiere
 *
 * @author quinton
 *
 */
class LumiereType extends PpciModel
{

    public function __construct()
    {
                $this->table = "lumieretype";
        $this->id_auto = "0";
        $this->fields = array(
            "lumieretype_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0,
            ),
            "lumieretype_libelle" => array(
                "type" => 0,
                "requis" => 1,
                "longueur" => 255,
            ),
        );
                parent::__construct();
    }
}
