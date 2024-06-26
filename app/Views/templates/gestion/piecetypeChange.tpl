<h2>{t}Modification d'un type de pièce{/t}</h2>
<div class="row">
<a href="piecetypeList">{t}Retour à la liste{/t}</a>
</div>
<div class="row">
<div class="col-md-8 col-lg-6">

<form class="form-horizontal protoform" method="post" action="index.php">
<input  type="hidden" name="moduleBase" value="piecetype">
<input type="hidden" name="action" value="Write">
<input type="hidden" name="piecetype_id" value="{$data.piecetype_id}">
<div class="form-group">
<label for="piecetype_libelle" class="control-label col-md-4">
{t}Nom du type de pièce :{/t}<span class="red">*</span>
</label>
<div class="col-md-8">
<input id="piecetype_libelle" class="form-control" name="piecetype_libelle" value="{$data.piecetype_libelle}" required></td>
</div>
</div>
<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.piecetype_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>
{$csrf}
</form>
</div>
</div>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>