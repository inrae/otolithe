<?php
/* Smarty version 4.5.3, created on 2024-06-05 12:44:22
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/main.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66605da6b47408_82125315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6667a8f367d0bc7298241416fcd5d9a3b6453e89' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/main.html',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:ppci/main_js.tpl' => 1,
    'file:app_js.tpl' => 1,
  ),
),false)) {
function content_66605da6b47408_82125315 (Smarty_Internal_Template $_smarty_tpl) {
?><html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $_smarty_tpl->tpl_vars['APP_title']->value;?>
</title>
    <link rel="icon" type="image/png" href="favicon.png" />
    <?php $_smarty_tpl->_subTemplateRender("file:ppci/main_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:app_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>

<body>
    <div id="wrap">
        <div class="container-fluid">
            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['corps']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </div>
    </div>
    <div id="footer">
        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>
</body>

</html><?php }
}
