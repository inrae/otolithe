<!--script type="text/javascript" src="/display/javascript/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script-->
<script type="text/javascript" src="/display/javascript/jquery-svg-1.5/jquery.svg.min.js"></script>
<link type="text/css" href="/display/javascript/jquery-svg-1.5/jquery.svg.css" rel="stylesheet">
<style type="text/css">
	body>iframe {
		display: none;
	}
</style>

<script>

	var compteur = 0;
	var numPointLigne = 1;
	var pointLigneX;
	var pointLigneY;
	var pointLigne2X;
	var pointLigne2Y;

	$(document).ready(function () {
		var image_width = $('#image_width').val();
		var image_height = $('#image_height').val();
		$('#container')
			.css({ "width": image_width + "px", "height": image_height + "px", "border": "none" })
			.svg({ onLoad: drawIntro })

	});

	function drawIntro(svg) {
		/* affichage de la photo et dessin des points existants */
		var image_width = $('#image_width').val();
		var image_height = $('#image_height').val();
		var r = 0;
		var cx = 0;
		var cy = 0;
		var couleur = "";
		var fillOpacity = 0;

		var lien = "photoGetPhoto?photo_id={$photo.photo_id}&sizeX={$image_width}&sizeY={$image_height}";

		var myImage = svg.group();
		svg.image(myImage, 0, 0, image_width, image_height, lien);
		//var myImage = svg.image(0, 0, image_width, image_height, "");
		{section name = "lst" loop = $mesurePrec }
		{section name = "lst1" loop = $mesurePrec[lst].points }
		{ if $smarty.section.lst1.index == 0 }
		{ if $mesurePrec[lst].rayon_point_initial > 0}
		{assign var = 'r' value = $mesurePrec[lst].rayon_point_initial }
		{else }
		{assign var = 'r' value = '7' }
		{/if }
		{else }
		{assign var = 'r' value = '7' }
		{/if }
		cx = '{$mesurePrec[lst].points[lst1].x}';
		cy = '{$mesurePrec[lst].points[lst1].y}';
		r = '{$r}';
		couleur = '{$mesurePrec[lst].couleur}';
		fillOpacity = '{$fill}';
		svg.circle(myImage, cx, cy, r, { 'stroke': couleur, 'fill': couleur, 'fill-opacity': fillOpacity });
		{/section }
		{/section }

		$("#resetCompteur").click(function (event) {
			/* Reinitialisation du compteur */
			compteur = 0;
			event.preventDefault();
		});


		$(myImage).click(function (e) {
			//var parentOffset = $(this).parent().offset(); 
			//or $(this).offset(); if you really just want the current element's offset
			var parentOffset = $(this).offset();
			var relX = e.pageX - parentOffset.left;
			var relY = e.pageY - parentOffset.top;
			var svg = $('#container').svg('get');
			setCircle(svg, relX, relY, 0);
		});
		/*
		 * Generation des points existants (mode modification)
		 */
		{ if $data.photolecture_id > 0}
		$("#modeLecture").val(1);
		{section name = "lst" loop = $data.points }
		{ if $smarty.section.lst.index == 0 }
		var rayon_initial = 1;
		{else }
		var rayon_initial = 0;
		{/if }
		setCircle(svg, { $data.points[lst].x }, { $data.points[lst].y }, rayon_initial, { $data.points[lst].remarkablePoint });
		{/section }
		$("#modeLecture").val(2);
		{section name = "lst" loop = $data.points_ref_lecture }
		setCircle(svg, { $data.points_ref_lecture[lst].x }, { $data.points_ref_lecture[lst].y }, 0, { $data.points_ref_lecture[lst].remarkablePoint });
		{/section }
		$("#modeLecture").val(1);
		{/if }
	};

	function setCircle(svg, x, y, rayon_initial, isRemarkable) {
		var ident = "circle" + compteur;
		var valeurCompteur = compteur;
		compteur++;

		var myCircle = svg.group();
		var X = Math.floor(x);
		var Y = Math.floor(y);
		var modeLecture = $('#modeLecture').val();
		if (modeLecture == 2) {
			var couleur = 'green';
		} else if (modeLecture == 3) {
			/*
			 * Traitement du trace de la ligne
			 */
			var couleur = 'blue';
		} else {
			var couleur = 'red';
		};
		if (modeLecture == 0 || rayon_initial == 1) {
			var rayon = $("#rayon_cercle").val();
		} else {
			var rayon = 7;
		}
		svg.circle(myCircle, X, Y, rayon, {
			id: ident, stroke: couleur, fill: 'rgba(0,0,0,0)'
		});
		svg.line(myCircle, X, Y - 7, X, Y + 7, { stroke: couleur, strokeWidth: 1 });
		svg.line(myCircle, X - 7, Y, X + 7, Y, { stroke: couleur, strokeWidth: 1 });
		svg.text(myCircle, X + 20, Y + 20, valeurCompteur + "", { 'text-anchor': 'middle', 'fill': couleur, 'pointer-events': 'none' });
		;
		if (modeLecture != 3) {
			/*
			 * Ajout des coordonnees dans un champ input
			 */
			var ligneDebut = '<tr id="ligne' + valeurCompteur + '"><td>' + valeurCompteur + '</td>';
			var pointX = '<td><input type="text" size="10" name="pointx' + valeurCompteur + '" id="pointx' + valeurCompteur + '" value="' + X + '" ></td>';
			var pointY = '<td><input type="text" size="10" name="pointy' + valeurCompteur + '" id="pointy' + valeurCompteur + '" value="' + Y + '" ></td>';
			var rang = '<td><input type="text" size="10" name="rang' + valeurCompteur + '" id="rang' + valeurCompteur + '" value="' + valeurCompteur * 10 + '" ></td>';
			var pointReference = "<td></td>";
			if (modeLecture == 2) {
				pointReference = '<td><input type="text" size="10" name="pointRef' + valeurCompteur + '" id="pointRef' + valeurCompteur + '" value="1" ></td>';
			} else {
				pointReference = '<td>&nbsp;</td>';
			};
			var remarkablePoint = '<td class="center"><input type="checkbox" name="remarkablePoint' + valeurCompteur + '" id="remarkablePoint' + valeurCompteur + '" value="1"';
			if (isRemarkable == 1) {
				remarkablePoint += ' checked ';
			}
			remarkablePoint += '></td>';
			var dp = '<td class="center" id="point' + valeurCompteur + '"><img src="display/images/delete.png" height="25" title="{t}Supprimer le point courant{/t}"></td>';
			var ligneFin = "</tr>";
			$('#tableData').append(ligneDebut + pointX + pointY + rang + remarkablePoint + pointReference + dp + ligneFin);
		} else {
			/*
			 * Traitement du trace de la ligne
			 */
			if (numPointLigne == 1) {
				var monPointLigne = 1;
				pointLigneX = X;
				pointLigneY = Y;
			} else if (numPointLigne == 2) {
				var monPointLigne = 2;
				pointLigne2X = X;
				pointLigne2Y = Y;
				svg.line(pointLigneX, pointLigneY, X, Y, {
					"id": "ligne", stroke: couleur, strokeWidth: 1
				});
			}
			numPointLigne++;
		}
		/* suppression du point depuis le tableau */
		$("#point" + valeurCompteur).mousedown(function (event) {
			console.log("suppression du point " + valeurCompteur);
			$("#pointx" + valeurCompteur).remove();
			$("#pointy" + valeurCompteur).remove();
			$("#ligne" + valeurCompteur).remove();
			$(myCircle).remove();
			if ((valeurCompteur + 1) == compteur) {
				compteur--;
			}
		});
		/*
		 * Generation des evenements dans l'objet
		 */
		$(myCircle)
			.hover(function () {
				$(this).css({ "cursor": "pointer" });
			})
			/*	.mouseenter(function() {
					$("#text"+valeurCompteur).attr("disable","false");
				})
				.mouseleave(function() {
					$("#text"+valeurCompteur).attr("disable","true");
				})*/
			/*
				* Supprime le point 
				*/
			.mousedown(function (event) {
				if (event.which == 1) {
					if ($(event.currentTarget).data('oneclck') == 1) {
						if (modeLecture != 3) {
							$("#pointx" + valeurCompteur).remove();
							$("#pointy" + valeurCompteur).remove();
							$("#ligne" + valeurCompteur).remove();
							if ((valeurCompteur + 1) == compteur) {
								compteur--;
							}
							$(this).remove();
						} else {
							// traitement de la suppression de la ligne
							var ligne = $('#ligne');
							ligne.remove();
							numPointLigne--;
							if (numPointLigne < 1) numPointLigne = 1;
							$(this).remove();
						};
						return false;
					}
					else {
						$(this).data('oneclck', 1);
						setTimeout(function () {
							$(event.currentTarget).data('oneclck', 0);
						}, 300);
					}
				}
			})

	};

</script>
<h2>{t}Mesure d'un otolithe ou d'une pièce calcifiée{/t}</h2>
<a href="{$moduleListe}"
	onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour
	à la liste{/t}</a> >
<a href="individuDisplay?individu_id={$piece.individu_id}"
	onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour
	au détail du poisson{/t}</a> >
<a href="pieceDisplay?piece_id={$piece.piece_id}"
	onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour
	au détail de la pièce{/t}</a> >
<a href="photoDisplay?photo_id={$data.photo_id}"
	onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour
	à la photo{/t}</a>
<div class="row">
	<div class="col-lg-8 col-sm-12">
		{include file="gestion/individuCartouche.tpl"}

		{include file="gestion/pieceCartouche.tpl"}
	</div>
</div>
<form class="form-inline" name="myForm" id="myForm" action="photolectureWrite" method="POST">
	<input type="hidden" name="photo_id" id="photo_id" value="{$data.photo_id}">
	<input type="hidden" name="lecteur_id" id="lecteur_id" value="{$data.lecteur_id}">
	<input type="hidden" name="photolecture_date" value="{$data.photolecture_date}">
	<input type="hidden" name="photolecture_id" value="{$data.photolecture_id}">
	<div class="col-sm-12">
		<div class="row">
			<div class="form-group col-sm-12">
				<div class="col-sm-6">
					<label class="form-label" for="valider1">
						{t}Enregistrez les points positionnés :{/t}
					</label>
					<button type="submit" class="btn btn-primary" id="valider1">
						{t}Valider{/t}
					</button>
				</div>
				<div class="col-sm-6">
					<label class="form-label" for="resetCompteur">
						{t}Si tous les points ont été supprimés, vous pouvez :{/t}
					</label>
					<button class="btn btn-info" id="resetCompteur"
						title="{t}Uniquement si tous les points ont été supprimés{/t}">
						{t}Réinitialiser le compteur{/t}
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Affichage de la photo -->
	<div id="container" class="col-sm-12 container">
	</div>

	<!-- Parametres de saisie -->
	<div class="form-horizontal col-sm-12">
		<div class="row">
			<div class="form-group col-sm-12">

				<div class="col-sm-12">
					<label for="modeLecture" class="control-label col-sm-4">
						{t}Type de lecture pour le prochain point :{/t}
					</label>
					<select class="form-control col-sm-8" id="modeLecture">
						<option value="0">{t}Point initial avec cercle élargi{/t}</option>
						<option value="1" selected>{t}Lecture des points{/t}</option>
						<option value="2">{t}Mesure de la longueur de référence{/t}</option>
						<option value="3">{t}Tracé d'une ligne sur la photo (aide à la mesure){/t}</option>
					</select>
				</div>
				<label for="photo_height" class="control-label col-sm-4">
					{t}Taille originale de la photo :{/t}
				</label>
				<div class="col-sm-8">
					<input name="photo_width" class="form-control" id="photo_width" value="{$photo.photo_width}"
						readonly>
					x
					<input name="photo_height" class="form-control" id="photo_height" value="{$photo.photo_height}"
						readonly>
				</div>
				<label for="image_width" class="control-label col-sm-4">
					{t}Taille de lecture de la photo :{/t}
				</label>
				<div class="col-sm-8">
					<input class="form-control" name="photolecture_width" id="image_width" value="{$image_width}"
						readonly>x
					<input class="form-control" name="photolecture_height" id="image_height" value="{$image_height}"
						readonly>
				</div>

				<label for="coef_correcteur" class="control-label col-sm-4">
					{t}Coefficient de correction de la taille :{/t}
				</label>
				<input class="form-control col-sm-8" name="coef_correcteur" id="coef_correcteur"
					value="{$coef_correcteur}" readonly>
			</div>

			<label for="rayon_cercle" class="control-label col-sm-4">
				{t}Rayon (en pixels) du cercle élargi :{/t}
			</label>
			<div class="col-sm-8">
				<input id="rayon_cercle" class="form-control" name="rayon_point_initial"
					value="{$data.rayon_point_initial}">
			</div>

			<label for="calculAuto" class="control-label col-sm-4">
				{t}Recalcul automatique de l'ordre des points ?{/t}
			</label>
			<div class="col-sm-8">
				<label class="radio-inline" id="calculAuto">
					<input type="radio" id="calculAuto1" name="calculAuto" value="1" checked>{t}oui{/t}
				</label>
				<label class="radio-inline">
					<input type="radio" id="calculAuto0" name="calculAuto" value="0">{t}non{/t}
				</label>
			</div>

			<label for="rayon_cercle" class="control-label col-sm-4">
				{t}Nature de la strie finale :{/t}
			</label>
			<div class="col-sm-8">
				<select name="final_stripe_id" id="final_stripe_id" class="form-control">
					<option value="" {if $data.final_stripe_id=="" }selected{/if}></option>
					{section name=lst loop=$finalStripe}
					<option value="{$finalStripe[lst].final_stripe_id}" {if
						$finalStripe[lst].final_stripe_id==$data.final_stripe_id}selected{/if}>
						{$finalStripe[lst].final_stripe_code} {$finalStripe[lst].final_stripe_libelle}
					</option>
					{/section}
				</select>
			</div>

			<label for="read_fiability" class="control-label col-sm-4">
				{t}Fiabilité de la lecture :{/t}
			</label>
			<div class="col-sm-8">
				<select name="read_fiability" id="read_fiability" class="form-control">
					<option value="" {if $data.read_fiability=="" }selected{/if}></option>
					<option value="0" {if $data.read_fiability=="0" }selected{/if}>0</option>
					<option value="0.5" {if $data.read_fiability=="0.5" }selected{/if}>0.5</option>
					<option value="1" {if $data.read_fiability=="1" }selected{/if}>1</option>
				</select>
			</div>
			<label for="consensual_reading" class="control-label col-sm-4">
				{t}Lecture consensuelle :{/t}
			</label>
			<div class="col-sm-8">
				<label class="radio-inline" id="consensual_reading">
					<input type="radio" value="1" name="consensual_reading" {if
						$data.consensual_reading==1}checked{/if}>{t}oui{/t}
				</label>
				<label class="radio-inline">
					<input type="radio" value="0" name="consensual_reading" {if $data.consensual_reading
						!=1}checked{/if}>{t}non{/t}
				</label>
				<label for="annee_naissance" class="control-label">
					{t}Année de naissance estimée :{/t}
				</label>
				<input class="nombre" id="annee_naissance" name="annee_naissance" value="{$data.annee_naissance}">
			</div>
			<label for="commentaire" class="control-label col-sm-4">
				{t}Commentaires{/t}
			</label>
			<div class="col-sm-8">
				<textarea class="form-control" rows="3" cols="50" id="commentaire"
					name="commentaire">{$data.commentaire}</textarea>
			</div>
		</div>
	</div>

	<fieldset class="col-sm-12">
		<legend>{t}Points sélectionnés{/t}</legend>
		<table id="tableData" class="table table-bordered ">
			<tr>
				<td colspan='7'>
					<label class="form-label" for="valider_bas">
						{t}Enregistrez les points positionnés :{/t}
					</label>
					<button id="valider_bas" type="submit" class="btn btn-primary">{t}Valider{/t}</button>
				</td>
			</tr>
			<tr>
				<th>{t}N°{/t}</th>
				<th>X</th>
				<th>Y</th>
				<th>{t}Ordre de lecture{/t}</th>
				<th>{t}Point remarquable{/t}</th>
				<th>{t}Point de mesure de la longueur de référence{/t}</th>
			</tr>
		</table>
	</fieldset>
	{$csrf}
</form>
<div class="bg-info col-md-8 col-lg-6 col-sm-12">
	<ul>
		<li>
			{t}Pour supprimer un point, réalisez un double-clic sur celui-ci.{/t}
		</li>
		<li>
			{t}Vous pouvez modifier manuellement l'ordre de lecture d'un point, si nécessaire.{/t}
		</li>
		<li>
			{t}Pour tracer une ligne, positionnez le premier point, puis le second. Pour supprimer la ligne, supprimez
			d'abord le second point, avant de toucher au premier point.{/t}
		</li>
		<li>
			{t}Le recalcul automatique de l'ordre des points ne fonctionne que si le premier point (origine) est saisi
			en premier (valeur "ordre de lecture" la plus faible de la série).{/t}
		</li>
	</ul>
</div>
<fielset class="col-sm-12">
	<legend>{t}Légende{/t}</legend>
	{section name="lst" loop=$mesurePrec}
	<div style="background-color:{$mesurePrec[lst].couleur};display:inline">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	&nbsp;
	{$mesurePrec[lst].lecteur_prenom} {$mesurePrec[lst].lecteur_nom} - {t}lecture du{/t}
	{$mesurePrec[lst].photolecture_date}
	- {t}Résolution{/t} : {$mesurePrec[lst].photolecture_width}x{$mesurePrec[lst].photolecture_height}
	- {t}Points remarquables :{/t}
	<script>
		var rp = "{$mesurePrec[lst].remarkable_points}";
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
	<br>
	{/section}
</fielset>