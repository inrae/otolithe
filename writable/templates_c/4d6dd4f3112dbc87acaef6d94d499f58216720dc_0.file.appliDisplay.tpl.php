<?php
/* Smarty version 4.5.3, created on 2024-06-06 08:02:02
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/appliDisplay.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66616cfa482a17_31774010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d6dd4f3112dbc87acaef6d94d499f58216720dc' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/droits/appliDisplay.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66616cfa482a17_31774010 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="index.php?module=appliList">
    <img src="display/images/list.png" height="25">
    <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Retour à la liste des applications<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</a>
<h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Liste des droits disponibles pour l'application<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <a href="index.php?module=appliChange&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['data']->value['appli'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['applidetail']) {?>(<?php echo $_smarty_tpl->tpl_vars['data']->value['applidetail'];?>
)<?php }?>
    </a>
</h2>
<div class="col-md-6">
    <a href="index.php?module=appliChange&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
        <img src="display/images/edit.gif" height="25">
        <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Modifier...<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    </a>
    <?php if ($_smarty_tpl->tpl_vars['newRightEnabled']->value == 1) {?>
        <a href="index.php?module=acoChange&aclaco_id=0&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['display']->value;?>
/images/new.png" height="25">
            <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nouveau droit...<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
        </a>
    <?php }?>
    <table id="acoliste" class="table table-bordered table-hover datatable">
        <thead>
            <tr>
                <th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nom du droit d'accès<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
            </tr>
        </thead>
        <tbody>
            <?php
$__section_lst_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['dataAco']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_lst_0_total = $__section_lst_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_lst'] = new Smarty_Variable(array());
if ($__section_lst_0_total !== 0) {
for ($__section_lst_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] = 0; $__section_lst_0_iteration <= $__section_lst_0_total; $__section_lst_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']++){
?>
                <tr>
                    <td>
                        <a href="index.php?module=acoChange&aclaco_id=<?php echo $_smarty_tpl->tpl_vars['dataAco']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aclaco_id'];?>
&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['dataAco']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['aco'];?>

                        </a>
                    </td>
                </tr>
            <?php
}
}
?>
        </tbody>
    </table>
</div><?php }
}
