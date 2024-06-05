{* Paramètres > Métadonnées > Nouveau > *}
<script>
	$(document).ready(function() {
		$("#checkMetadata").change(function() {
			$('.checkMetadata').prop('checked', this.checked);
			var libelle = "{t}Tout cocher{/t}";
			if (this.checked) {
				libelle = "{t}Tout décocher{/t}";
			}
			$("#lmetadatachek").text(libelle);
		});
	});
</script>

<h2>{t}Modèles de métadonnées{/t}</h2>
<div class="row">
	<div class="col-md-6">
		{if $droits.gestionCompte == 1}
			<a href="index.php?module=metadatatypeChange&metadatatype_id=0">
				<img src="display/images/new.png" height="25">
				{t}Nouveau...{/t}
			</a>
		{/if}

		<form method="POST" id="metadataExport" action="index.php">
			<input type="hidden" id="module" name="module" value="metadatatypeExport">
			<div class="row">
				<div class="center">
					{t}Exporter les métadonnées :{/t} <label id="lmetadatacheck" for="checkMetadata">{t}Tout décocher{/t}</label> <input
						type="checkbox" id="checkMetadata" checked>
						<button type="submit" class="btn btn-primary">{t}Déclencher l'export{/t}</button>
				</div>
			</div>

			<table id="metadataList" class="table table-bordered table-hover datatable" data-order='[[1,"asc"]]' >
				<thead>
					<tr>
						<th>{t}Identifiant{/t}</th>
						<th>{t}Nom du modèle{/t}</th>
						<th>{t}Résumé{/t}</th>
						<th>{t}Données en tableau ?{/t}</th>
						{if $droits.gestionCompte == 1}
							<th>{t}Modifier{/t}</th>
							<th>{t}Dupliquer{/t}</th>
						{/if}
						<th>{t}Exporter{/t}</th>
					</tr>
				</thead>
				<tbody>
					{section name=lst loop=$data}
						<tr>
							<td class="center">{$data[lst].metadatatype_id}</td>
							<td>
								{$data[lst].metadatatype_name}
							</td>
							<td class="textareaDisplay">{$data[lst].metadatatype_comment}</td>
							<td class="center">
								{if $data[lst].is_array == 1}{t}oui{/t}{else}{t}non{/t}{/if}
							</td>
								{if $droits.gestionCompte == 1}
									<td class="center">
									<a href="index.php?module=metadatatypeChange&metadatatype_id={$data[lst].metadatatype_id}" title="{t}Modifier le modèle de métadonnées{/t}">
										<img src="display/images/edit.png" height="25">
									</a>
									<td class="center">
										<a href="index.php?module=metadatatypeCopy&metadatatype_id={$data[lst].metadatatype_id}" title="{t}Dupliquer le modèle de métadonnées{/t}">
											<img src="display/images/copy.png" height="25">
										</a>
									</td>
								{/if}
							<td class="center">
							<input type="checkbox" class="checkMetadata"
								name="metadatatype_id[]" value="{$data[lst].metadatatype_id}" checked>
							</td>
						</tr>
					{/section}
				</tbody>
			</table>
		{$csrf}
</form>
	</div>
</div>

{if $droits["gestionCompte"] == 1}
	<div class="row col-md-6">
		<fieldset>
			<legend>{t}Importer des modèles de métadonnées provenant d'une autre base de données Otolithe{/t}</legend>
			<form class="form-horizontal protoform" id="metadatatypeImport" method="post" action="index.php" enctype="multipart/form-data">
				<input type="hidden" name="module" value="metadatatypeImport">
				<div class="form-group">
					<label for="upfile" class="control-label col-md-4"><span class="red">*</span> {t}Nom du fichier à importer (CSV) :{/t}</label>
						<div class="col-md-8">
							<input type="file" name="upfile" required>
						</div>
					</div>
				<div class="form-group center">
					<button type="submit" class="btn btn-primary">{t}Importer les métadonnées{/t}</button>
				</div>
				<div class="bg-info">
					{t}L'importation est basée sur un fichier exporté depuis une autre instance d'Otolithe.{/t}
					<br>
					{t}Description du fichier :{/t}
					<ul>
						<li>{t}metadatatype_name : nom de la métadonnée{/t}</li>
						<li>{t}metadatatype_comment : commentaire{/t}</li>
						<li>{t}is_array : 1 si les données sont multilignes (multivaleurs){/t}</li>
						<li>{t}metadatatype_schema : Description, au format JSON, de la métadonnée{/t}</li>
					</ul>
				</div>
			{$csrf}
</form>
		</fieldset>
	</div>
{/if}

