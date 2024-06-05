<?php
/* Smarty version 4.5.3, created on 2024-06-05 13:06:13
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_666062c5f10548_98674933',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35aca938ce288675c1a798ff62788fc4e7efadb5' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/footer.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_666062c5f10548_98674933 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container">
    <p class="text-muted hidden-xs hidden-sm">
    <?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>

<br>
<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Pour tout problème :<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <a href="<?php echo $_smarty_tpl->tpl_vars['APP_help_address']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['APP_help_address']->value;?>
</a>
</p>
 <ul class="nav pull-right scroll-top scrolltotop">
  <li><a href="#" title="Scroll to top"><i class="glyphicon glyphicon-chevron-up"></i></a></li>
</ul>
<?php if (strlen($_smarty_tpl->tpl_vars['developmentMode']->value) > 1) {?>
<div class="text-warning"><?php echo $_smarty_tpl->tpl_vars['developmentMode']->value;?>
</div>
<?php }?>
  </div>
<?php }
}
