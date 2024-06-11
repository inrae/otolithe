<script>
$(document).ready(function() {
/*$(".auto").change( function () {
	$("#searchBox").submit() ;
});
*/
var modulePostSearch = "{$modulePostSearch}";
	var lecteur_id = {$lectureSearch.lecteur_id};
	var espece_id = {$lectureSearch.espece_id};
$("#btn-submit").on("keyup click", function () { 
	$("#module").val(modulePostSearch);
	$("#searchBox").submit();
});
$("#btn-export").on("keyup click", function () { 
	$("#module").val("photolectureExport");
	$("#searchBox").submit();
});
function getLecteur() {
	var exp_id = $("#exp_id").val();
	$("#lecteur_id").empty();
	$.ajax ( {
		url: "index.php",
		data: { "module":"lecteurListFromExp", "exp_id": exp_id}
	}).done (function (value) { 
		var selected = "";
		var option = '<option value="0"';
		if (lecteur_id == 0) {
			option += ' selected';
		}
		option += '>{t}Sélectionnez...{/t}</option>';
		$.each(JSON.parse(value), function (i, obj) { 
			if (obj.lecteur_id == lecteur_id) {
				selected = "selected";
			} else {
				selected = "";
			}
			option += '<option value="'+obj.lecteur_id+'" ' + selected + '>' + obj.lecteur_prenom + " " + obj.lecteur_nom + "</option>";
		});
		$("#lecteur_id").append(option);
	}); 
}

function getEspece() {
	var exp_id = $("#exp_id").val();
	$("#espece_id").empty();
	$.ajax ( {
		url: "index.php",
		data: { "module":"individuGetListEspece", "exp_id": exp_id}
	}).done (function (value) { 
		var selected = "";
		var option = '<option value="0"';
		if (espece_id == 0) {
			option += ' selected';
		}
		option += '>{t}Sélectionnez...{/t}</option>';
		$.each(JSON.parse(value), function (i, obj) { 
			if (obj.espece_id == espece_id) {
				selected = "selected";
			} else {
				selected = "";
			}
			option += '<option value="'+obj.espece_id+'" ' + selected + '>' + obj.nom_id + "</option>";
		});
		$("#espece_id").append(option);
	}); 
}

$("#exp_id").change(function () { 
	getLecteur();
	getEspece();
});
/* Initialisation a l'ouverture de la page */
getLecteur();
getEspece();
});
</script>
<div class="col-sm-12">
	<form id="searchBox" method="GET" action="index.php" class="form-horizontal protoform">
		<input type="hidden" id="module" name="module" value="">
		<input type="hidden" name="isSearch" value="1">

		<div class="form-group">
			<label for="codeindividu" class="control-label col-sm-2">
				{t}Code ou TAG de l'individu :{/t}
			</label>
			<div class="col-sm-4">
				<input name="codeindividu" id="codeindividu" value="{$lectureSearch.codeindividu}" class="form-control" autofocus>
			</div>

			<label for="exp_id" class="control-label col-sm-2">
				{t}Expérimentation :{/t}
			</label>
			<div class="col-sm-4">
				<select class="auto form-control" id="exp_id" name="exp_id">
					{section name="lst" loop=$experimentation}
						<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $lectureSearch.exp_id}selected{/if}>
						{$experimentation[lst].exp_nom}
						</option>
					{/section}
				</select>
			</td>
		</div>
		</div>

		<div class="form-group">
			<label for="site" class="control-label col-sm-2">
				{t}Site de pêche :{/t}
			</label>
			<div class="col-sm-4">
				<select class="auto form-control combobox" id="site" name="site">
					<option value="">{t}Sélectionnez le site global de pêche{/t}</option>
					{section name="lst" loop=$site}
						<option value="{$site[lst].site}" {if $site[lst].site == $lectureSearch.site}selected{/if}>
					{$site[lst].site}
					</option>
					{/section}
				</select>
			</div>

			<label for="zonesite" class="control-label col-sm-2">
			{t}Zone précise de pêche :{/t}
			</label>
			<div class="col-sm-4">
				<select class="auto form-control combobox" name="zonesite">
					<option value="">{t}Sélectionnez le site précis de pêche{/t}</option>
					{section name="lst" loop=$zone}
						<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $lectureSearch.zonesite}selected{/if}>
						{$zone[lst].zonesite}
						</option>
					{/section}
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="lecteur_id" class="control-label col-sm-1">
				{t}Lecteur :{/t} 
			</label>
			<div class="col-sm-2">
				<select class="form-control" id="lecteur_id" name="lecteur_id">
				</select>
			</div>		
			<label for="espece_id" class="control-label col-sm-1">
				{t}Espèce :{/t}
			</label>
			<div class="col-sm-2">
				<select class="form-control" id="espece_id" name="espece_id">
				</select>
			</div>
			<label for="consensual" class="control-label col-sm-2">{t}Lecture consensuelle ?{/t}</label>
			<div class="col-sm-1" id="consensual">
				<input type="radio" name="consensual" value="0" {if $lectureSearch.consensual == 0}checked{/if}>{t}non{/t}
				<input type="radio" name="consensual" value="1" {if $lectureSearch.consensual == 1}checked{/if}>{t}oui{/t}
			</div>

			<div class="center col-sm-1">
				<button id="btn-submit" class="btn btn-success" type="button">{t}Rechercher...{/t}</button> 
			</div>
			{if $rights.manage == 1}
				<div class="center col-sm-1">
					<button id="btn-export" class="btn btn-info" type="button">{t}Exporter la liste{/t}</button>
				</div>
			{/if}
		</div>
	{$csrf}
</form>
</div>
