<?php

/**
 * Classe permettant de parametrer les imports
 * @author quinton
 *
 */
class ImportDataFile
{
	public $nomFichierDesc;
	public $contenuFichier;
	public $descriptionImport;
	public $handle;
	public $separateur;
	public $ligneDebut;
	public $typeFichier;
	public $spreadsheet;
	public $utf8encode;
	/*
	 * Variables utilisees pour l'export CSV
	 */
	public $fichierExport;
	public $nomFichierExport;
	public $separateurExport;
	/**
	 * caractere entourant les champs importes
	 * vaut q pour ', d pour ", vide pour vide...
	 *
	 * @var string
	 */
	public $enclosure;
	/*
	 * Variables utilisees pour le traitement d'un fichier XLS
	 */
	public $nbRows;
	public $nbCols;
	public $currentRow;

	/**
	 * Lecture des parametres d'import a partir d'un fichier ini
	 * Le fichier ini doit contenir une section par type d'import
	 * Il doit etre construit ainsi :
	 * [nomimport]
	 * ligneDebut=2 ; l'import commence a la ligne 2
	 * separateur=,|;|tab|virgule|point-virgule ; separateur de colonne
	 * typeFichier=csv|xls
	 * utf8encode=0|1 ; encodage des chaines au format utf8
	 * 0=nom du champ en premiere position
	 * 1= nom du champ en seconde position
	 * 2= ...
	 *
	 * @param string $nomFichierDesc        	
	 * @param string $nomImport        	
	 */
	function initViaIniFile($nomFichierDesc, $nomImport)
	{
		$this->nomFichierDesc = $nomFichierDesc;
		$this->ligneDebut = 1;
		$this->contenuFichier = parse_ini_file($this->nomFichierDesc, true);
		$this->descriptionImport = $this->contenuFichier[$nomImport];

		if (isset($this->descriptionImport["ligneDebut"])) {
			$this->ligneDebut = $this->descriptionImport["ligneDebut"];
			unset($this->descriptionImport["ligneDebut"]);
		}
		if (isset($this->descriptionImport["separateur"])) {
			$this->separateur = $this->descriptionImport["separateur"];
			unset($this->descriptionImport["separateur"]);
		}
		if (isset($this->descriptionImport["enclosure"])) {
			$this->separateur = $this->descriptionImport["enclosure"];
			unset($this->descriptionImport["enclosure"]);
		}
		if (isset($this->descriptionImport["typeFichier"])) {
			$this->typeFichier = $this->descriptionImport["typeFichier"];
			unset($this->descriptionImport["typeFichier"]);
		}
		if (isset($this->descriptionImport["utf8encode"])) {
			$this->utf8encode = $this->descriptionImport["utf8encode"];
			unset($this->descriptionImport["utf8encode"]);
		}
		/*
		 * Reformatage du separateur
		 */
		$this->reformatSeparateur($this->separateur);
		/*
		 * Reformatage de l'enclosure
		 */
		$this->reformatEnclosure($this->enclosure);
		/*
		 * Gestion de la classe de manipulation XLS
		 */
/* 		if ($this->typeFichier == "xls") {
			if (class_exists ( "Spreadsheet_Excel_Reader" )) {
				$this->spreadsheet = new Spreadsheet_Excel_Reader ();
			} else {
				echo "La classe Spreadsheet_Excel_Reader n'est pas decrite - arret de l'application";
				die ();
			}
		} */
	}
	/**
	 * Fonction d'initialisation de l'import via un tableau
	 * N'est utilisable que si le fichier a importer contient, dans la premiere ligne a lire, la liste exacte
	 * des champs correspondants dans la base de donnees
	 * Les informations a indiquer sont les suivantes :
	 * $descriptionImport["ligneDebut"]=1 ; Numero de la ligne contenant les entetes des colonnes
	 * $descriptionImport["separateur"]=,|;|tab|virgule|point-virgule ; separateur de colonne
	 * $descriptionImport["typeFichier"]=csv|xls
	 * $descriptionImport["utf8encode"]=0|1 ; encodage des chaines au format utf8
	 *
	 * @param array $descriptionImport        	
	 */
	function initViaArray($descriptionImport)
	{
		if (isset($descriptionImport["ligneDebut"])) {
			$this->ligneDebut = $descriptionImport["ligneDebut"];
		}
		if (isset($descriptionImport["separateur"])) {
			$this->separateur = $descriptionImport["separateur"];
		}
		if (isset($descriptionImport["typeFichier"])) {
			$this->typeFichier = $descriptionImport["typeFichier"];
		}
		if (isset($descriptionImport["utf8encode"])) {
			$this->utf8encode = $descriptionImport["utf8encode"];
		}
		if (isset($descriptionImport["enclosure"]))
			$this->enclosure = $descriptionImport["enclosure"];
			/*
		 * Reformatage du separateur
		 */
		$this->reformatSeparateur($this->separateur);
		/*
		 * Reformatage de l'enclosure
		 */
		$this->reformatEnclosure($this->enclosure);
		/*
		 * Gestion de la classe de manipulation XLS
		 */
		if ($this->typeFichier == "xls") {
// 			if (class_exists ( "Spreadsheet_Excel_Reader" )) {
// 				$this->spreadsheet = new Spreadsheet_Excel_Reader ();
// 			} else {
// 				echo "La classe Spreadsheet_Excel_Reader n'est pas decrite - arret de l'application";
// 				die ();
// 			}
		}
	}
	/**
	 * Reformate le separateur pour utilisation "facile"
	 *
	 * @param string $separateur        	
	 */
	function reformatSeparateur($separateur)
	{
		if ($separateur == "tab") {
			$separateur = "\t";
		} elseif ($separateur == "virgule") {
			$separateur = ",";
		} elseif ($separateur == "point-virgule") {
			$separateur = ";";
		}
		$this->separateur = $separateur;
	}
	/**
	 * Reformate de caractere entourant les champs
	 *
	 * @param string $enclosure        	
	 */
	function reformatEnclosure($enclosure)
	{
		if ($enclosure == "q") {
			$this->enclosure = "'";
		} elseif ($enclosure == "d") {
			$this->enclosure = '"';
		} else {
			$this->enclosure = "";
		}
	}
	/**
	 * Retourne le contenu des champs decrits dans le fichier
	 *
	 * @param string $nomImport        	
	 * @return array
	 */
	function getListeColonne()
	{
		return $this->descriptionImport;
	}
	/**
	 * Ouvre le fichier specifie
	 *
	 * @param array $nomFichier        	
	 * @param string $separateur        	
	 */
	function ouvrirFichier($nomFichier)
	{
		if ($this->typeFichier == "csv") {
			$this->handle = fopen($nomFichier, 'r');
			$this->currentRow = 1;
			if ($this->handle) {
				return true;
			} else {
				return false;
			}
		} elseif ($this->typeFichier == "xls") {
			$this->spreadsheet->read($nomFichier, 'r');
			$this->nbCols = $this->spreadsheet->sheets[0]['numCols'];
			$this->nbRows = $this->spreadsheet->sheets[0]['numRows'];
			$this->currentRow = $this->ligneDebut;
			if ($this->nbRows > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
	/**
	 * Ferme le fichier
	 */
	function fermerFichier()
	{
		if ($this->handle) {
			fclose($this->handle);
		}
	}

	/**
	 * Retourne la premiere ligne a partir de laquelle le traitement doit etre realise
	 *
	 * @return int
	 */
	function getLigneDebut()
	{
		return $this->ligneDebut;
	}

	/**
	 * Retourne le contenu de la ligne courante
	 *
	 * @return <array, boolean>
	 */
	function getLigneCourante()
	{
		if ($this->typeFichier == "csv") {
			$data = $this->getDataCsv();
		} elseif ($this->typeFichier == "xls") {
			$data = $this->getDataXls();
		}
		if ($this->utf8encode == 1) {
			/*
			 * Encodage en utf8 des donnees textes
			 */
			foreach ($data as $key => $value) {
				if (is_string($value)) {
					$data[$key] = utf8_encode($value);
				}
			}
		}
		return $data;
	}

	/**
	 * Retourne le contenu de la ligne courante, dans le cas d'un fichier xls
	 *
	 * @return array, boolean
	 */
	function getDataXls()
	{
		if ($this->currentRow < $this->nbRows) {
			$data = array();
			for ($i = 0; $i <= $this->nbCols; $i++) {
				$data[$i] = $this->spreadsheet->sheets[0]['cells'][$this->currentRow][$i + 1];
			}
			$this->currentRow++;
			return $data;
		} else {
			return false;
		}
	}
	/**
	 * Recupere les donnees au format CSV pour l'enregistrement courant
	 */
	function getDataCsv()
	{
		if ($this->handle) {
			/*
			 * Lecture "a vide" des premieres lignes du fichier
			 */
			$j = $this->currentRow;
			for ($i = $j; $i < $this->ligneDebut; $i++) {
				if (strlen($this->enclosure) == 1) {
					$data = fgetcsv($this->handle, 1000, $this->separateur, $this->enclosure);
				} else {
					$data = fgetcsv($this->handle, 1000, $this->separateur);
				}
			}
			$this->currentRow++;
			/*
			 * Lecture de la ligne a importer
			 */
			if (strlen($this->enclosure) == 1) {
				$data = fgetcsv($this->handle, 1000, $this->separateur, $this->enclosure);
			} else {
				$data = fgetcsv($this->handle, 1000, $this->separateur);
			}
			$this->currentRow++;
			return $data;
		}
	}
	/**
	 * Initialise l'export CSV
	 *
	 * @param string $nomFichierExport        	
	 * @param string $separateur     
	 * @param string $enclosure : q: simple quote, d: double-quote   	
	 */
	function exportCSVinit($nomFichierExport, $separateur = ",", $enclosure = "")
	{
		$this->nomFichierExport = $nomFichierExport . "-" . date('d-m-Y') . ".csv";
		if ($separateur == "tab") {
			$separateur = "\t";
		}
		$this->separateurExport = $separateur;
		$this->reformatEnclosure($enclosure);
	}
	/**
	 * Ecrit une ligne dans le fichier CSV
	 *
	 * @param array $ligne        	
	 */
	function setLigneCSV($ligne)
	{
		if (strlen($this->fichierExport) > 0) {
			$this->fichierExport .= "\n";
		}
		$compteur = 1;
		$nbItem = count($ligne);
		foreach ($ligne as $value) {
			$this->fichierExport .= $this->enclosure . $value . $this->enclosure;
			if ($compteur < $nbItem) {
				$this->fichierExport .= $this->separateurExport;
			}
			$compteur++;
		}
	}
	/**
	 * Ecrit un tableau complet en une seule operation
	 * @param array $tableau
	 */
	function setTableau($tableau)
	{
		foreach ($tableau as $ligne) {
			$this->setLigneCSV($ligne);
		}
	}
	/**
	 * Declenche l'envoi du fichier CSV au navigateur
	 */
	function exportCSV()
	{
		header("content-type: text/csv");
		header('Content-Disposition: attachment; filename="' . $this->nomFichierExport . '"');
		header('Pragma: no-cache');
		header('Cache-Control:must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		echo $this->fichierExport;
	}
}
?>