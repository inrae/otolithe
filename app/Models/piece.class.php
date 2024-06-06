<?php
class PieceException extends Exception
{ }
/**
 * ORM de gestion de la table piece
 * @author quinton
 *
 */
class Piece extends ObjetBdd
{
	function __construct($bdd, $param = array())
	{
		$this->param = $param;
		$this->table = "piece";
		$this->id_auto = "1";
		$this->colonnes = array(
			"piece_id" => array(
				"type" => 1,
				"key" => 1,
				"requis" => 1,
				"defaultValue" => 0
			),
			"individu_id" => array(
				"type" => 1,
				"requis" => 1,
				"parentAttrib" => 1
			),
			"piecetype_id" => array(
				"type" => 1,
				"requis" => 1
			),
			"piececode" => array(
				"longueur" => 255
			),
			"traitementpiece_id" => array(
				"type" => 1
			),
			"uuid" => array("type" => 0, "defaultValue" => "getUUID"),
		);
		$param["fullDescription"] = 1;
		parent::__construct($bdd, $param);
	}
	/**
	 * Affiche le detail d'une piece
	 *
	 * @param int $id
	 * @return array
	 */
	function getDetail($id)
	{
		if ($id > 0) {
			$sql = "select piece_id, individu_id, piecetype_id, piecetype_libelle, piececode,
				traitementpiece_id, traitementpiece_libelle, uuid
				from " . $this->table . " left outer join piecetype using (piecetype_id)
				  left outer join traitementpiece using (traitementpiece_id)
				 where piece_id = " . $id;
			return $this->lireParam($sql);
		} else {
			return null;
		}
	}
	/**
	 * Retourne la liste des pieces attachees a un individu
	 *
	 * @param int $individu_id
	 * @return array
	 */
	function getListFromIndividu($individu_id)
	{
		if ($individu_id > 0) {
			$sql = "select piece_id, individu_id, piececode,
				piecetype_libelle, traitementpiece_libelle,
				count(photo_id) as nbphoto
				from " . $this->table . "
						left outer join piecetype using (piecetype_id)
						left outer join traitementpiece using (traitementpiece_id)
						left outer join photo using (piece_id)
				where individu_id = " . $individu_id . "
				group by piece_id, individu_id, piecetype_libelle, traitementpiece_libelle
						";
			return $this->getListeParam($sql);
		} else {
			return null;
		}
	}
	/**
	 * Surcharge de la fonction suppression pour
	 * effacer les donnees liees
	 *
	 * @param int $id
	 * @return void
	 */
	function supprimer($id)
	{
		if (is_numeric($id) && $id > 0) {
			/** Suppression des tables liees */
			/** Suppression des photos */
			include_once 'modules/classes/photo.class.php';
			$photo = new Photo($this->connection, $this->paramori);
			$lp = $photo->getListePhotoFromPiece($id);
			foreach ($lp as $row) {
				$photo->supprimer($row["photo_id"]);
			}
			/** Suppression des metadonnees */
			include_once 'modules/classes/piecemetadata.class.php';
			$pm = new Piecemetadata($this->connection, $this->paramori);
			$pm->supprimerChamp($id, "piece_id");
			parent::supprimer($id);
		} else {
			throw new ObjetBDDException(_("La suppression d'une clé nulle ou non numérique n'est pas possible"));
		}
	}
	/**
	 * Suppression de toutes les pièces rattachées
	 * à un individu
	 *
	 * @param int $id
	 * @return void
	 */
	function supprimerFromIndividu($id)
	{
		if ($id > 0) {
			$sql = "select piece_id from piece where individu_id = :id";
			$liste = $this->getListeParamAsPrepared($sql, array("id" => $id));
			foreach ($liste as $item) {

				$this->supprimer($item["piece_id"]);
			}
		}
	}

	/**
	 * Get the list of all pieces attached to an experimentation
	 *
	 * @param int $exp_id
	 * @return array
	 */
	function getListFromExperimentation($exp_id)
	{
		$sql = "select piece_id, piece_id as piece_uid, piececode, p.uuid, piecetype_id, piecetype_libelle,
							traitementpiece_id, traitementpiece_libelle,
							individu_id, codeindividu, tag, poids, age, sexe_libelle, i.uuid as individu_uuid,
							espece_id, nom_id
							,wgs84_x, wgs84_y
							from piece p
							join individu i using (individu_id)
							join piecetype using (piecetype_id)
							join espece using (espece_id)
							left outer join traitementpiece using (traitementpiece_id)
							left outer join sexe using (sexe_id)
							join individu_experimentation using (individu_id)
							where exp_id = :exp_id
							order by codeindividu, tag, piececode";
		return ($this->getListeParamAsPrepared($sql, array("exp_id" => $exp_id)));
	}

	/**
	 * Generate a list usable by Collec-Science - function External import
	 *
	 * @param array $pieces
	 * @param string $exp_name
	 * @return array|null
	 */
	function getListForCollec(array $pieces, string $exp_name): ?array
	{
		$sql = "select
					p.uuid as dbuid_origin,
					case when piececode is not null then piececode else piece_id::varchar end as identifier,
					p.uuid,
					piecetype_libelle as sample_type_name,
					'$exp_name' as collection_name,
					peche_date as sampling_date,
					nom_id as md_taxon,
					tag as md_tag,
					codeindividu as md_fishcode,
					poids as md_weight,
					longueur as md_length,
					traitementpiece_libelle as md_treatment
					,wgs84_x, wgs84_y
					from piece p
					join individu i using (individu_id)
					join piecetype using (piecetype_id)
					join espece using (espece_id)
					left outer join traitementpiece using (traitementpiece_id)
					left outer join sexe using (sexe_id)
					left outer join peche using (peche_id)
					where piece_id in (";
		/**
		 * where content
		 */
		$where = "";
		$comma = "";
		foreach ($pieces as $id) {
			if (is_numeric($id)) {
				$where .= $comma . $id;
				$comma = ",";
			}
		}
		$sql .= $where . ")";
		return $this->getListeParam($sql);
	}
}
