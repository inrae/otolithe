<?php
/* Smarty version 4.5.3, created on 2024-06-06 08:02:08
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/groupList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66616d00df5aa2_93624400',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a64848f1bf303822386f6fd098dce7eecfba021' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/groupList.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66616d00df5aa2_93624400 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Liste des groupes de logins<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
	<div class="row">
	<div class="col-md-6">
<a href="index.php?module=groupChange&aclgroup_id=0">
<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nouveau groupe racine...<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</a>

<table id="groupListe" class="table table-bordered table-hover " >
<thead>
<tr>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nom du groupe<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nombre de logins déclarés<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Rajouter un groupe fils<?php $_block_repeat=false;
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
<td>
<a href="index.php?module=groupChange&aclgroup_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclgroup_id'];?>
&aclgroup_id_parent=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclgroup_id_parent'];?>
">
<?php
$_smarty_tpl->tpl_vars['boucle'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['boucle']->step = 1;$_smarty_tpl->tpl_vars['boucle']->total = (int) ceil(($_smarty_tpl->tpl_vars['boucle']->step > 0 ? $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['level']+1 - (1) : 1-($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['level'])+1)/abs($_smarty_tpl->tpl_vars['boucle']->step));
if ($_smarty_tpl->tpl_vars['boucle']->total > 0) {
for ($_smarty_tpl->tpl_vars['boucle']->value = 1, $_smarty_tpl->tpl_vars['boucle']->iteration = 1;$_smarty_tpl->tpl_vars['boucle']->iteration <= $_smarty_tpl->tpl_vars['boucle']->total;$_smarty_tpl->tpl_vars['boucle']->value += $_smarty_tpl->tpl_vars['boucle']->step, $_smarty_tpl->tpl_vars['boucle']->iteration++) {
$_smarty_tpl->tpl_vars['boucle']->first = $_smarty_tpl->tpl_vars['boucle']->iteration === 1;$_smarty_tpl->tpl_vars['boucle']->last = $_smarty_tpl->tpl_vars['boucle']->iteration === $_smarty_tpl->tpl_vars['boucle']->total;?>
&nbsp;&nbsp;&nbsp;
<?php }
}
echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['groupe'];?>

</a>
</td>
<td class="center"><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['nblogin'];?>
</td>
<td class="center">
<a href="index.php?module=groupChange&aclgroup_id=0&aclgroup_id_parent=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclgroup_id'];?>
">
<img src="display/images/droits/list-add.png" height="20">
</a>
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
