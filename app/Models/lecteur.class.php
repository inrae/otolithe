<?php

/**
 * ORM de gestion de la table des lecteurs
 *
 * @author quinton
 *
 */
class Lecteur extends ObjetBdd
{

  public function __construct($bdd, $param = array())
  {
    $this->param = $param;
    $this->table = "lecteur";
    $this->id_auto = "1";
    $this->colonnes = array(
      "lecteur_id" => array(
        "type" => 1,
        "key" => 1,
        "requis" => 1,
        "defaultValue" => 0,
      ),
      "login" => array(
        "type" => 0,
        "requis" => 1,
        "longueur" => 100,
      ),
      "lecteur_nom" => array(
        "longueur" => 50,
      ),
      "lecteur_prenom" => array(
        "longueur" => 50,
      ),
    );
    $param["fullDescription"] = 1;
    parent::__construct($bdd, $param);
  }

  /**
   * Retourne l'identifiant du lecteur
   *
   * @param int $login
   * @return number
   */
  public function getIdFromLogin($login)
  {
    if (strlen($login) > 0) {
      $login = $this->encodeData($login);

      $sql = "select lecteur_id from " . $this->table . " where login = '" . $login . "'";
      $res = $this->lireParam($sql);
      if ($res["lecteur_id"] > 0) {
        return $res["lecteur_id"];
      } else {
        return -1;
      }
    } else {
      return null;
    }
  }

  /**
   * Reecriture de la fonction liste pour trier la table
   * (non-PHPdoc)
   *
   * @see ObjetBDD::getListe()
   */
  public function getListe()
  {
    $sql = "select * from " . $this->table . " order by lecteur_nom, lecteur_prenom";
    return $this->getListeParam($sql);
  }

  /**
   * Retourne la liste des lecteurs rattaches a une experimentation
   *
   * @param [int] $exp_id
   * @return array
   */
  public function getListFromExp($exp_id)
  {
    $sql = "select l.* 
                from lecteur l
                join lecteur_experimentation using (lecteur_id)
                where exp_id = :exp_id
                order by lecteur_nom, lecteur_prenom
        ";
    return $this->getListeParamAsPrepared($sql, array("exp_id" => $exp_id));
  }

  /**
   * Surcharge de la fonction ecrire pour enregistrer les experimentations autorisees
   * (non-PHPdoc)
   *
   * @see ObjetBDD::write()
   */
  public function ecrire($data)
  {
    $id = parent::ecrire($data);

    if ($id > 0) {
      $this->ecrireTableNN("lecteur_experimentation", "lecteur_id", "exp_id", $id, $data["exp_id"]);
    }
    return $id;
  }
}
