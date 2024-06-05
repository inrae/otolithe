<h2>{t}Import d'individus dans la base de données{/t}</h2>
<!-- Affichage des erreurs decouvertes -->
{if $erreur == 1}
<div class="row col-md-12">
<table id="containerList" class="table table-bordered table-hover datatable " >
<thead>
<tr>
<th>{t}N° de ligne{/t}</th>
<th>{t}Anomalie(s) détectée(s){/t}</th>
</tr>
</thead>
<tbody>
{section name=lst loop=$erreurs}
<tr>
<td class="center">{$erreurs[lst].line}</td>
<td>{$erreurs[lst].message}</td>
</tr>
{/section}
</tbody>
</table>
</div>
{/if}

<!-- Selection du fichier a importer -->
<div class="row">
<div class="col-md-6">
<form class="form-horizontal protoform" id="controlForm" method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="module" value="importControl">
<div class="form-group">
<label for="upfile" class="control-label col-md-4"><span class="red">*</span> {t}Nom du fichier à importer (CSV) :{/t}</label>
<div class="col-md-8">
<input type="file" name="upfile" required>
</div>
</div>
<div class="form-group">
<label for="separator" class="control-label col-md-4">{t}Séparateur utilisé :{/t}</label>
<div class="col-md-8">
<select id="separator" name="separator">
<option value=";" {if $separator == ";"}selected{/if}>{t}Point-virgule{/t}</option>
<option value="," {if $separator == ","}selected{/if}>{t}Virgule{/t}</option>
<option value="tab" {if $separator == "tab"}selected{/if}>{t}Tabulation{/t}</option>
</select>
</div>
</div>
<div class="form-group">
<label for="utf8_encode" class="control-label col-md-4">{t}Encodage du fichier :{/t}</label>
<div class="col-md-8">
<select id="utf8_encode" name="utf8_encode">
<option value="0" {if $utf8_encode == 0}selected{/if}>UTF-8</option>
<option value="1" {if $utf8_encode == 1}selected{/if}>ISO-8859-x</option>
</select>
</div>
</div>
<div class="form-group center">
      <button type="submit" class="btn btn-primary">{t}Lancer les contrôles{/t}</button>
</div>
{$csrf}
</form>
</div>
</div>

<!-- Lancement de l'import -->
{if $controleOk == 1}

<form class="protoform" id="importForm" method="post" action="index.php">
<input type="hidden" name="module" value="importImport">
{t}Contrôles OK. Vous pouvez réaliser l'import du fichier{/t} {$filename} : 
<button type="submit" class="btn btn-danger">{t}Déclencher l'import{/t}</button>
{$csrf}
</form>
{/if}

<div class="row">
<div class="col-md-6">
<div class="bg-info">
{t}Pour importer des individus dans la base, préparez un fichier CSV avec les informations suivantes :{/t}
<ul>
<li><b>exp_id</b> : {t}code de l'expérimentation (obligatoire){/t} <a href="index.php?module=experimentationList">{t}Consultez la liste des expérimentations{/t}</a></li> 
<li><b>espece_id</b> : {t}code de l'espèce (obligatoire){/t} <a href="index.php?module=especeList">{t}Consultez la liste des espèces{/t}</a></li>
<li><b>tag</b> : {t}N° de l'étiquette posée sur le poisson (le codeindividu ou le tag sont obligatoires){/t}</li>
<li><b>codeindividu</b> : {t}identifiant du poisson ou hptag{/t}</li>
<li><b>sexe_id</b> : {t}sexe du poisson (1 : mâle, 2 : femelle, 3 : juvénile, 4 : indifférencié){/t}</li>
<li><b>longueur</b> : {t}longueur du poisson (mm){/t}</li>
<li><b>poids</b> : {t}poids du poisson (g){/t}</li>
<li><b>remarque</b> : {t}remarques concernant le poisson{/t}</li>
<li><b>parasite</b> : {t}parasites éventuels rencontrés{/t}</li>
<li><b>age</b> : {t}âge du poisson{/t}</li>
<li><b>wgs84_x</b> : {t}Longitude du point de capture, en WGS84{/t}</li>
<li><b>wgs84_y</b> : {t}Latitude du point de capture, en WGS84{/t}</li>
<li><b>individu_uuid</b> : {t}UUID de l'individu{/t}</li>
<li><b>piecetype_id</b> : {t}code du type de pièce calcifiée à analyser{/t} <a href="index.php?module=piecetypeList">{t}Consultez la liste des types de pièces{/t}</a></li>
<li><b>piececode</b> : {t}si le type de pièce est indiqué, vous pouvez renseigner un code spécifique attaché à la pièce{/t}</li>
<li><b>piece_uuid</b> : {t}UUID de la pièce{/t}</li>
<li><b>peche_date</b> : {t}date de la pêche, au format aaaa-mm-dd ou dd/mm/aaaa{/t}</li>
<li><b>site</b> : {t}site de la pêche{/t}</li>
<li><b>zonesite</b> : {t}zone précise de la pêche (précision concernant le site){/t}</li>
<li><b>campagne</b> : {t}campagne de pêche{/t}</li>
<li><b>peche_engin</b> : {t}engin utilisé{/t}</li>
<li><b>personne</b> : {t}références du pêcheur{/t}</li>
<li><b>operateur</b> : {t}références de l'opérateur ayant traité le poisson{/t}</li>
<li><b>metadatatype_id</b> : {t}code du type de méta-données importées{/t} <a href="index.php?module=metadatatypeList">{t}Consultez la liste des types de méta-données{/t}</a></li>
<li><b>piecemetadata_date</b> : {t}Date d'obtention des méta-données{/t}</li>
<li><b>piecemetadata_comment</b> : {t}Commentaires associés aux méta-données{/t}</li>
<li><b>metadata</b> : {t}Méta-données, au format JSON. Peut prendre la forme d'un tableau ou des valeurs uniques. Les champs doivent être identiques à ceux décrits dans le type de méta-données (cf. metadatatype_id){/t}</li>
<li><b>md_nom-du-champ</b> : {t}Pour des méta-données uniques (pas en tableau), chaque champ peut être indiqué dans une colonne pré-fixée par md_. Le programme reconstituera les données pour les stocker au format JSON.{/t}</li>

</ul>
<div class="center">
<a href="display/images/import_model.csv" type="text/csv" cible="_blank">{t}Téléchargez un modèle de fichier CSV{/t}</a>
</div>
</div>
</div>
</div>


<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>


