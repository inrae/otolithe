<h2>{t}Liste des lecteurs{/t}</h2>
{if $droits["gestionCompte"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id=0">
{t}Nouveau...{/t}
</a>
{/if}
	<div class="row">
	<div class="col-md-6">
<table id="lecteurListe" class="table table-bordered table-hover datatable">
<thead>
<tr>
<th>{t}Nom{/t}</th>
<th>{t}Prénom{/t}</th>
<th>{t}Login de connexion{/t}</th>
</tr>
</thead><tdata>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["gestionCompte"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id={$data[lst].lecteur_id}">
{/if}
{$data[lst].lecteur_nom}
{if $droits["gestionCompte"] == 1}
</a>
{/if}
</td>
<td>
{$data[lst].lecteur_prenom}
</td>
<td>{$data[lst].login}</td>
</tr>
{/section}
</tdata>
</table>
</div>
</div>