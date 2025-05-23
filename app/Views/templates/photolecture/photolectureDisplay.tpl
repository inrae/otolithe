<style type="text/css">
	body>iframe {
		display: none;
	}
</style>
<script>
	document.addEventListener("DOMContentLoaded", function(event) {
    var container = document.getElementById("container");
	container.style.width = "{$image_width}" + " px";
	container.style.height = "{$image_height}" + " px";
	container.style.border = "0 px";
	var legend = document.getElementById("legend");
});
</script>

<h2>{t}Affichage des mesures d'une pièce{/t}</h2>
<a href="{$moduleListe}">{t}Retour à la liste{/t}</a> >
<a href="individuDisplay?individu_id={$piece.individu_id}">{t}Retour au détail du poisson{/t}</a> >
<a href="pieceDisplay?piece_id={$piece.piece_id}">{t}Retour au détail de la pièce{/t}</a> >
<a href="photoDisplay?photo_id={$photo.photo_id}">{t}Retour à la photo{/t}</a>
<div class="row">
	<div class="col-lg-8 col-sm-12">
		{include file="gestion/individuCartouche.tpl"}

		{include file="gestion/pieceCartouche.tpl"}
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		{t}Résolution d'affichage :{/t} {$image_width}x{$image_height}
	</div>
</div>
<div id="container">
	<svg id="imagesvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
		style="width:{$image_width}px;height:{$image_height}px">
		<image x="0" y="0" width="{$image_width}" height="{$image_height}"
			xlink:href="photoGetPhoto?photo_id={$photo.photo_id}&sizeX={$image_width}&sizeY={$image_height}" />
		{section name="lst" loop=$data}
		<script>console.log({$data[lst].points})</script>
		{section name="lst1" loop=$data[lst].points}
		{if $smarty.section.lst1.index == 0 }
		{assign var = 'r' value = $data[lst].rayon_point_initial}
		{else}
		{assign var = 'r' value = '7'}
		{/if}
		<circle cx="{$data[lst].points[lst1].x}" cy="{$data[lst].points[lst1].y}" r="{$r}"
			style="stroke:{$data[lst].couleur}; fill:{$data[lst].couleur}; fill-opacity:{$fill}">
			<title>point {$smarty.section.lst1.index} {$data[lst].points[lst1].remarkable_type_name}</title>
		</circle>
		{/section}
		{/section}
	</svg>
</div>
<fielset class="col-sm-12">
	<legend>{t}Légende{/t}</legend>
	{section name="lst" loop=$data}
	<div id="legend" style="background-color:{$data[lst].couleur};display:inline">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	&nbsp;
	{$data[lst].lecteur_prenom} {$data[lst].lecteur_nom} - {t}lecture du{/t} {$data[lst].photolecture_date}
	- {t}Résolution{/t} : {$data[lst].photolecture_width}x{$data[lst].photolecture_height} -
	{t}Nature de la strie finale :{/t} {$data[lst].final_stripe_code} {$data[lst].final_stripe_value}
	- {t}Fiabilité de la lecture :{/t} {$data[lst].read_fiability}
	{if $data[lst].consensual_reading == 1} - {t}Lecture consensuelle{/t}{/if}
	- {t}Année de naissance estimée :{/t} {$data[lst].annee_naissance}
	- {t}Points remarquables :{/t}
	<script>
		var rp = '{$data[lst].pointsJson}';
		if (rp) {
			var arp = JSON.parse(rp);
			var i = 0;
			Object.keys(arp).forEach(p => {
				if (arp[p].remarkable_type_id != undefined ) {
					if (i > 0) {
						document.write(", ");
					}
					document.write(p + ": " + arp[p].remarkable_type_name);
					i++;
				}
			})
		};
	</script>
	<br>
	{/section}
</fielset>