<h2>{t}Liste des types de pièces{/t}</h2>
{if $rights["param"] == 1}
<a href="piecetypeChange?piecetype_id=0">
{t}Nouveau type de pièce...{/t}
</a>
{/if}
	<div class="row">
	<div class="col-md-6">
<table id="ptList" class="table table-bordered table-hover datatable display">
<thead>
<tr>
<th>{t}Id{/t}</th>
<th>{t}Nom{/t}</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{if $rights["admin"] == 1}
<a href="piecetypeChange?piecetype_id={$data[lst].piecetype_id}">
{$data[lst].piecetype_id}
</a>
{else}
{$data[lst].piecetype_id}
{/if}
</td>
<td>{$data[lst].piecetype_libelle}</td>
</tr>
{/section}
</tbody>
</table>
</div>
</div>