<h2>{t}Modification d'une pièce{/t}</h2>
<a href="index.php?module={$moduleListe}">
	<img src="display/images/list.png" height="25">
	{t}Retour à la liste{/t}
</a>
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">
	<img src="display/images/fish.png" height="25">
	{t}Retour au détail du poisson{/t}
</a>
{if $data.piece_id > 0}
	<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">
		<img src="display/images/scale.png" height="25">
		{t}Retour au détail de la pièce{/t}</a>
{/if}
<div class="row">
  <div class="col-md-6">
    {include file="gestion/individuCartouche.tpl"}
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <fieldset>
      <legend>{t}Caractéristiques{/t}</legend>
      <form method="post" id="pieceChange" class="form-horizontal protoform" action="index.php">
        <input type="hidden" name="moduleBase" value="piece">
        <input type="hidden" name="action" value="Write">
        <input type="hidden" name="piece_id" value="{$data.piece_id}">
        <input type="hidden" name="individu_id" value="{$data.individu_id}">
        <div class="form-group">
          <label for="piecetype_id" class="control-label col-md-4">{t}Type de pièce :{/t}</label>
          <div class="col-md-8">
            <select class="form-control" id="piecetype_id" name="piecetype_id">
            {section name="lst" loop=$piecetype}
              <option value="{$piecetype[lst].piecetype_id}" {if $piecetype[lst].piecetype_id == $data.piecetype_id}selected{/if}>
                {$piecetype[lst].piecetype_libelle}
              </option>
            {/section}
          </select>
          </div>
        </div>
        <div class="form-group">
          <label for="piececode" class="control-label col-md-4">{t}Code de la pièce :{/t}</label>
          <div class="col-md-8">
            <input class="form-control" id="piececode" name="piececode" value="{$data.piececode}" maxlengh="255" size="45">
          </div>
        </div>
        <div class="form-group">
          <label for="traitementpiece_id" class="control-label col-md-4">{t}Traitement effectué :{/t}</label>
          <div class="col-md-8">
            <select class="form-control" id="traitementpiece_id" name="traitementpiece_id">
            {section name="lst" loop=$traitementpiece}
              <option value="{$traitementpiece[lst].traitementpiece_id}" {if $traitementpiece[lst].traitementpiece_id == $data.traitementpiece_id}selected{/if}>
                {$traitementpiece[lst].traitementpiece_libelle}
              </option>
            {/section}
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="" class="control-label col-md-4">
            {t}UUID :{/t}
          </label>
          <div class="col-md-8">
            <input id="uuid" class="form-control" name="uuid" value="{$data.uuid}">
          </div>
        </div>
        <div class="form-group">
        <div class="form-group center">
          <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
          {if $data.piece_id>0&&$droits["gestion"] == 1}
            <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
          {/if}
        </div>
        </div>
      {$csrf}
</form>
    </fieldset>
  </div>
</div>


