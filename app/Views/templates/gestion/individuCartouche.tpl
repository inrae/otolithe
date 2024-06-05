
<div class=" col-sm-12 col-lg-6 form-display">
<div class="row">
<div class="col-sm-4">
<a href="index.php?module=individuDisplay&individu_id={$individu.individu_id}">
<img src="display/images/fish.png" height="25">
</a>
{$individu.nom_id} 
</div>
<div class="col-sm-4">{t}Code :{/t} {$individu.codeindividu}</div>
<div class="col-sm-4">{$individu.sexe_libelle}</div>
</div>
<div class="row">
<div class="col-sm-4">
{if strlen($individu.peche_date) > 0}
 {t}Date de pêche :{/t} {$individu.peche_date}
{/if}
</div>
<div class="col-sm-6">{t}Tag :{/t} {$individu.tag}</div>
</div>
</div>