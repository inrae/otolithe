<?php
/* Smarty version 4.5.3, created on 2024-06-05 13:05:33
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6660629d2fd1a4_49640391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '030f39821b29673d5d10d92473a852363bb033a3' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/header.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6660629d2fd1a4_49640391 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">

		<div class="navbar-header navbar">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<div class="navbar-brand"><a href='/'><img src="<?php echo $_smarty_tpl->tpl_vars['favicon']->value;?>
" height="20"></a></div>
			<a href='/'><span class="navbar-text hidden-xs hidden-sm"><b><?php echo $_smarty_tpl->tpl_vars['APP_title']->value;?>
</b></span></a>
		</div>
		<!-- Affichage du menu -->
		<div class="collapse navbar-collapse" id="navbar_collapse">
		<ul class="nav navbar-nav md"><?php echo $_smarty_tpl->tpl_vars['menu']->value;?>

		</ul>

		<!-- Boutons a droite du menu -->
		<ul class="nav navbar-nav md navbar-right hidden-xs hidden-sm">
			<li><a href="<?php if ($_smarty_tpl->tpl_vars['isLogged']->value) {?>#<?php } else { ?>connexion<?php }?>"><?php if ($_smarty_tpl->tpl_vars['isLogged']->value) {
echo $_smarty_tpl->tpl_vars['login']->value;
} else {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Connexion<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?> <span class="caret"></span></a>
				<ul class="dropdown-menu">
				    <li><a href='setlocale?locale=fr'> <img
								src='display/images/drapeau_francais.png#180313' width='16'  border='0'>
								Français
							</a></li>
				    <li><a href='setlocale?locale=en'> <img
								src='display/images/drapeau_anglais.png#refresh180313' width='16'  border='0'>
								English
							</a> </li>
<?php if ($_smarty_tpl->tpl_vars['isLogged']->value) {?>
						<li><a href="totpCreate" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Activer la double authentification pour votre compte<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Activer la double authentification<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
				    <li><a href='loginChangePassword' title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Modifier le mot de passe<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"> <img
								src='display/images/key.png' width='16' border='0' title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Modifier le mot de passe<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
							<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mot de passe<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
					<li><a href="disconnect">
<img src='display/images/key_red.png' height='16' width='16' border='0' title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Déconnexion<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
			<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Déconnexion<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
<?php } else { ?>			        <li><a href="connexion">
<img src='display/images/key_green.png' height='16' width='16' border='0' title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Connexion<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
			<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Connexion<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
<?php }?>

				</ul>
			</li>
		</ul>
		</div>
	</div>
</div>
<div class="container-fluid" id="messageDiv" <?php if (strlen($_smarty_tpl->tpl_vars['message']->value) == 0) {?> hidden<?php }?>>
	<div class="row">
		<div class="col-xs-12 message<?php if ($_smarty_tpl->tpl_vars['messageError']->value == 1) {?>Error<?php }?>" id="message">
			<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

		</div>
	</div>
</div>

<?php }
}
