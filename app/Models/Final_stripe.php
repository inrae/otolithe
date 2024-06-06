<?php

namespace App\Models;

use Ppci\Models\PpciModel;

class Final_stripe extends PpciModel
{

  public function __construct()
  {
    $this->table = "final_stripe";
    $this->fields = array(
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
    parent::__construct();
  }
}
