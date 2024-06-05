<h2>{t}Liste des espèces{/t}</h2>

	<div class="row">
	<div class="col-md-6">
	{if $droits.gestion == 1}
	<a href="index.php?module=especeChange&espece_id=0">
	<img src="display/images/new.png" height="25">
	{t}Nouvelle espèce...{/t}
	</a>
	{/if}
<table id="ptList" class="table table-bordered table-hover datatable" data-searching="true" data-order='[[1,"asc"]]'>
<thead>
<tr>
<th>{t}Id{/t}</th>
<th>{t}Nom latin{/t}</th>
<th>{t}Nom français{/t}</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{$data[lst].espece_id}
</td>
<td>
{if $droits.gestion == 1}
<a href="index.php?module=especeChange&espece_id={$data[lst].espece_id}">
{/if}
{$data[lst].nom_id}
{if $droits.gestion == 1}</a>{/if}
</td>
<td>{$data[lst].nom_fr}</td>
</tr>
{/section}
</tbody>
</table>
</div>
</div>
