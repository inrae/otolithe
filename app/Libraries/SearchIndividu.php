<?php
namespace App\Libraries;

class SearchIndividu extends SearchParam
{
	function __construct()
	{
		$this->param = array("codeindividu" => "", "exp_id" => "", "sexe" => "", "site" => "", "zone" => "", "isNotRead" => 0, "lecteur_id"=>0, "espece_id"=>0);
		parent::__construct();
	}
}