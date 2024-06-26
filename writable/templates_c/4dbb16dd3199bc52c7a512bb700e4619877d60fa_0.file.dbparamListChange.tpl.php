<?php
/* Smarty version 4.5.3, created on 2024-06-06 08:02:20
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/dbparamListChange.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66616d0cd636a8_17068564',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4dbb16dd3199bc52c7a512bb700e4619877d60fa' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/dbparamListChange.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66616d0cd636a8_17068564 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Paramètres pérennes de l'application<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>
<div class="row">
	<div class="col-md-6">
		<form id="dbparam" class="form-horizontal protoform" method="post" action="index.php">
			<input type="hidden" name="moduleBase" value="dbparam">
			<input type="hidden" name="action" value="WriteGlobal">
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Paramètre<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
					<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Valeur<?php $_block_repeat=false;
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
				<?php
$__section_lst_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_lst_0_total = $__section_lst_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_lst'] = new Smarty_Variable(array());
if ($__section_lst_0_total !== 0) {
for ($__section_lst_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] = 0; $__section_lst_0_iteration <= $__section_lst_0_total; $__section_lst_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']++){
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbparam_name'];?>
</td>
					<td>
						<input class="form-control" name="id:<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbparam_id'];?>
"
							value="<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbparam_value'];?>
">
					</td>
					<td>
						
							<?php if ($_smarty_tpl->tpl_vars['locale']->value == 'fr') {?>
							<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbparam_description'];?>

							<?php } else { ?>
							<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbparam_description_en'];?>

							<?php }?>

					</td>
					<?php
}
}
?>
			</table>


			<div class="form-group center">
				<button type="submit" class="btn btn-primary button-valid"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Valider<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
			</div>
		<?php echo $_smarty_tpl->tpl_vars['csrf']->value;?>

</form>

	</div>
</div><?php }
}
