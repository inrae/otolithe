<h2>{t}Affichage du détail d'un individu{/t}</h2>
<a href="index.php?module={$moduleListe}">
<img src="display/images/list.png" height="25">
{t}Retour à la liste{/t}</a>
<div class="row">
<div class="col-md-12">
<fieldset class="col-md-6">
<legend>{t}Données générales{/t}</legend>
{if $droits.gestion == 1}
<a href="index.php?module=individuChange&individu_id={$data.individu_id}">
<img src="display/images/edit.png" height="25">
{t}Modifier...{/t}</a>
{/if}
<div class="form-display">
<dl class="dl-horizontal">
<dt>{t}Code de l'individu :{/t}</dt>
<dd>{$data.codeindividu}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Tag :{/t}</dt>
<dd>{$data.tag}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Espèce :{/t}</dt>
<dd>{$data.nom_id}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Sexe :{/t}</dt>
<dd>{$data.sexe_libelle}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Longueur (mm):{/t}</dt>
<dd>{$data.longueur}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Poids (g):{/t}</dt>
<dd>{$data.poids}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Remarque :{/t}</dt>
<dd>{$data.remarque}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Parasite :{/t}</dt>
<dd>{$data.parasite}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Age :{/t}</dt>
<dd>{$data.age}</dd>
</dl>
{if strlen($data.wgs84_x) > 0}
<dl class="dl-horizontal">
  <dt>{t}Coordonnées du point de capture (long/lat) :{/t}</dt>
  <dd>{$data.wgs84_x}</dd>
  <dd>{$data.wgs84_y}</dd>
  </dl>
{/if}
<dl class="dl-horizontal">
  <dt>{t}UUID :{/t}</dt>
  <dd>{$data.uuid}</dd>
</dl>
</div>
</fieldset>
<fieldset class="col-md-6">
<legend>{t}Pièces rattachées{/t}</legend>
{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id=0&individu_id={$data.individu_id}">
<img src="display/images/new.png" height="25">
{t}Nouvelle pièce{/t}</a>
{/if}
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>{t}Type{/t}</th>
<th>{t}Code{/t}</th>
<th>{t}Traitement réalisé{/t}</th>
<th>{t}Nbre photos rattachées{/t}</th>
</tr>
</thead>
<tbody>
{section name="lst" loop=$piece}
<tr>
<td><a href="index.php?module=pieceDisplay&piece_id={$piece[lst].piece_id}&individu_id={$data.individu_id}">
{$piece[lst].piecetype_libelle}
</a></td>
<td>{$piece[lst].piececode}</td>
<td>{$piece[lst].traitementpiece_libelle}</td>
<td><div class="center">{$piece[lst].nbphoto}</div></td>
</tr>
{/section}
</tbody>
</table>
</fieldset>
<fieldset class="col-md-6">
<legend>
{t}Expérimentation(s){/t}</legend>
<table class="table table-bordered table-hover">
<body>
{section name="lst" loop=$experimentation}
<tr>
<td>{$experimentation[lst].exp_nom}</td>
</tr>
{/section}
</body>
</table>
</fieldset>
</div>
<fieldset class="col-md-6">
<legend>{t}Données concernant la pêche{/t}</legend>
<div class="form-display">
<dl class="dl-horizontal">
<dt>{t}Site :{/t}</dt>
<dd>{$peche.site}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Zone précise :{/t}</dt>
<dd>{$peche.zonesite}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Date de pêche :{/t}</dt>
<dd>{$peche.peche_date}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Campagne :{/t}</dt>
<dd>{$peche.campagne}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Engin :{/t}</dt>
<dd>{$peche.peche_engin}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Pêcheur :{/t}</dt>
<dd>{$peche.personne}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Opérateur :{/t}</dt>
<dd>{$peche.operateur}</dd>
</dl>
</div>
</fieldset>
</div>

