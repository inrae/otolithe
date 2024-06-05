<h2>{t}Liste des expérimentations{/t}</h2>
{if $droits["gestionCompte"] == 1}
<a href="index.php?module=experimentationChange&exp_id=0">
{t}Nouvelle experimentation...{/t}
</a>
{/if}
	<div class="row">
	<div class="col-md-6">
<table id="expList" class="table table-bordered table-hover datatable">
<thead>
<tr>
<th>{t}Id{/t}</th>
<th>{t}Nom{/t}</th>
<th>{t}Description{/t}</th>
<th>{t}Date de début{/t}</th>
<th>{t}Date de fin{/t}</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["admin"] == 1}
<a href="index.php?module=experimentationChange&exp_id={$data[lst].exp_id}">
{$data[lst].exp_id}
</a>
{else}
{$data[lst].exp_id}
{/if}
</td>
<td>{$data[lst].exp_nom}</td>
<td>{$data[lst].exp_description}</td>
<td>{$data[lst].exp_debut}</td>
<td>{$data[lst].exp_fin}</td>
</tr>
{/section}
</tbody>
</table>
</div>
</div>
