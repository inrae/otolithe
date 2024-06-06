<?php
class Final_stripe extends ObjetBDD
{

  public function __construct($bdd, $param = array())
  {
    $this->param = $param;
    $this->table = "final_stripe";
    $this->id_auto = "1";
    $this->colonnes = array(
      "final_stripe_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1,
        "defaultValue" => 0,
      ),
      "final_stripe_code" => array(
        "type" => 0,
        "requis" => 1,
      ),
      "final_stripe_libelle" => array(
        "type" => 0,
        "requis" => 1,
      ),
    );
    $param["fullDescription"] = 1;
    parent::__construct($bdd, $param);
  }
}
