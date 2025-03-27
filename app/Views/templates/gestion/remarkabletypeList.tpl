<h2>{t}Liste des types de points remarquables{/t}</h2>
{if $rights["param"] == 1}
<a href="remarkabletypeChange?remarkable_type_id=0">
    {t}Nouveau type de point remarquable...{/t}
</a>
{/if}
<div class="row">
    <div class="col-md-6">
        <table id="ptList" class="table table-bordered table-hover datatable display" data-order='[[2,"asc"]]'>
            <thead>
                <tr>
                    <th>{t}Id{/t}</th>
                    <th>{t}Nom{/t}</th>
                    <th>{t}Ordre d'affichage{/t}</th>
                </tr>
            </thead>
            <tbody>
                {section name=lst loop=$data}
                <tr>
                    <td>
                        {if $rights["admin"] == 1}
                        <a href="remarkabletypeChange?remarkable_type_id={$data[lst].remarkable_type_id}">
                            {$data[lst].remarkable_type_id}
                        </a>
                        {else}
                        {$data[lst].remarkable_type_id}
                        {/if}
                    </td>
                    <td>{$data[lst].remarkable_type_name}</td>
                    <td>{$data[lst].sort_order}</td>
                </tr>
                {/section}
            </tbody>
        </table>
    </div>
</div>