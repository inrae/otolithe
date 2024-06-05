<h2>{t}Modification d'une expérimentation{/t}</h2>
<div class="row">
<a href="index.php?module=experimentationList">{t}Retour à la liste des expérimentations{/t}</a>
</div>
<div class="row">
<div class="col-md-8 col-lg-6">
<form class="form-horizontal protoform" method="post" action="index.php">
<input  type="hidden" name="moduleBase" value="experimentation">
<input type="hidden" name="action" value="Write">
<input type="hidden" name="exp_id" value="{$data.exp_id}">
<div class="form-group">
<label for="exp_nom" class="control-label col-md-4">{t}Nom :{/t} <span class="red">*</span>
</label>
<div class="col-md-8">
<input id="exp_nom" class="form-control" name="exp_nom" value="{$data.exp_nom}" required></div>
</div>
<div class="form-group">
<label for="" class="control-label col-md-4">{t}Description :{/t}</label>
<div class="col-md-8">
<input id="exp_description" class="form-control" name="exp_description" value="{$data.exp_description}" ></div>
</div>
<div class="form-group">
<label for="" class="control-label col-md-4">{t}Date de début  :{/t}</label>
<div class="col-md-8">
<input id="exp_debut" class="form-control datepicker" name="exp_debut" value="{$data.exp_debut}" >
</div>
</div>

<div class="form-group">
<label for="" class="control-label col-md-4">{t}Date de fin :{/t}</label>
<div class="col-md-8">
<input id="exp_fin" class="form-control datepicker" name="exp_fin" value="{$data.exp_fin}" >
</div>
</div>
<fieldset>
<legend>{t}Liste des lecteurs rattachés{/t}</legend>
{foreach $lecteurs as $lecteur}
<div class="col-sm-10 col-sm-offset-2">
      <div class="checkbox">
        <label>
<input type="checkbox" name="lecteur_id[]" {if $lecteur["is_reader"] == 1}checked{/if} value="{$lecteur["lecteur_id"]}">
&nbsp;
{$lecteur["lecteur_prenom"]}&nbsp;{$lecteur["lecteur_nom"]}
</label>
</div>
</div>
{/foreach}

</fieldset>

<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.exp_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>
 
{$csrf}
</form>
</div>
</div>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
