<h2>{t}Modification d'un type de point remarquable{/t}</h2>
<div class="row">
    <a href="remarkabletypeList">{t}Retour à la liste{/t}</a>
</div>
<div class="row">
    <div class="col-md-8 col-lg-6">

        <form class="form-horizontal" method="post" action="index.php">
            <input type="hidden" name="moduleBase" value="remarkabletype">
            <input type="hidden" name="action" value="Write">
            <input type="hidden" name="remarkable_type_id" value="{$data.remarkable_type_id}">
            <div class="form-group">
                <label for="remarkable_type_name" class="control-label col-md-4">
                    {t}Nom du type de point remarquable :{/t}<span class="red">*</span>
                </label>
                <div class="col-md-8">
                    <input id="remarkable_type_name" class="form-control" name="remarkable_type_name"
                        value="{$data.remarkable_type_name}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="sort_order" class="control-label col-md-4">
                    {t}Ordre d'affichage :{/t}
                </label>
                <div class="col-md-8">
                    <input type="number" id="sort_order" class="form-control" name="sort_order" value="{$data.sort_order}">
                </div>
            </div>
            <div class="form-group center">
                <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
                {if $data.remarkable_type_id > 0 }
                <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
                {/if}
            </div>
            {$csrf}
        </form>
    </div>
</div>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>