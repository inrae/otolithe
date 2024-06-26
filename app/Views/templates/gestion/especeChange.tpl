<h2>{t}Modification d'une espèce{/t}</h2>
<a href="especeList">
<img src="display/images/list.png" height="25">
{t}Retour à la liste{/t}
</a> 

<div class="row">
<div class="col-md-6">
<fieldset>
<legend>{t}Description de l'espèce{/t}</legend>
<form method="post" id="especeChange" class="form-horizontal protoform" action="index.php">
<input type="hidden" name="moduleBase" value="espece">
<input type="hidden" name="action" value="Write">
<input type="hidden" name="espece_id" value="{$data.espece_id}">


<div class="form-group">
<label for="nom_id" class="control-label col-md-4">{t}Nom latin :{/t}<span class="red">*</span></label>
<div class="col-md-8">
<input class="form-control" id="nom_id" name="nom_id" value="{$data.nom_id}" required autofocus>
</div>
</div>

<div class="form-group">
<label for="nom_id" class="control-label col-md-4">{t}Nom français :{/t}</label>
<div class="col-md-8">
<input class="form-control" id="nom_id" name="nom_id" value="{$data.nom_id}" >
</div>
</div>

<div class="form-group">
<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.espece_id>0&&$rights["admin"] == 1}
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>
 </div>
{$csrf}
</form>
</fieldset>
</div>
</div>

<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
