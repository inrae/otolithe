<?php
/**
 * Programme permettant de supprimer les fichiers de photos de plus d'une heure
 */
$dureeVie = 3600 * 24; // Suppression de tous les fichiers de plus de 24 heures
if (strlen ( $APPLI_photoStockage ) > 0) {
	/*
	 * Ouverture du dossier
	 */
	$dossier = opendir ( $APPLI_photoStockage );
	while ( false !== ($entry = readdir ( $dossier )) ) {
		$path = $APPLI_photoStockage . "/" . $entry;
		$file = fopen($path, 'r');
		$stat = fstat($file);
		$atime = $stat["atime"];
		fclose($file);
		$infos = pathinfo ( $path );
		$extension = $infos ['extension'];
		if ($extension == "jpg" && ! is_dir($path)) {
			$age = time () - $atime;
			if ($age > $dureeVie) {
				unlink ( $path );
			}
		}
	}
	closedir ( $dossier );
}
