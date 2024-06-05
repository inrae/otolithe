<h2>{t}Consultation de la lecture de pièces{/t}</h2>
{include file="photolecture/lectureSearch.tpl"}
{if $isSearch == 1}
<div class="row">
<div class="col-md-12">
<table id="idListe" class="table table-bordered table-hover datatable" >
<thead>
<tr>
<th>{t}Individu{/t}</th>
<th>{t}Pièce{/t}<br>{t}traitement{/t}</th>
<th>{t}Photo{/t}<br>{t}Couleur/NB{/t}</th>
<th>{t}Résolution de prise de vue{/t}</th>
<th>{t}Date de prise de vue{/t}</th>
<th>{t}Longueur de référence{/t}</th>
<th>{t}Lecteur{/t}</th>
<th>{t}Date de lecture{/t}</th>
<th>{t}Résolution de lecture{/t}</th>
<th>{t}Longueur de référence mesurée{/t}</th>
<th>{t}Longueur réelle totale de la mesure{/t}</th>
<th>{t}Age{/t}</th>
{if $droits.gestion == 1}
<th class="center">
<img src="/display/images/delete.png" height="25">
</th>
{/if}
</tr>
</thead>
<tdata>
{section name="lst" loop=$data}
<tr>
<td>
<a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].codeindividu}<br>{$data[lst].tag}
</a>
</td>
<td>
<a href="index.php?module=pieceDisplay&piece_id={$data[lst].piece_id}">
{$data[lst].piecetype_libelle}
</a>
<br>{$data[lst].traitementpiece_libelle}</td>
<td>
<a href="index.php?module=photoDisplay&photo_id={$data[lst].photo_id}">
{$data[lst].photo_nom}
</a>
<br>{$data[lst].color}</td>
<td><div class="center">{$data[lst].photo_width}x{$data[lst].photo_height}</div></td>
<td>{$data[lst].photo_date}</td>
<td><div class="center">{$data[lst].long_reference}</div></td>
<td>{$data[lst].lecteur_prenom} {$data[lst].lecteur_nom}</td>
<td>
<a href="index.php?module=photolectureDisplay&photolecture_id={$data[lst].photolecture_id}&photo_id={$data[lst].photo_id}">
{$data[lst].photolecture_date}
</a>
</td>
<td><div class="center">{$data[lst].photolecture_width}x{$data[lst].photolecture_height}</div></td>
<td>{$data[lst].long_ref_mesuree}</td>
<td>{$data[lst].long_totale_reel}</td>
<td><div class="center">{$data[lst].age}</div></td>
{if $droits.gestion == 1}
<td class="center">
<a href="index.php?module=photolectureDelete&photolecture_id={$data[lst].photolecture_id}">
<img src="/display/images/delete.png" height="25">
</a>
</td>
{/if}
</tr>
{/section}
</tdata>
</table>
</div>
</div>
{/if}

