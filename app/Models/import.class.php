<?php

/**
 * Created : 17 août 2016
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2016 - All rights reserved
 */
/**
 * Classes d'exception
 *
 * @author quinton
 *
 */
class FichierException extends Exception
{ }

class HeaderException extends Exception
{ }

class ImportException extends Exception
{ }

/**
 * Classe realisant l'import
 *
 * @author quinton
 *
 */
class Import
{

  private $separator = ",";

  private $utf8_encode = false;

  private $colonnes = array(
    "exp_id",
    "espece_id",
    "tag",
    "codeindividu",
    "sexe_id",
    "longueur",
    "poids",
    "remarque",
    "parasite",
    "age",
    "piecetype_id",
    "piececode",
    "peche_date",
    "site",
    "zonesite",
    "campagne",
    "peche_engin",
    "personne",
    "operateur",
    "metadatatype_id",
    "metadata",
    "piecemetadata_date",
    "piecemetadata_comment",
    "wgs84_x",
    "wgs84_y",
    "individu_uuid",
    "piece_uuid"
  );

  private $colnum = array(
    "poids",
    "longueur",
    "sexe_id",
    "wgs84_x",
    "wgs84_y"
  );

  private $handle;

  private $fileColumn = array();

  public $nbTreated = 0;

  private $experimentation = array();

  private $piecetype = array();

  private $espece = array();

  private $metadatatype = array();

  private $individu, $piece, $ie, $peche, $pm;

  public $minuid, $maxuid;

  /**
   * Initialise la lecture du fichier, et lit la ligne d'entete
   *
   * @param string $filename
   * @param string $separator
   * @param string $utf8_encode
   * @throws HeaderException
   * @throws FichierException
   */
  public function initFile($filename, $separator = ",", $utf8_encode = false)
  {
    if ($separator == "tab") {
      $separator = "\t";
    }
    $this->separator = $separator;
    $this->utf8_encode = $utf8_encode;
    /**
     * Ouverture du fichier
     */
    if ($this->handle = fopen($filename, 'r')) {
      /**
       * Lecture de la premiere ligne et affectation des colonnes
       */
      $data = $this->readLine();
      $range = 0;
      for ($range = 0; $range < count($data); $range++) {
        $value = $data[$range];
        if (in_array($value, $this->colonnes) || substr($data[$range], 0, 3) == "md_") {
          $this->fileColumn[$range] = $value;
        } else {
          throw new HeaderException(sprintf(_("L'entête de colonne %1\$s n'est pas reconnue (%2\$s)"), $range, $value));
        }
      }
    } else {
      throw new FichierException(sprintf(_("%s non trouvé ou non lisible"), $filename));
    }
  }

  /**
   * Initialise les classes utilisees pour realiser les imports
   *
   * @param Individu $individu
   * @param Piece $piece
   */
  public function initClasses(Individu $individu, Piece $piece, Individu_experimentation $ie, Peche $peche, Piecemetadata $pm)
  {
    $this->individu = $individu;
    $this->piece = $piece;
    $this->ie = $ie;
    $this->peche = $peche;
    $this->pm = $pm;
  }

  /**
   * Lit une ligne dans le fichier
   *
   * @return array|NULL
   */
  public function readLine()
  {
    if ($this->handle) {
      $data = fgetcsv($this->handle, null, $this->separator);
      if ($data !== false) {
        if ($this->utf8_encode) {
          foreach ($data as $key => $value) {
            $data[$key] = utf8_encode($value);
          }
        }
      }
      return $data;
    } else {
      return null;
    }
  }

  /**
   * Ferme le fichier
   */
  public function fileClose()
  {
    if ($this->handle) {
      fclose($this->handle);
    }
  }

  /**
   * Lance l'import des lignes
   *
   * @throws ImportException
   */
  public function importAll()
  {
    $num = 1;
    $maxuid = 0;
    $minuid = 99999999;
    /**
     * Suppression du reformatage de la date
     */
    $this->peche->auto_date = 0;
    $this->pm->auto_date = 0;
    while ($data = $this->readLine()) {
      if (count($data) > 0) {
        /**
         * Preparation du tableau
         */
        $values = $this->prepareLine($data);
        $num++;
        /**
         * Lancement de l'ecriture des informations
         */
        $individu_id = 0;
        $di = $values;
        $di["individu_id"] = 0;
        $di["uuid"] = $di["individu_uuid"];
        unset($di["individu_uuid"]);
        $peche_id = 0;
        $pieceId = 0;
        $dm = array();
        try {
          /**
           * Traitement de la peche
           */
          if (strlen($values["site"]) > 0 || strlen($values["peche_date"]) > 0 || strlen($values["campagne"]) > 0 || strlen($values["zonesite"]) > 0 || strlen($values["peche_engin"]) > 0 || strlen($values["personne"]) > 0 || strlen($values["operateur"]) > 0) {
            $values["peche_date"] = $this->formatDate(
              $values["peche_date"]
            );
            $peche_id = $this->peche->ecrire($values);
            if ($peche_id > 0) {
              $di["peche_id"] = $peche_id;
            }
          }
          /**
           * Traitement de l'individu
           */
          $individu_id = $this->individu->ecrire($di);
          /**
           * Rattachement a l'experimentation
           */
          $data_ie = array(
            "individu_id" => $individu_id,
            "exp_id" => $values["exp_id"],
          );
          $this->ie->ecrire($data_ie);
          /**
           * Rajout de la piece
           */
          if ($values["piecetype_id"] > 0) {
            $dp = $values;
            $dp["individu_id"] = $individu_id;
            $dp["uuid"] = $dp["piece_uuid"];
            unset($dp["piece_uuid"]);
            $pieceId = $this->piece->ecrire($dp);
          }

          if ($pieceId > 0 && $values["metadatatype_id"] > 0) {
            /***
             * Recherche des metadonnees attachees
             */
            $metadata = array();
            if (strlen($values["metadata"]) > 0) {
              $metadata = json_decode($values["metadata"], true);
            }
            foreach ($this->fileColumn as $colonne) {
              if (substr($colonne, 0, 3) == "md_" && strlen($values[$colonne]) > 0) {
                $metadata[substr($colonne, 3)] = $values[$colonne];
              }
            }
            if (count($metadata) > 0) {
              $dm["piece_id"] = $pieceId;
              $dm["metadatatype_id"] = $values["metadatatype_id"];
              $dm["metadata"] = json_encode($metadata);
              $dm["piecemetadata_comment"] = $values["piecemetadata_comment"];
              if (strlen($values["piecemetadata_date"]) > 0) {
                $dm["piecemetadata_date"] = $this->formatDate($values["piecemetadata_date"]);
              }
              $this->pm->ecrire($dm);
            }
          }
        } catch (PDOException $pe) {
          throw new ImportException("PDOException - Line $num: error when import data. " . $pe->getMessage());
        } catch (ObjetBDDException $oe) {
          throw new ImportException("Line $num: error when importing data. " . $oe->getMessage());
        }
        /**
         * Mise a jour des bornes de l'uid
         */
        if ($individu_id < $minuid) {
          $minuid = $individu_id;
        }
        if ($individu_id > $maxuid) {
          $maxuid = $individu_id;
        }
        $this->nbTreated++;
      }
    }
    $this->minuid = $minuid;
    $this->maxuid = $maxuid;
  }

  /**
   * Reecrit une ligne, en placant les bonnes valeurs en fonction de l'entete
   *
   * @param array $data
   * @return array[]
   */
  public function prepareLine($data)
  {
    $nb = count($data);
    $values = array();
    for ($i = 0; $i < $nb; $i++) {
      $values[$this->fileColumn[$i]] = $data[$i];
    }

    return $values;
  }

  /**
   * Initialise les tableaux pour traiter les controles
   *
   * @param array $experimentation
   * @param array $piecetype
   * @param array $espece
   */
  public function initControl($experimentation, $piecetype, $espece, $sexe, $metadatatype)
  {
    $this->experimentation = $experimentation;
    $this->piecetype = $piecetype;
    $this->espece = $espece;
    $this->sexe = $sexe;
    $this->metadatatype = $metadatatype;
  }

  /**
   * Declenche le controle pour toutes les lignes
   *
   * @return array[]["line"=>int, "message"=>string]
   */
  public function controlAll()
  {
    $num = 1;
    $retour = array();
    while (($data = $this->readLine()) !== false) {
      $values = $this->prepareLine($data);
      $num++;
      $controle = $this->controlLine($values);
      if (!$controle["code"]) {
        $retour[] = array(
          "line" => $num,
          "message" => $controle["message"],
        );
      }
    }
    return $retour;
  }

  /**
   * Controle une ligne
   *
   * @param array $data
   * @return array ["code"=>boolean,"message"=>string]
   */
  public function controlLine($data)
  {
    $retour = array(
      "code" => true,
      "message" => "",
    );

    /**
     * Verification que le codeindividu ou le tag sont renseignes
     */
    if (strlen($data["codeindividu"]) == 0 && strlen($data["tag"]) == 0) {
      $retour["code"] = false;
      $retour["message"] .= _("Aucun code (codeindividu ou tag) n'a été indiqué.");
    }
    /**
     * Verification de l'experimentation
     */
    $ok = false;
    foreach ($this->experimentation as $value) {
      if ($data["exp_id"] == $value["exp_id"]) {
        $ok = true;
        break;
      }
    }
    if (!$ok) {
      $retour["code"] = false;
      $retour["message"] .= " " . _("Le numéro de l'expérimentation est manquant, inconnu ou non autorisé.");
    }
    /**
     * Verification de l'espece
     */
    $ok = false;
    foreach ($this->espece as $value) {
      if ($data["espece_id"] == $value["espece_id"]) {
        $ok = true;
        break;
      }
    }
    if (!$ok) {
      $retour["code"] = false;
      $retour["message"] .= " " . _("Le numéro d'espèce est manquant ou non connu.");
    }

    /**
     * Verification du sexe
     */
    if (strlen($data["sexe_id"]) > 0) {
      $ok = false;
      foreach ($this->sexe as $value) {
        if ($data["sexe_id"] == $value["sexe_id"]) {
          $ok = true;
          break;
        }
      }
      if (!$ok) {
        $retour["code"] = false;
        $retour["message"] .= " " . _("Le sexe indiqué n'existe pas dans la base de données.");
      }
    }
    /**
     * Verification de l'UUID de l'individu
     */
    if (strlen($data["individu_uuid"]) > 0 && !$this->testUUID($data["individu_uuid"])) {
      $retour["code"] = false;
      $retour["message"] .= " " . _("L'UUID de l'individu n'est pas correct.");
    }

    /**
     * Verification que le type de la piece soit renseigne si le code de
     * la piece est renseigne
     */
    if (strlen($data["piececode"]) > 0 && strlen($data["piecetype_id"]) == 0) {
      $retour["code"] = false;
      $retour["message"] .= " " . _("La pièce dispose d'un code, mais son type n'a pas été indiqué.");
    }
    /**
     * Verification du type de la piece
     */
    $ok = false;
    if ($data["piecetype_id"] > 0) {
      foreach ($this->piecetype as $value) {
        if ($data["piecetype_id"] == $value["piecetype_id"]) {
          $ok = true;
          break;
        }
      }
      if (!$ok) {
        $retour["code"] = false;
        $retour["message"] .= " " . _("Le type de pièce indiqué n'est pas connu.");
      }
      /**
       * Verification de l'UUID de la piece
       */
      if (strlen($data["piece_uuid"]) > 0 && !$this->testUUID($data["piece_uuid"])) {
        $retour["code"] = false;
        $retour["message"] .= " " . _("L'UUID de la pièce n'est pas correct.");
      }
      /**
       * Recherche si des métadonnées sont indiquées
       */
      $isMetadata = false;
      if (strlen($data["metadata"]) > 0) {
        $isMetadata = true;
      } else {
        /***
         * Recherche dans les colonnes individuelles
         */
        foreach ($data as $key => $value) {
          if (substr($key, 0, 3) == "md_" && strlen($value) > 0) {
            $isMetadata = true;
            break;
          }
        }
      }
      if ($isMetadata) {
        $ok = false;
        if ($data["metadatatype_id"] > 0) {
          foreach ($this->metadatatype as $value) {
            if ($data["metadatatype_id"] == $value["metadatatype_id"]) {
              $ok = true;
              break;
            }
          }
        }
        if (!$ok) {
          $retour["code"] = false;
          $retour["message"] .= " " . _("Le type de métadonnées (metadatatype_id) n'est pas renseigné ou inconnu.");
        }
      }
    }

    /**
     * Verification des champs numeriques
     */
    foreach ($this->colnum as $key) {
      if (strlen($data[$key]) > 0) {
        if (!is_numeric($data[$key])) {
          $retour["code"] = false;
          $retour["message"] .= " " . sprintf(_("Le champ %s n'est pas numérique."), $key);
        }
      }
    }
    /**
     * Verification de la date
     */
    if (strlen($data["peche_date"]) > 0) {
      if (strlen($this->formatDate($data["peche_date"])) == 0) {
        $retour["code"] = false;
        $retour["message"] .= " " . _("La date de pêche est mal formatée");
      }
    }
    /**
     * Verification de la date de meta-donnees
     */
    if (strlen($data["piecemetadata_date"]) > 0) {
      if (strlen($this->formatDate($data["piecemetadata_date"])) == 0) {
        $retour["code"] = false;
        $retour["message"] .= " " . _("La date associée aux méta-données est mal formatée");
      }
    }
    return $retour;
  }

  /**
   * Fonction reformatant la date en testant le format francais, puis standard
   *
   * @param string $date
   * @return string
   */
  public function formatDate($date)
  {
    $val = "";
    /**
     * Verification du format de date
     */
    $result = date_parse_from_format($_SESSION["MASKDATE"], $date);

    if ($result["warning_count"] > 0|| $result["error_count"] > 0) {
      /***
       * La date est attendue avec le format yyyy-mm-dd
       */
      $date1 = explode(" ", $date);
      $date2 = explode("-", $date1[0]);
      $result = date_parse($date);
      if ($result["year"] != $date2[0] || str_pad($result["month"], 2, "0", STR_PAD_LEFT) != $date2[1] || str_pad($result["day"], 2, "0", STR_PAD_LEFT) != $date2[2]) {
        $result["warning_count"] = 1;
      }
    }

    if ($result["warning_count"] == 0) {
      if (strlen($result["year"]) == 2) {
        $result["year"] = "20" . $result["year"];
      }

      $val = $result["year"] . "-" . str_pad($result["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($result["day"], 2, "0", STR_PAD_LEFT);
      if (strlen($result["hour"]) > 0 && strlen($result["minute"]) > 0) {
        $val .= " " . str_pad($result["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($result["minute"], 2, "0", STR_PAD_LEFT);
        if (strlen($result["second"]) == 0) {
          $result["second"] = 0;
        }
        $val .= ":" . str_pad($result["second"], 2, "0", STR_PAD_LEFT);
      }
    }
    return $val;
  }
  /**
   * Test if a val is a UUID number
   *
   * @param string $val
   * @return boolean
   */
  function testUUID($val)
  {
    return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89AB][0-9a-f]{3}-[0-9a-f]{12}$/i', $val);
  }
}
