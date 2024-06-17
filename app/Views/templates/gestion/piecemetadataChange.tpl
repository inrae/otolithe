<!--alpaca -->
<script type="text/javascript" src="display/javascript/formbuilder.js"></script>
<script type="text/javascript" src="display/node_modules/handlebars/dist/handlebars.runtime.min.js"></script>
<script type="text/javascript" src="display/node_modules/alpaca/dist/alpaca/bootstrap/alpaca.min.js"></script>
<link type="text/css" href="display/node_modules/alpaca/dist/alpaca/bootstrap/alpaca.min.css" rel="stylesheet">
<script>
    $(document).ready(function () {

        function getMetadata(reponse) {
            var schema = reponse.replace(/&quot;/g, '"');
            //console.log (schema);
            var id = $("#metadatatypeId").val();

            var dataParse = $("#metadataField").val();
            dataParse = dataParse.replace(/&quot;/g, '"');
            dataParse = dataParse.replace(/\n/g, "\\n");
            if (dataParse.length > 2) {
                dataParse = JSON.parse(dataParse);
            }
            /*
             Recuperation du type de metadonnees (tableau ou non)
             */
            $.ajax({
                url: "metadatatypeIsarray",
                data: { "metadatatype_id": id }
            })
                .done(function (isArray) {
                    console.log(isArray);
                    if (isArray) {
                        isArray = JSON.parse(isArray);
                        console.log(isArray);
                    } else {
                        var isArray = 0;
                    }
                    showForm(JSON.parse(schema), dataParse, isArray);
                });

        }
        function appelAjaxMetadata(fonctionRappel) {
            var id = $("#metadatatypeId").val();
            $.ajax({
                url: "metadatatypeGetschema",
                data: { "metadatatype_id": id },
                success: fonctionRappel
            });
        }


        $("#metadatatypeId").change(function () {
            appelAjaxMetadata(getMetadata);
        });

        $('#piecemetadataForm').submit(function (event) {
            if ($("#testAction").val() == "Write") {
                var error = false;
                var metadatatype_id = $("#metadatatypeId").val();
                if (metadatatype_id) {
                    if (metadatatype_id.length == 0) {
                        error = true;
                    }
                } else {
                    error = true;
                }

                /* Validation des metadonnees */
                $('#metadata').alpaca().refreshValidationState(true);
                if ($('#metadata').alpaca().isValid(true)) {
                    var value = $('#metadata').alpaca().getValue();
                    // met les metadata en JSON dans le champ (name="metadata") qui sera sauvegardé en base
                    $("#metadataField").val(JSON.stringify(value));
                    //console.log($("#metadataField").val());
                } else {
                    error = true;
                }
                //console.log("error :" + error);
                if (error) {
                    event.preventDefault();
                }
            }
        });

        //getMetadata();

        /* Initialisation des metadonnees a l'ouverture */
        appelAjaxMetadata(getMetadata);
    });
</script>
<h2>{t}Métadonnées associées à la pièce{/t}</h2>
<div class="row">
    <div class="col-sm-12">
        <a href="{$moduleListe}">{t}Retour à la liste{/t}</a> >
        <a href="individuDisplay?individu_id={$individu.individu_id}">{t}Retour au détail du poisson{/t}</a> >
        <a href="pieceDisplay?piece_id={$data.piece_id}">{t}Retour au détail de la pièce{/t}</a>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-sm-12">
        {include file="gestion/individuCartouche.tpl"}
        {include file="gestion/pieceCartouche.tpl"}
    </div>
</div>
<form id="piecemetadataForm" method="post" action="piecemetadataWrite">
    <div class="row">
        <div class="col-md-8 col-sm-12">

            <div class="form-horizontal col-md-8 col-sm-12">
                <input type="hidden" name="piecemetadata_id" value="{$data.piecemetadata_id}">
                <input type="hidden" name="moduleBase" value="piecemetadata">
                <input type="hidden" id="testAction" name="testAction" value="Write">
                <input type="hidden" id="action" name="action" value="Write">
                <input type="hidden" name="piece_id" value="{$data.piece_id}">
                <input type="hidden" name="metadata" id="metadataField" value="{$data.metadata}">
                <div class="form-group center">
                    <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
                    {if $data.piecemetadata_id > 0 }
                    <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
                    {/if}
                </div>
                <div class="form-group">
                    <label for="piecemetadata_date" class="control-label col-md-4">
                        {t}Date d'acquisition des données :{/t}</label>
                    <div class="col-md-8">
                        <input id="piecemetadata_date" class="form-control datepicker" name="piecemetadata_date"
                            value="{$data.piecemetadata_date}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="piecemetadataComment" class="control-label col-md-4">{t}Commentaire :{/t}</label>
                    <div class="col-md-8">
                        <textarea id="piecemetadataComment" type="text" class="form-control"
                            name="piecemetadata_comment">{$data.piecemetadata_comment}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="metadatatypeId" class="control-label col-md-4">{t}Modèle de métadonnées à utiliser
                        :{/t}</label>
                    <div class="col-md-8">
                        <select id="metadatatypeId" name="metadatatype_id" class="form-control">
                            {foreach $metadatatypes as $mt}
                            <option value="{$mt.metadatatype_id}" {if
                                $data.metadatatype_id==$mt.metadatatype_id}selected{/if}>
                                {$mt.metadatatype_name}
                            </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- metadata -->
        <div class="col-md-12">
            <div id="metadata"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group center">
                <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
                {if $data.piecemetadata_id > 0 }
                <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
                {/if}
            </div>
        </div>
    </div>
    {$csrf}
</form>