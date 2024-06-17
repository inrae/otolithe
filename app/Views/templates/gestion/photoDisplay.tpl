<script>
	$(document).ready(function () {
		/*
		 * gestion des cookies pour conserver les valeurs sélectionnées
		 */
		var ck_resolution = Cookies.get('resolution');
		if (ck_resolution === undefined) {
			ck_resolution = 1;
		}
		$(".resolution").val(ck_resolution).change();
		$(".resolution").change(function () {
			Cookies.set('resolution', $(this).val(), { expires: 30, secure: true });
		});
		var ck_fill = Cookies.get('fillFactor');
		if (ck_fill === undefined) {
			ck_fill = 1;
		}
		$("#fill").val(ck_fill).change();
		$("#fill").change(function () {
			Cookies.set('fillFactor', $(this).val(), { expires: 30, secure: true });
		});
	});
</script>

<h2>{t}Affichage d'une photo{/t}</h2>
<div class="col-sm-12">
	<div class="row">
		<a href="{$moduleListe}">
			{t}Retour à la liste{/t}
		</a> >
		<a href="individuDisplay?individu_id={$piece.individu_id}">
			{t}Retour au détail du poisson{/t}
		</a> >
		<a href="pieceDisplay?piece_id={$data.piece_id}">
			{t}Retour au détail de la pièce{/t}
		</a>
	</div>
	<div class="row">
		<div class="col-lg-8">
			{include file="gestion/individuCartouche.tpl"}
			{include file="gestion/pieceCartouche.tpl"}
		</div>
	</div>
	{if $rights.manage == 1}
	<div class="row">
		<div class="col-sm-12">
			<a href="photoChange?photo_id={$data.photo_id}&piece_id={$data.piece_id}">
				{t}Modifier la photo...{/t}
			</a>
		</div>
	</div>
	{/if}
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="form-display">
				<dl class="dl-horizontal">
					<dt>{t}Nom de la photo :{/t} </dt>
					<dd>{$data.photo_nom}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Description :{/t} </dt>
					<dd>{$data.description}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Nom du fichier :{/t} </dt>
					<dd>{$data.photo_filename}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Date de prise de vue :{/t} </dt>
					<dd>{$data.photo_date}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Couleur :{/t} </dt>
					<dd>
						{if $data.color == "NB"}{t}Noir et blanc{/t}{else}{t}Couleur{/t}{/if}
					</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Type de lumière :{/t} </dt>
					<dd>{$data.lumieretype_libelle}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Grossissement :{/t} </dt>
					<dd>{$data.grossissement}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Repère :{/t} </dt>
					<dd>{$data.repere}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}URI :{/t} </dt>
					<dd>{$data.uri}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Repère de mesure - longueur de référence :{/t} </dt>
					<dd>{$data.long_reference}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Taille en pixels de la longueur de référence dans la photo :{/t} </dt>
					<dd>{$data.long_ref_pixel}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>{t}Dimensions de la photo :{/t} </dt>
					<dd>{$data.photo_width}x{$data.photo_height}</dd>
				</dl>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<a href="photoGetPhoto?photo_id={$data.photo_id}&disposition=attachment&original_format=1"
				title="{t}Attention : le temps de chargement peut être (très) long, selon la taille originale de la photo !{/t}">
				<!--  img src="{$photoPath}"-->
				<img src="photoGetThumbnail?photo_id={$data.photo_id}">
				<br>
				{t}Télécharger la photo dans le format original{/t}
			</a>
		</div>
	</div>


	{if $rights.read == 1}
	<div class="row">
		<fieldset class="col-sm-12 col-md-8">
			<legend>{t}Créer une nouvelle lecture{/t}</legend>
			<div class="row">
				<div class="col-lg-12">
					<form class=" protoform form-inline" name="lecture" action="index.php" method="get">
						<input type="hidden" name="module" value="photolectureChange">
						<input type="hidden" name="photo_id" value="{$data.photo_id}">
						<input type="hidden" name="photolecture_id" value="0">
						<div class="form-group col-sm-12 form-horizontal">
							<label class="control-label col-sm-6" for="resolution">
								{t}Résolution (approximative) de lecture :{/t}
							</label>
							<select class="resolution form-control col-sm-3" name="resolution" id="resolution">
								<option value="1">800x600</option>
								<option value="2">1024x768</option>
								<option value="3">1280x1024</option>
								<option value="4">1600x1300</option>
								<option value="5">{t}format initial{/t}</option>
							</select>
							<button type="submit" class="btn btn-primary button-valid col-sm-3">
								{t}Réaliser une nouvelle lecture{/t}
							</button>
						</div>
						{$csrf}
					</form>
				</div>
			</div>
			<br>
		</fieldset>
	</div>
	{/if}
	<div class="row">
		<div class="col-sm-12">
			<fieldset>
				<legend>
					{t}Consultations individuelles, globales, modifications avec visualisation des points déjà tracés{/t}
				</legend>

				{if $ageDisplay != 1}
				<a href="photoDisplay?photo_id={$data.photo_id}&ageDisplay=1">
					{t}Afficher l'age calculé (nbre de points positionnés - 1) par chaque lecteur{/t}
				</a>
				{else}
				<a href="photoDisplay?photo_id={$data.photo_id}&ageDisplay=0">
					{t}Masquer l'age calculé (nbre de points positionnés - 1) par chaque lecteur{/t}
				</a>
				{/if}
				<form class="form-inline" name="affichage" action="photolectureSwap" methode="get">
					<input type="hidden" name="photo_id" value="{$data.photo_id}">
					<div class="row">
						<div class="col-lg-12">
							<table class="datatable-nopaging table-bordered table-hover" data-order='[[2,"desc"]]'>
								<thead>
									<tr>
										{if $rights.read == 1}
										<th>{t}Modification unique{/t}</th>
										{/if}
										<th>{t}Lecteur{/t}</th>
										<th>{t}Date de lecture{/t}</th>
										<th>{t}Résolution{/t}</th>
										{if $ageDisplay == 1}
										<th>{t}Age ou nb de segments positionnés (nb points - 1){/t}</th>
										<th>{t}Strie finale{/t}</th>
										<th>{t}Année de naissance estimée{/t}</th>
										<th>{t}Fiabilité de la lecture{/t}</th>
										<th>{t}Points remarquables{/t}</th>
										{/if}
										<th>{t}Longueur de référence mesurée{/t}</th>
										<th>{t}Longueur totale lue{/t}</th>
										<th>{t}Longueur réelle calculée{/t}</th>
										<th>{t}Lecture consensuelle{/t}</th>
										<th>{t}Commentaires{/t}</th>
										{if $rights.read == 1}
										<th>{t}Supprimer{/t}</th>
										{/if}
										<th>{t}Consulter...{/t}</th>
										<th>
											<div title="{t}Si coché, la lecture sélectionnée pourra être modifiée{/t}">
												{t}Lecture à modifier{/t}
											</div>
										</th>
									</tr>
								</thead>
								<tbody>
									{section name="lst" loop=$photolecture}
									<tr>
										{if $rights.read == 1}
										<td>
											<div class="center">
												<a
													href="photolectureChange?photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}">
													<img src="/display/images/edit.png" height="24" border="0">
												</a>
											</div>
										</td>
										{/if}
										<td>
											<a
												href="photolectureDisplay?photo_id={$data.photo_id}&photolecture_id={$photolecture[lst].photolecture_id}">
												{$photolecture[lst].lecteur_prenom} {$photolecture[lst].lecteur_nom}
											</a>
										</td>
										<td>
											{$photolecture[lst].photolecture_date}
										</td>
										<td>
											<div class="center">
												{$photolecture[lst].photolecture_width}x{$photolecture[lst].photolecture_height}
											</div>
										</td>
										{if $ageDisplay == 1}
										<td>
											<div class="center">
												{$photolecture[lst].age}
											</div>
										</td>
										<td class="center">
											{$photolecture[lst].final_stripe_code}
										</td>
										<td class="center">
											{$photolecture[lst].annee_naissance}
										</td>
										<td class="center">
											{$photolecture[lst].read_fiability}
										</td>
										<td class="center">
											<script>
												var rp = "{$photolecture[lst].remarkable_points}";
												if (rp.length > 0) {
													var arp = JSON.parse(rp);
													var i = 0;
													arp.forEach(function (p) {
														if (i > 0) {
															document.write(",");
														}
														document.write(p + 1);
														i++;
													})
												};
											</script>
										</td>
										{/if}
										<td>
											{$photolecture[lst].long_ref_mesuree}
										</td>
										<td>
											{$photolecture[lst].long_totale_lue}
										</td>
										<td>
											{$photolecture[lst].long_totale_reel}
										</td>
										<td class="center">
											{if $photolecture[lst].consensual_reading == 1}{t}oui{/t}{/if}
										</td>
										<td class="textareaDisplay">{$photolecture[lst].commentaire}</td>
										{if $rights.read == 1}
										<td>
											<div class="center">
												<a href="photolectureDelete?photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}"
													onclick="return confirm('Confirmez-vous la suppression ?'); return false">
													<img src="/display/images/delete.png" height="24" border="0">
												</a>
											</div>
										</td>
										{/if}
										<td>
											<div class="center">
												<input type="checkbox" name="photolecture_id[]"
													value="{$photolecture[lst].photolecture_id}" checked>
											</div>
										</td>
										<td>
											<div class="center">
												<input type="radio" name="photolecture_id_modif"
													value="{$photolecture[lst].photolecture_id}">
											</div>
										</td>
									</tr>
									{/section}
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="resolution">
								{t}Résolution (approximative) d'affichage :{/t}
							</label>
							<select class="resolution form-control" name="resolution" id="resolution1">
								<option value="1">800x600</option>
								<option value="2">1024x768</option>
								<option value="3">1280x1024</option>
								<option value="4">1600x1300</option>
								<option value="5">{t}format initial{/t}</option>
							</select>
							<label for="fill">
								{t}Facteur de transparence des cercles affichés :{/t}
							</label>
							<select class="form-control" id="fill" name="fill">
								<option value="0">{t}Transparent{/t}</option>
								<option value="0.1">{t}Légèrement ombré{/t}</option>
								<option value="0.3">{t}Ombré{/t}</option>
								<option value="0.5">{t}Semi-opaque{/t}</option>
								<option value="1">{t}Opaque{/t}</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12 col-md-8">
							<div class="col-sm-6">
								<label for="resolution">
									{t}Avec création d'une nouvelle lecture :{/t}
								</label>
								<input type="checkbox" name="photolecture_id_modif" value="0" id="photolecture_id_modif">
							</div>
							<div class="center col-sm-6">
								<button type="submit" class="btn btn-primary button-valid">
									{t}Déclencher l'affichage des lectures sélectionnées, avec ou sans création/modification d'une lecture{/t}
								</button>
							</div>
						</div>
					</div>
				{$csrf}
				</form>
			</fieldset>
		</div>
	</div>
</div>