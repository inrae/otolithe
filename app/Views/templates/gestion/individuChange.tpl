<script >
$(document).ready(function() {
$("#recherche").keyup(function() {
	/*
	* Traitement de la recherche d'une espèce/type
	*/
	var texte = $(this).val();
	if (texte.length > 2) {
		/*
		* declenchement de la recherche
		*/
		var url = "especeSearchAjax";
		$.getJSON ( url, { "libelle": texte } , function( data ) {
			var options = '';
			 for (var i = 0; i < data.length; i++) {
			        options += '<option value="' + data[i].id + '">' + data[i].val + '</option>';
			      };
			$("#espece_id").html(options);
		} ) ;
	};
} );
});

</script>

<h2>{t}Modification d'un poisson{/t}</h2>
<div class="row">
	<a href="{$moduleListe}">
		<img src="display/images/list.png" height="25">
		{t}Retour à la liste{/t}
	</a>
	{if $data.individu_id > 0}
		<a href="individuDisplay?individu_id={$data.individu_id}">
			<img src="display/images/fish.png" height="25">
			{t}Retour au poisson{/t}
		</a>
	{/if}
	<form class="form-horizontal protoform" id="individuChange" method="post" action="index.php">
		<input  type="hidden" name="moduleBase" value="individu">
		<input type="hidden" name="action" value="Write">
		<input  type="hidden" name="individu_id" value="{$data.individu_id}">
		<input  type="hidden" name="peche_id" value="{$data.peche_id}">
		<div class="col-md-6 form-horizontal">
			<div class="form-group center">
				<button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
			</div>
			<fieldset>
				<legend>{t}Individu{/t}</legend>
				<div class="form-group">
					<label for="recherche" class="control-label col-md-4">
						{t}Espèce :{/t}<span class="red">*</span>
					</label>
					<div class="col-md-8">
					<input class="form-control" id="recherche" autocomplete="off" autofocus placeholder="{t}espèce à chercher{/t}" title="{t}Tapez au moins 3 caractères...{/t}">
						<select id="espece_id" name="espece_id" class="form-control">
							{if $data.espece_id > 0}
							<option value="{$data.espece_id}" selected>{$data.nom_id}</option>
							{/if}
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="sexe_id" class="control-label col-md-4">
						{t}Sexe :{/t}
					</label>
					<div class="col-md-8">
						<select id="sexe_id" class="form-control" name="sexe_id">
						<option value="" {if $data.sexe_id == ""}selected{/if}>{t}Sélectionnez...{/t}</option>
						{section name=lst loop=$sexes}
						<option value="{$sexes[lst].sexe_id}" {if $sexes[lst].sexe_id == $data.sexe_id}selected{/if}>
						{$sexes[lst].sexe_libelle}
						</option>
						{/section}
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="codeindividu" class="control-label col-md-4">
						{t}Code de l'individu :{/t}
					</label>
					<div class="col-md-8">
						<input id="codeindividu" class="form-control" name="codeindividu" value="{$data.codeindividu}">
					</div>
				</div>
				<div class="form-group">
					<label for="tag" class="control-label col-md-4">
						{t}Tag :{/t}
					</label>
					<div class="col-md-8">
						<input id="tag" class="form-control" name="tag" value="{$data.tag}">
					</div>
				</div>
				<div class="form-group">
					<label for="longueur" class="control-label col-md-4">
						{t}Longueur (mm) :{/t}
					</label>
					<div class="col-md-8">
						<input id="longueur" class="form-control" name="longueur" class="taux" value="{$data.longueur}">
					</div>
				</div>
				<div class="form-group">
					<label for="poids" class="control-label col-md-4">
						{t}Poids (g) :{/t}
					</label>
					<div class="col-md-8">
						<input id="poids" class="form-control" name="poids" class="taux" value="{$data.poids}">
					</div>
				</div>
				<div class="form-group">
					<label for="remarque" class="control-label col-md-4">
						{t}Remarque :{/t}
					</label>
					<div class="col-md-8">
						<input id="remarque" class="form-control" name="remarque" value="{$data.remarque}">
					</div>
				</div>
				<div class="form-group">
					<label for="parasite" class="control-label col-md-4">
						{t}Parasite :{/t}
					</label>
					<div class="col-md-8">
						<input id="parasite" class="form-control" name="parasite" value="{$data.parasite}">
					</div>
				</div>
				<div class="form-group">
					<label for="age" class="control-label col-md-4">
						{t}Age :{/t}
					</label>
					<div class="col-md-8">
						<input id="age" class="form-control" name="age" class="nombre" value="{$data.age}">
					</div>
				</div>
				<div class="form-group">
					<label for="wgs84_x" class="control-label col-md-4">
						{t}Coordonnées du point de capture (long/lat) :{/t}
					</label>
					<div class="col-md-8">
						{t}Longitude :{/t}&nbsp;<input id="wgs84_x" class="form-control" name="wgs84_x" class="nombre" value="{$data.wgs84_x}">
						<br>
						{t}Latitude :{/t}&nbsp;<input id="wgs84_y" class="form-control" name="wgs84_y" class="nombre" value="{$data.wgs84_y}">
					</div>
				</div>
				<div class="form-group">
					<label for="uuid" class="control-label col-md-4">
						{t}UUID :{/t}
					</label>
					<div class="col-md-8">
						<input id="uuid" class="form-control" name="uuid" value="{$data.uuid}">
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>{t}Données concernant la pêche{/t}</legend>
				<div class="form-group">
					<label for="site" class="control-label col-md-4">
						{t}Site :{/t}
					</label>
					<div class="col-md-8">
						<input id="site" class="form-control" name="site" value="{$peche.site}">
					</div>
				</div>
				<div class="form-group">
					<label for="zonesite" class="control-label col-md-4">
						{t}Zone précise :{/t}
					</label>
					<div class="col-md-8">
						<input id="zonesite" class="form-control" name="zonesite" value="{$peche.zonesite}">
					</div>
				</div>
				<div class="form-group">
					<label for="peche_date" class="control-label col-md-4">
						{t}Date de pêche :{/t}
					</label>
					<div class="col-md-8">
						<input id="peche_date" class="form-control" name="peche_date" class="datepicker" value="{$peche.peche_date}">
					</div>
				</div>
				<div class="form-group">
					<label for="campagne" class="control-label col-md-4">
						{t}Campagne :{/t}
					</label>
					<div class="col-md-8">
						<input id="campagne" class="form-control" name="campagne" value="{$peche.campagne}">
					</div>
				</div>
				<div class="form-group">
					<label for="peche_engin" class="control-label col-md-4">
						{t}Engin :{/t}
					</label>
					<div class="col-md-8">
						<input id="peche_engin" class="form-control" name="peche_engin" value="{$peche.peche_engin}">
					</div>
				</div>
				<div class="form-group">
					<label for="personne" class="control-label col-md-4">
						{t}Pêcheur :{/t}
					</label>
					<div class="col-md-8">
						<input id="personne" class="form-control" name="personne" value="{$peche.personne}">
					</div>
				</div>
				<div class="form-group">
					<label for="operateur" class="control-label col-md-4">
						{t}Opérateur :{/t}
					</label>
					<div class="col-md-8">
						<input id="operateur" class="form-control" name="operateur" value="{$peche.operateur}">
					</div>
				</div>
			</fieldset>
			<div class="form-group center">
				<button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
				{if $data.individu_id > 0 && $rights["param"] == 1 }
					<button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
				{/if}
		</div>
		</div>
		<div class="col-md-6 form-horizontal">
			<fieldset>
			<legend>{t}Liste des expérimentations de rattachement{/t}</legend>
				<table class="table" id="experimentations">
				{section name=lst loop=$experimentations}
					<tr>
						<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="exp_id[]" value="{$experimentations[lst].exp_id}" {if $experimentations[lst].individu_id > 0}checked{/if}>
								{$experimentations[lst].exp_nom}
							</label>
						</div>
						</td>
					</tr>
				{/section}
				</table>
			</fieldset>
		</div>
	{$csrf}
</form>
</div>


<span class="red">*</span>
<span class="messagebas">{t}Champ obligatoire{/t}</span>
