<h2>{t}Liste des lecteurs{/t}</h2>
{if $rights["param"] == 1}
<a href="lecteurChange?lecteur_id=0">
	{t}Nouveau...{/t}
</a>
{/if}
<div class="row">
	<div class="col-md-6">
		<table id="lecteurListe" class="table table-bordered table-hover datatable display">
			<thead>
				<tr>
					<th>{t}Nom{/t}</th>
					<th>{t}Prénom{/t}</th>
					<th>{t}Login de connexion{/t}</th>
				</tr>
			</thead>
			<tbody>
				{section name=lst loop=$data}
				<tr>
					<td>
						{if $rights["param"] == 1}
						<a href="lecteurChange?lecteur_id={$data[lst].lecteur_id}">
							{/if}
							{$data[lst].lecteur_nom}
							{if $rights["param"] == 1}
						</a>
						{/if}
					</td>
					<td>
						{$data[lst].lecteur_prenom}
					</td>
					<td>{$data[lst].login}</td>
				</tr>
				{/section}
			</tbody>
		</table>
	</div>
</div>