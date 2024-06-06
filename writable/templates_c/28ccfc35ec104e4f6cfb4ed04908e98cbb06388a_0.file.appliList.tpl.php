<?php
/* Smarty version 4.5.3, created on 2024-06-06 08:02:00
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/appliList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66616cf8636b90_57200763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28ccfc35ec104e4f6cfb4ed04908e98cbb06388a' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/appliList.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66616cf8636b90_57200763 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Liste des applications disponibles dans le module de gestion des droits<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
	<div class="row">
	<div class="col-md-6">
<a href="index.php?module=appliChange&aclappli_id=0">
<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nouvelle application...<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</a>
<table id="appliListe" class="table table-bordered table-hover datatable" data-order='[[ 0, "asc" ]]' data-page-length='25'>
<thead>
<tr>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Modifier<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nom de l'application<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Description<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
</tr>
</thead>
<tbody>
<?php
$__section_lst_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_lst_0_total = $__section_lst_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_lst'] = new Smarty_Variable(array());
if ($__section_lst_0_total !== 0) {
for ($__section_lst_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] = 0; $__section_lst_0_iteration <= $__section_lst_0_total; $__section_lst_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']++){
?>
<tr>
<td class="center"><a href="index.php?module=appliChange&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclappli_id'];?>
">
<img src="display/images/edit.gif" height="25">
</a>
<td>
<a href="index.php?module=appliDisplay&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclappli_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['appli'];?>

</a>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['applidetail'];?>
</td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</div>
</div><?php }
}
