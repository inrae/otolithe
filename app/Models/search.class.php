<?php

/**
 * Classe de base pour gerer des parametres de recherche
 * Classe non instanciable, a heriter
 * L'instance doit etre conservee en variable de session
 * @author Eric Quinton
 *
 */
class SearchParam
{
	/**
	 * Tableau des parametres geres par la classe
	 * La liste des parametres doit etre declaree dans la fonction construct
	 * @var array
	 */
	public $param;
	/**
	 * Indique si la lecture des parametres a ete realisee au moins une fois
	 * Permet ainsi de declencher ou non la recherche
	 * @var int
	 */
	public $isSearch;
	/**
	 * Constructeur de la classe
	 * A rappeler systematiquement pour initialiser isSearch
	 */
	function __construct()
	{
		if (!is_array($this->param)) {
			$this->param = array();
		}
		$this->isSearch = 0;
	}
	/**
	 * Stocke les parametres fournis
	 * @param array $data
	 */
	function setParam($data)
	{
		foreach ($this->param as $key => $value) {
			/*
			 * Recherche si une valeur de $data correspond a un parametre
			 */
			if (isset($data[$key])) {
				$this->param[$key] = $data[$key];
			}
		}
		/*
		 * Gestion de l'indicateur de recherche
		 */
		if ($data["isSearch"] == 1) {
			$this->isSearch = 1;
		}
	}
	/**
	 * Retourne les parametres existants
	 */
	function getParam($name = null)
	{
		if ($name) {
			return $this->param[$name];
		} else {
			return $this->param;
		}

	}
	/**
	 * Indique si la recherche a ete deja lancee
	 * @return int
	 */
	function isSearch()
	{
		if ($this->isSearch == 1) {
			return 1;
		} else {
			return 0;
		}
	}
}
/**
 * Classe de gestion des parametres de recherche des poissons
 * @author Eric Quinton
 *
 */
class SearchIndividu extends SearchParam
{
	function __construct()
	{
		$this->param = array("codeindividu" => "", "exp_id" => "", "sexe" => "", "site" => "", "zone" => "", "isNotRead" => 0, "lecteur_id"=>0, "espece_id"=>0);
		parent::__construct();
	}
}
/**
 * Classe de recherche des lectures de pieces
 * @author quinton
 *
 */
class SearchLecture extends SearchParam
{
	function __construct()
	{
		$this->param = array("codeindividu" => "", "exp_id" => "", "site" => "", "zonesite" => "", "lecteur_id" => 0, "consensual"=>0, "espece_id"=>0);
		parent::__construct();
	}
}
