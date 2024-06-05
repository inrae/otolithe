<h2>{t}Liste des poissons{/t}</h2>
<a href="index.php?module=individuChange&individu_id=0">{t}Code de l'individu{/t}</a>
{include file="gestion/individuSearch.tpl"}
{if $isSearch == 1}
{if $droits.gestion == 1}
<a href="index.php?module=individuChange&individu_id=0">
<img src="display/images/new.png" height="25">
{t}Nouveau poisson...{/t}</a>
{/if}
	<div class="row">
	<div class="col-md-12">
<table id="idListe" class="table table-bordered table-hover datatable" data-searching="true">
<thead>
<tr>
<th>{t}Code individu{/t}</th>
<th>{t}Tag{/t}</th>
<th>{t}Espèce{/t}</th>
<th>{t}Age{/t}</th>
<th>{t}Sexe{/t}</th>
<th>{t}Nbre de pièces{/t}</th>
<th>{t}Date de pêche{/t}</th>
<th>{t}Zone de pêche{/t}</th>
<th>{t}Expérimentation{/t}</th>
<th>{t}UUID{/t}</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$data}
<tr>
<td><a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].codeindividu}
</a>
</td>
<td>
<a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].tag}
</a>
</td>
<td>{$data[lst].nom_id}</td>
<td><div class="center">{$data[lst].age}</div></td>
<td><div class="center">{$data[lst].sexe_libellecourt}</div></td>
<td><div class="center">{$data[lst].nbrepiece}</div></td>
<td>{$data[lst].peche_date}</td>
<td>{$data[lst].site}<br>{$data[lst].zonesite}</td>
<td>{$data[lst].exp_nom}</td>
<td>{$data[lst].uuid}</td>
</tr>
{/section}
</tdata>
</table>
{/if}
<br>
</div>
</div>