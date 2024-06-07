<?php
include_once 'modules/classes/piece.class.php';
$dataClass = new Piece($bdd, $ObjetBDDParam);
$id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);

switch ($t_module["param"]) {
  case "list":
    $_SESSION["moduleListe"] = "pieceList";
    /**
     * Integration des experimentations
     */
    if (isset($_REQUEST["exp_id"])) {
      $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
      $searchIndividu->setParam(array("exp_id" => $exp_id));
    } else {
      $exp_id = $searchIndividu->getParam("exp_id");
    }
    $vue->set($_SESSION["it_experimentation"]->setValue($exp_id), "exp_id");
    $vue->set($_SESSION["it_experimentation"]->translateList($_SESSION["experimentations"]), "experimentation");
    /**
     * Recherche des pieces
     */
    if ($exp_id > 0) {
      $data = $dataClass->getListFromExperimentation($exp_id);
      $vue->set(
        $_SESSION["it_piece"]->translateList(
          $_SESSION["it_individu"]->translateList(
            $data
          )
        ),
        "data"
      );
    }
    $vue->set("gestion/pieceListe.tpl", "corps");
    break;
  case "display":
    /**
     * Display the detail of the record
     */
    $data = $dataClass->getDetail($id);
    $dataT = $_SESSION["it_piece"]->translateRow($data);
    $dataT = $_SESSION["it_individu"]->translateRow($dataT);
    $vue->set($dataT, "data");

    /**
     * Lecture des photos
     */
    include_once 'modules/classes/photo.class.php';
    $photo = new Photo($bdd, $ObjetBDDParam);
    /**
     * Lecture du poisson
     */
    include_once 'modules/classes/individu.class.php';
    $individu = new Individu($bdd, $ObjetBDDParam);
    $dataIndiv = $individu->getDetail($data["individu_id"]);
    $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
    $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
    $vue->set($dataIndiv, "individu");
    $listePhoto = $photo->getListePhotoFromPiece($id);

    /*** Lecture des metadonnees */
    include_once 'modules/classes/piecemetadata.class.php';
    $pm = new Piecemetadata($bdd, $ObjetBDDParam);
    try {
      $metadatas = $pm->getListFromPiece($id);
      $metadatas = $_SESSION["it_piece"]->translateList($metadatas);
      $vue->set($_SESSION["it_piecemetadata"]->translateList($metadatas), "metadatas");
    } catch (Exception $e) {
      $message->set(_("Problème lors de la lecture des métadonnées rattachées à la pièce"), true);
      $message->setSyslog($e->getMessage());
    }
    include_once 'modules/classes/metadatatype.class.php';
    $mdt = new Metadatatype($bdd, $ObjetBDDParam);
    $vue->set($mdt->getListe(), "metadatatypes");
    /**
     * Rajout du lien vers l'image
     */
    foreach ($listePhoto as $key => $value) {
      $listePhoto[$key]["photoPath"] = $photo->writeFilePhoto($value["photo_id"], 1);
    }
    $vue->set($_SESSION["it_photo"]->translateList($listePhoto), "photo");
    $vue->set("gestion/pieceDisplay.tpl", "corps");

    break;
  case "change":
    /**
     * open the form to modify the record
     * If is a new record, generate a new record with default value :
     * $_REQUEST["idParent"] contains the identifiant of the parent record
     */
    /**
     * Recuperation des tables de parametres
     */
    require_once "modules/classes/traitementpiece.class.php";
    $traitementpiece = new Traitementpiece($bdd, $ObjetBDDParam);
    $vue->set($traitementpiece->getListe(), "traitementpiece");
    require_once "modules/classes/piecetype.class.php";
    $piecetype = new Piecetype($bdd, $ObjetBDDParam);
    $vue->set($piecetype->getListe(), "piecetype");

    /**
     * Lecture du poisson
     */
    include_once 'modules/classes/individu.class.php';
    $individu = new Individu($bdd, $ObjetBDDParam);
    $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
    $dataIndiv = $individu->getDetail($_REQUEST["individu_id"]);
    $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
    $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
    $vue->set($dataIndiv, "individu");
    $data = dataRead($dataClass, $id, "gestion/pieceChange.tpl", $_REQUEST["individu_id"]);
    $data = $_SESSION["it_piece"]->translateRow($data);
    $data = $_SESSION["it_individu"]->translateRow($data);
    $vue->set($data, "data");
    printr($data);
    break;
  case "write":
    /**
     * write record in database
     */
    $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
    $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
    $id = dataWrite($dataClass, $_REQUEST);
    if ($id > 0) {
      $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($id);
    }
    break;
  case "delete":
    /**
     * delete record
     */

    dataDelete($dataClass, $id);
    /*** Reaffectation de l'identifiant en cas d'échec de la suppression */
    $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($id);
    break;

  case "exportCS":
    /**
     * Export the list in a format usable by Collec-Science
     */
    /**
     * Get the name of experimentation
     */
    try {
      $exp_id = $_SESSION["it_experimentation"]->getValue($_REQUEST["exp_id"]);
      require_once "modules/classes/experimentation.class.php";
      $experimentation = new Experimentation($bdd, $ObjetBDDParam);
      $dexp = $experimentation->lire($exp_id);
      $exp_name = $dexp["exp_nom"];
      if (strlen($exp_name) == 0) {
        throw new PieceException(_("Le nom de l'expérimentation n'a pas été fournie"));
      }
      if (count($_REQUEST["pieces"]) == 0) {
        throw new PieceException((_("Pas de pièces à exporter")));
      }
      /**
       * Get the piece_id to treat
       */
      $pieces = array();
      foreach ($_REQUEST["pieces"] as $value) {
        $pieces[] = $_SESSION["it_piece"]->getValue($value);
      }
      $data = $dataClass->getListForCollec($pieces, $exp_name);
      if (count($data) == 0) {
        throw new PieceException(_("Aucune pièce n'a été sélectionnée dans la base de données"));
      }
      $vue->set($data);
    } catch (Exception $e) {
      $message->set(_("L'exportation n'a pas été réalisée"), true);
      $message->set($e->getMessage());
      $module_coderetour = -1;
    }
    break;
}
