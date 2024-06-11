<h2>{t}Modification d'un lecteur{/t}</h2>
<div class="row">
<a href="lecteurList">{t}Retour à la liste des lecteurs{/t}</a>
</div>


<div class="row">
<div class="col-md-8 col-lg-6">
<form class="form-horizontal protoform" method="post" action="index.php">
<input type="hidden" name="moduleBase" value="lecteur">
<input type="hidden" name="action" value="Write">
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<div class="form-group">
<label for="nom" class="control-label col-md-4">{t}Nom :{/t} <span class="red">*</span> </label>
<div class="col-md-8">
<input class="form-control" id="nom" name="lecteur_nom" value="{$data.lecteur_nom}" required autofocus >
</div>
</div>
<div class="form-group">
<label for="" class="control-label col-md-4">{t}Prénom :{/t} </label>
<div class="col-md-8">
<input class="form-control" id="prenom" name="lecteur_prenom" value="{$data.lecteur_prenom}"  >
</div>
</div>
<div class="form-group">
<label for="" class="control-label col-md-4">{t}Login de connexion :{/t}<span class="red">*</span> </label>
<div class="col-md-8">
<input class="form-control" id="login" name="login" value="{$data.login}" required >
</div>
</div>
<fieldset>
<legend>
{t}Expérimentations autorisées :{/t}
</legend>
{foreach $exps as $exp}
<div class="col-sm-10 col-sm-offset-2">
      <div class="checkbox">
        <label>
<input type="checkbox" name="exp_id[]" value="{$exp["exp_id"]}" {if $exp["lecteur_id"] > 0}checked{/if}>
{$exp["exp_nom"]}
</label>
</div>
</div>
{/foreach}
</fieldset>
{if $rights.admin == 1}
<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.lecteur_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
</div>
{/if}
{$csrf}
</form>
</div>

</div>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
