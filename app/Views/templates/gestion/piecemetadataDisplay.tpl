<script type="text/javascript" src="display/javascript/alpaca/handlebars.runtime.min.js"></script>
<script type="text/javascript" src="display/javascript/alpaca/alpaca.min.js"></script>
<link type="text/css" href="display/javascript/alpaca/css/alpaca.min.css" rel="stylesheet">
<script type="text/javascript" src="display/javascript/alpaca/formbuilder.js"></script>
<script>
    $(document).ready(function() {

        /** Fonction non utilisee, conservee pour l'exemple d'integration de deux requetes ajax successives */
        function getMetadata(reponse) { 
            var schema = reponse.replace(/&quot;/g,'"');
            //console.log (schema);
            var id = {$data.metadatatype_id};
            var readOnly = 1;
            var dataParse = "{$data.metadata}";
        	 dataParse = dataParse.replace(/&quot;/g,'"');
        	 dataParse = dataParse.replace(/\n/g,"\\n");
             console.log(dataParse);
        	 if (dataParse.length > 2) {
        		 dataParse = JSON.parse(dataParse);
        	 }
            /*
             Recuperation du type de metadonnees (tableau ou non)
             */
             $.ajax( { url: "index.php",
       	    		data: { "module": "metadatatypeIsarray", "metadatatype_id": id }})
             .done(function (isArray) { 
                 if (isArray) {
                    isArray = JSON.parse(isArray);
                } else {
                    var isArray = 0;
                }
                 showForm(JSON.parse(schema),dataParse,isArray, readOnly);
              });
            
        }
        /** Fonction non utilisee, conservee pour l'exemple d'integration de deux requetes ajax successives */
        function appelAjaxMetadata(fonctionRappel) {
            var id = {$data.metadatatype_id};
            $.ajax( { 
       	    		url: "index.php",
       	    		data: { "module": "metadatatypeGetschema", "metadatatype_id": id },
                    success: fonctionRappel
                });
        }
        /* Initialisation des metadonnees a l'ouverture */
        //appelAjaxMetadata(getMetadata);

        function initAlpaca() {
            var dataParse = "{$data.metadata}";
        	 dataParse = dataParse.replace(/&quot;/g,'"');
        	 dataParse = dataParse.replace(/\n/g,"\\n");
             console.log(dataParse);
        	 if (dataParse.length > 2) {
        		 dataParse = JSON.parse(dataParse);
        	 }
             var schema = "{$metadatatype.metadatatype_schema}";
             schema = schema.replace(/&quot;/g,'"');
             schema = schema.replace(/\n/g,"\\n");
             console.log(schema);
             console.log(dataParse);
             var isArray = "{$metadatatype.is_array}";
             showForm(JSON.parse(schema), dataParse, isArray, 1);
        }

        initAlpaca();

        //getMetadata();
    });
</script>
<h2>{t}Métadonnées associées à la pièce{/t}</h2>
<div class="row">
    <div class="col-sm-12"> 
        <a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a> > 
        <a href="index.php?module=individuDisplay&individu_id={$individu.individu_id}">{t}Retour au détail du poisson{/t}</a> > 
        <a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">{t}Retour au détail de la pièce{/t}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {include file="gestion/individuCartouche.tpl"}
        {include file="gestion/pieceCartouche.tpl"}
    </div>
</div>
<div class="col-sm-12">
<div class="row">
    <div class="col-sm-12">
        {if $droits.gestion == 1}
            <a href="index.php?module=piecemetadataChange&piece_id={$data.piece_id}&piecemetadata_id={$data.piecemetadata_id}">
                <img src="display/images/edit.png" height="25">{t}Modifier...{/t}
            </a>
            <a href="index.php?module=piecemetadataExport&piece_id={$data.piece_id}&piecemetadata_id={$data.piecemetadata_id}">
                <img src="display/images/download.png" height="25">{t}Exporter les métadonnées au format CSV{/t}
            </a>
        {/if}
        <div class="form-display">
            <dl class="dl-horizontal">
                <dt>{t}Type de métadonnées :{/t}</dt>
                <dd>{$data.metadatatype_name}</dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>{t}Date d'obtention :{/t}</dt>
                <dd>{$data.piecemetadata_date}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>{t}Commentaires :{/t}</dt>
                <dd class="textareaDisplay">{$data.piecemetadata_comment}</dd>
            </dl>
        </div>
    </div>
</div>
 <div class="row">
    <!-- metadata -->   
    <div class="col-md-12">          
        <div id="metadata"></div>
    </div>
</div>
</div>