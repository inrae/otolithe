<script {$csp_script_nonce}>
$(document).ready(function() {
  $("#checkPiece").change( function() {
		$('.checkPiece').prop('checked', this.checked);
  });
});
</script>

<div class="col-md-6">
  <form id="searchBox" method="GET" action="index.php" class="form-horizontal protoform" >
   <input type="hidden" name="module" value="pieceList">
    <div class="row">
      <label for="exp_id" class="control-label col-sm-3">
          {t}Expérimentation :{/t}
      </label>
      <div class="col-sm-6">
        <select class="auto form-control" name="exp_id" id="exp_id">
          {section name="lst" loop=$experimentation}
          <option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $exp_id}selected{/if}>
          {$experimentation[lst].exp_nom}
          </option>
          {/section}
        </select>
      </div>
      <div class="col-sm-2 center">
        <button class="btn btn-success" type="submit">{t}Rechercher...{/t}</button>
      </div>
    </div>
  {$csrf}
</form>
</div>
{if count ($data) > 0}
<form method="POST" id="containerFormListPrint" action="pieceExportCS">
  <input type="hidden" name="exp_id" value="{$exp_id}">
  {if $rights.manage == 1}
    <div class="row">
      <button id="exportCS" class="btn btn-success" title="{t}Création d'un fichier utilisable pour importer les pièces dans le logiciel Collec-Science - import externe{/t}">{t}Export des pièces pour Collec-Science{/t}</button>
    </div>
  {/if}
  <table class="table table-bordered table-hover datatable "data-order='[[1,"asc"],[2,"asc"],[4,"asc"]]'>
    <thead>
      <tr>
        <th class="center">
          <input type="checkbox" id="checkPiece" class="checkPiece" checked>
        </th>
        <th>{t}Poisson{/t}</th>
        <th>{t}Tag{/t}</th>
        <th>{t}Taxon{/t}</th>
        <th>{t}Code pièce{/t}</th>
        <th>{t}Type{/t}</th>
        <th>{t}Traitement{/t}</th>
        <th>{t}Poids{/t}</th>
        <th>{t}Longueur{/t}</th>
        <th>{t}Sexe{/t}</th>
        <th>{t}UUID pièce{/t}</th>
        <th>{t}UUID poisson{/t}</th>
      </tr>
    </thead>
    <tbody>
      {foreach $data as $row}
        <tr>
          <td class="center">
              <input type="checkbox" class="checkPiece" name="pieces[]" value="{$row.piece_id}" checked >
          </td>
          <td>
            <a href="individuDisplay?individu_id={$row.individu_id}">
              {$row.codeindividu}
            </a>
          </td>
          <td>
           <a href="individuDisplay?individu_id={$row.individu_id}">
              {$row.tag}
            </a>
          </td>
          <td>{$row.nom_id}</td>
          <td>
            <a href="pieceDisplay?individu_id={$row.individu_id}&piece_id={$row.piece_id}">
              {if strlen($row.piececode)>0}
                {$row.piececode}
              {else}
                {$row.piece_uid}
              {/if}
            </a>
          </td>
          <td>{$row.piecetype_libelle}</td>
          <td>{$row.traitement_libelle}</td>
          <td>{$row.poids}</td>
          <td>{$row.longueur}</td>
          <td>{$row.sexe_libelle}</td>
          <td>{$row.uuid}</td>
          <td>{$row.individu_uuid}</td>
        </tr>
      {/foreach}
    </tbody>

  </table>
{$csrf}
</form>
{/if}