<h2>{t}Affichage d'une pièce{/t}</h2>
<a href="{$moduleListe}">
<img src="display/images/list.png" height="25">
{t}Retour à la liste{/t}
</a>
<a href="individuDisplay?individu_id={$data.individu_id}">
<img src="display/images/fish.png" height="25">
{t}Retour au poisson{/t}
</a>
<div class="row">
<div class="col-md-6">
{include file="gestion/individuCartouche.tpl"}
</div>
</div>
<div class="row">
<fieldset class="col-md-6">
<legend>{t}Détail de la pièce{/t}</legend>
{if $rights.manage == 1}
<a href="pieceChange?piece_id={$data.piece_id}&individu_id={$data.individu_id}">
<img src="display/images/edit.png" height="25">{t}Modifier...{/t}
</a>
{/if}
<div class="form-display">
<dl class="dl-horizontal">
<dt>{t}Type de pièce :{/t}</dt>
<dd>
{$data.piecetype_libelle}
</dd>
</dl>

<dl class="dl-horizontal">
<dt>{t}Code de la pièce :{/t}</dt>
<dd>{$data.piececode}</dd>
</dl>

<dl class="dl-horizontal">
<dt>{t}Traitement effectué :{/t}</dt>
<dd>{$data.traitementpiece_libelle}</dd>
</dl>
<dl class="dl-horizontal">
  <dt>{t}UUID :{/t}</dt>
  <dd>{$data.uuid}</dd>
</dl>
</div>
</fieldset>
</div>

<div class="row">
<fieldset class="col-md-6">
<legend>{t}Photos rattachées{/t}</legend>
{if $rights.manage == 1}
<a href="photoChange?photo_id=0&piece_id={$data.piece_id}">
<img src="display/images/camera.png" height="25">
{t}Nouvelle photo{/t}
</a>
{/if}
<table class="table table-bordered table-hover">
<thead>
<tr>
{if $rights.manage == 1}
<th class="center"><img src="display/images/edit.png"></th>
{/if}
<th>{t}Nom{/t}</th>
<th>{t}Description{/t}</th>
<th>{t}Date{/t}</th>
<th>{t}Couleur ?{/t}</th>
<th>{t}Dimensions{/t}</th>
<th>{t}Miniature{/t}</th>
</tr>
</thead>
<tbody>
{section name="lst" loop=$photo}
<tr>
{if $rights.manage == 1}
<td class="center" title="{t}Modifier...{/t}">
<a href="photoChange?photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}"> 
<img src="display/images/edit.png">
</a>
</td>
{/if}
<td>
<a href="photoDisplay?photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}">
{$photo[lst].photo_nom}
</a>
</td>
<td>{$photo[lst].description}</td>
<td>{$photo[lst].photo_date}</td>
<td class="center">{$photo[lst].color}</td>
<td>{$photo[lst].photo_width}x{$photo[lst].photo_height}</td>
<td>
<a href="photoDisplay?photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}">
<img src="photoGetThumbnail&photo_id={$photo[lst].photo_id}" height="200" border="0">
</a>
</td>
</tr>
{/section}
</tbody>
</table>
</fieldset>
</div>
<div class="col-md-6">
<fieldset>
<legend>{t}Liste des métadonnées rattachées{/t}</legend>
{if $rights.manage == 1}
<a href="piecemetadataChange?piece_id={$data.piece_id}&piecemetadata_id=0">
<img src="display/images/metadata.png" height="25">
{t}Nouveau...{/t}
</a>
{/if}
<table class="table datatable table-bordered table-hover" data-order='[[2,"desc"], [1, "asc"]]''>
<thead>
<tr>
{if $rights.manage == 1}
    <th class="center">
     <img src="display/images/edit.png" height="25">
    </th>
{/if}
<th>
{t}Type{/t}
</th>
<th>
{t}Date{/t}
</th>
<th>{t}Commentaire{/t}</th>
</thead>
<tbody>
{foreach $metadatas as $metadata}
    <tr>
    {if $rights.manage == 1}
        <td class="center">
            <a href="piecemetadataChange?piece_id={$data.piece_id}&piecemetadata_id={$metadata.piecemetadata_id}">
                <img src="display/images/edit.png" height="25">
            </a>
        </td>
    {/if}
    <td>
        {if $rights.manage == 1}
            <a href="piecemetadataDisplay?piece_id={$data.piece_id}&piecemetadata_id={$metadata.piecemetadata_id}">
                {$metadata.metadatatype_name}
            </a>
        {else}
            {$metadata.metadatatype_name}
        {/if}    
    </td>
    <td>{$metadata.piecemetadata_date}</td>
    <td class="textareaDisplay">{$metadata.piecemetadata_comment}</td>
    </tr>
{/foreach}
</tbody>
</table>
</fieldset>
{if $rights.manage == 1}
    <fieldset>
        <legend>{t}Importer des métadonnées{/t}</legend>
        <form id="metadataImport" class="form-horizontal protoform" method="post" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="module" value="piecemetadataImport">
            <input type="hidden" name="piece_id" value="{$data.piece_id}">
            <div class="form-group">
                <label for="upfile" class="control-label col-md-4"><span class="red">*</span> {t}Sélectionnez le fichier à importer (CSV) :{/t}</label>
                <div class="col-md-8">
                    <input type="file" name="upfile" required>
                </div>
            </div>
            <div class="form-group">
                <label for="separateur" class="control-label col-md-4">{t}Séparateur de champ :{/t}</label>
                <div class="col-md-8">
                    <select id="separateur" name="separateur" class="form-control">
                        <option value="t" selected>{t}Tabulation{/t}</option>
                        <option value=",">{t}virgule{/t}</option>
                        <option value=";">{t}point-virgule{/t}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="piecemetadata_date"  class="control-label col-md-4">{t}Date d'acquisition des données :{/t}</label>
                <div class="col-md-8">
                    <input id="piecemetadata_date" class="form-control datepicker" name="piecemetadata_date" value="{$data.piecemetadata_date}">
                </div>
            </div>
            <div class="form-group">
                <label for="piecemetadataComment"  class="control-label col-md-4">{t}Commentaire :{/t}</label>
                <div class="col-md-8">
                    <textarea id="piecemetadataComment" type="text" class="form-control" name="piecemetadata_comment">{$data.piecemetadata_comment}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="metadatatypeId" class="control-label col-md-4">{t}Modèle de métadonnées à utiliser :{/t}</label>
                <div class="col-md-8">
                    <select id="metadatatypeId" name="metadatatype_id" class="form-control">
                        {foreach $metadatatypes as $mt}
                            <option value="{$mt.metadatatype_id}" {if $data.metadatatype_id == $mt.metadatatype_id}selected{/if}>
                                {$mt.metadatatype_name}
                            </option>
                        {/foreach}
                    </select>
                </div>
            </div>

            <div class="form-group center">
                <button type="submit" class="btn btn-primary">{t}Importer les métadonnées{/t}</button>
            </div>
            <div class="bg-info">
                {t}Le module d'importation va vérifier que le fichier CSV comprenne les mêmes colonnes que celles attendues dans le modèle de métadonnées.{/t}
                <br>
                {t}Si le fichier contient des colonnes supplémentaires, l'importation échouera.{/t}
            </div>
        {$csrf}
</form>

    </fieldset>
{/if}
</div>
</div>
