<h2>{t}Modification d'une photo{/t}</h2>
<div class="row">
<div class="col-sm-12">
<div class="col-md-12">
<a href="{$moduleListe}">
<img src="display/images/list.png" height="25">
{t}Retour à la liste{/t}
</a>
<a href="individuDisplay?individu_id={$data.individu_id}">
<img src="display/images/fish.png" height="25">
{t}Retour au poisson{/t}
</a>
<a href="pieceDisplay?piece_id={$data.piece_id}">
<img src="display/images/scale.png" height="25">
{t}Retour au détail de la pièce{/t}
</a>
</div>
</div>
<div class="row">
<div class="col-lg-3 col-sm-6">
{include file="gestion/individuCartouche.tpl"}
</div>
<div class="col-lg-3 col-sm-6">
{include file="gestion/pieceCartouche.tpl"}
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="col-lg-6 col-sm-12">

<form class="form-horizontal protoform" id="photoForm" method="post" action="index.php" enctype="multipart/form-data">
<input  type="hidden" name="piece_id" value="{$data.piece_id}">
<input  type="hidden" name="photo_id" value="{$data.photo_id}">
<input  type="hidden" name="moduleBase" value="photo">
<input  type="hidden" name="action" value="Write">

<div class="form-group">
<label for="photo_nom" class="control-label col-md-4">{t}Nom de la photo :{/t}</label>
<div class="col-md-8">
<input id="photo_nom" class="form-control" name="photo_nom" value="{$data.photo_nom}" maxlength="255" size="50">
</div>
</div>
<div class="form-group">
<label for="description" class="control-label col-md-4">{t}Description :{/t}</label>
<div class="col-md-8">
<input id="description" class="form-control" name="description" value="{$data.description}" maxlength="255" size="50">
</div>
</div>
<div class="form-group">
		<label for="photoload" class="control-label col-md-4">{t}Fichier JPG ou TIFF contenant la photo :{/t}</label>
		<div class="col-md-8">
			<input id="MAX_FILE_SIZE" class="form-control" type="hidden" name="MAX_FILE_SIZE" value="{$maxfilesize}">
			<input id="photoload" class="form-control" type="file" name="photoload" accept="image/jpeg,image/jpg,image/tiff" >
		</div>
</div>
<div class="form-group">
<label for="photo_filename" class="control-label col-md-4">{t}Nom du fichier :{/t}</label>
<div class="col-md-8">
<input id="photo_filename" class="form-control" name="photo_filename" value="{$data.photo_filename}" maxlength="255" size="50" readonly>
</div>
</div>
<div class="form-group">
<label for="photo_date" class="control-label col-md-4">{t}Date de prise de vue :{/t}</label>
<div class="col-md-8">
<input id="photo_date" class="form-control datepicker" name="photo_date" id="photo_date" value="{$data.photo_date}" maxlength="10" size="10">
</div>
</div>
<div class="form-group">
<label for="color1" class="control-label col-md-4">{t}Couleur :{/t}</label>
<div class="col-md-8 radio">
<label>
<input id="color1" type="radio" name="color" value="NB" {if $data.color == "NB"}checked{/if}>{t}Noir et blanc{/t}
</label>
<label>
<input id="color2" type="radio" name="color" value="C" {if $data.color == "C"}checked{/if}>{t}Couleur{/t}
</label>
</div>
</div>
<div class="form-group">
<label for="lumieretype_id" class="control-label col-md-4">{t}Type de lumière :{/t}</label>
<div class="col-md-8">
<select id="lumieretype_id" class="form-control" name="lumieretype_id">
{section name="lst" loop=$lumieretype}
<option value="{$lumieretype[lst].lumieretype_id}" {if $data.lumieretype_id == $lumieretype[lst].lumieretype_id}selected{/if}>
{$lumieretype[lst].lumieretype_libelle}
</option>
{/section}
</select>
</div>
</div>
<div class="form-group">
<label for="grossissement" class="control-label col-md-4">{t}Grossissement :{/t}</label>
<div class="col-md-8">
<input id="grossissement" class="form-control" name="grossissement" value="{$data.grossissement}" maxlength="20" size="20">
</div>
</div>
<div class="form-group">
<label for="repere" class="control-label col-md-4">{t}Repère :{/t}</label>
<div class="col-md-8">
<input id="repere" class="form-control" name="repere" value="{$data.repere}" maxlength="20" size="20">
</div>
</div>
<div class="form-group">
<label for="URI" class="control-label col-md-4">{t}Adresse de stockage (fichiers dans arborescence) :{/t}</label>
<div class="col-md-8">
<input id="URI" class="form-control" name="URI" value="{$data.URI}" readonly>
</div>
</div>
<div class="form-group">
<label for="long_reference" class="control-label col-md-4">{t}Repère de mesure - longueur de référence :{/t}</label>
<div class="col-md-8">
<input id="long_reference" class="form-control nombre" name="long_reference" value="{$data.long_reference}" >
</div>
</div>
<div class="form-group">
<label for="long_ref_pixel" class="control-label col-md-4">{t}Taille en pixels de la longueur de référence dans la photo :{/t}</label>
<div class="col-md-8">
<input id="long_ref_pixel" class="form-control nombre" name="long_ref_pixel" value="{$data.long_ref_pixel}" >
</div>
</div>
<div class="form-group">
<label for="photo_width" class="control-label col-md-4">{t}Dimensions de la photo :{/t}</label>
<div class="col-md-8">
<input id="photo_width" class="form-control nombre" name="photo_width" value="{$data.photo_width}" readonly>x 
<input id="photo_height" class="form-control nombre" name="photo_height" value="{$data.photo_height}" readonly>
</div>
</div>


<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.photo_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>
{$csrf}
</form>

</div>
</div>
</div>
</div>


<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
