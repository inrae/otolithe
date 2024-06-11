{* Paramètres > Métadonnées > Nouveau > *}

{include file="param/metadataFormJS.tpl"}

<script type="text/javascript">
function loadSchema(){

}

$(document).ready(function() {

        var metadataParse= $("#metadataField").val();
        if (metadataParse.length > 0) {
            metadataParse = metadataParse.replace(/&quot;/g,'"');
            metadataParse = JSON.parse(metadataParse);
        }
        renderForm(metadataParse);

        $('#metadataForm').submit(function(event) {
        	console.log("write");
        	if ($("#action").val() == "Write") {
        		$('#metadata').alpaca().refreshValidationState(true);
                if(!$('#metadata').alpaca().isValid(true)){
                	alert("{t}La définition des métadonnées n'est pas valide.{/t}");
                	event.preventDefault();
                }
        	}
        });        
    });
</script>

<h2>{t}Création - Modification d'un modèle de métadonnées{/t}</h2>
<div class="row">
<div class="col-md-6">
<img src="display/images/list.png" height="25">
<a href="metadatatypeList">{t}Retour à la liste{/t}</a>

<form class="form-horizontal protoform" id="metadataForm" method="post" action="index.php" enctype="multipart/form-data">
{if $nbSample > 0}<fieldset disabled>{/if}
<input type="hidden" name="moduleBase" value="metadatatype">
<input type="hidden" id="action" name="action" value="Write">
<input type="hidden" name="metadatatype_id" value="{$data.metadatatype_id}">
<input type="hidden" name="metadatatype_schema" id="metadataField" value="{$data.metadatatype_schema}">

<div class="form-group">
<label for="metadatatypeName"  class="control-label col-md-4"><span class="red">*</span> {t}Nom du modèle :{/t}</label>
<div class="col-md-8">
<input id="metadatatypeName" type="text" class="form-control" name="metadatatype_name" value="{$data.metadatatype_name}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="metadatatypeComment"  class="control-label col-md-4">{t}Description :{/t}</label>
<div class="col-md-8">
<textarea id="metadatatypeComment" type="text" class="form-control" name="metadatatype_comment">{$data.metadatatype_comment}</textarea>
</div>
</div>

<div class="form-group">
<label for="isArray"  class="control-label col-md-4"><span class="red">*</span> {t}Les données sont-elles en tableau (multivaleurs) ?{/t}</label>
<div id="isArray" class="col-md-8">
<label class="radio-inline">
  <input type="radio" name="is_array" id="isArray1" value="t" {if $data.is_array == 1}checked {/if}> {t}oui{/t}
</label>
<label class="radio-inline">
  <input type="radio" name="is_array" id="isArray2" value="f" {if $data.is_array == "" || $data.is_array == "0"}checked {/if}> {t}non{/t}
</label>
</div>
</div>
<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.metadatatype_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>

<fieldset>
<legend>{t}Jeu de métadonnées{/t}</legend>


<div id="metadata"></div>

</fieldset>

{if $nbSample < 1}
<div class="form-group center">
      <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
      {if $data.metadatatype_id > 0 }
      <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
      {/if}
 </div>
 {/if}
 {if $nbSample > 0}</fieldset>{/if}
{$csrf}
</form>
</div>
</div>
<span class="red">*</span><span class="messagebas">{t}Donnée obligatoire{/t}</span>