<?php
/* Smarty version 4.5.3, created on 2024-06-05 13:20:20
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/ident/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66606614465cb8_88115743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11b3ca3bb31378af4744e03d0fc0a36f6b8d0937' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/ident/login.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66606614465cb8_88115743 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(document).ready(function () {
		var visible = false;
		$(".passwordVisible").click(function () {
			var fieldname = "#password";
			if (visible) {
				$(fieldname).prop("type", "password");
				visible = false;
				$(this).attr("src", "display/images/framework/visible-24.png");
			} else {
				$(fieldname).prop("type", "text");
				visible = true;
				$(this).attr("src", "display/images/framework/invisible-24.png");
			}
		});
	});
<?php echo '</script'; ?>
>

<div class="col-sm-12 col-md-6">
	<div class="form-horizontal">
		<form id="loginForm" method="POST" action="loginExec">
			<input type="hidden" name="identificationType" value="BDD">
			<div class="form-group">
				<label for="login" class="control-label col-sm-4">
					<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Login :<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</label>
				<div class="col-sm-8">
					<input class="form-control input-lg" name="login" id="login" required autofocus>
				</div>
			</div>
			<div class="form-group">
				<label for="login" class="control-label col-sm-4">
					<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mot de passe :<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</label>
				<div class="col-sm-7">
					<input class="form-control input-lg" name="password" id="password" type="password"
						autocomplete="off" required maxlength="256">
				</div>
				<div class="col-md-1">
					<img src="display/images/framework/visible-24.png" height="16" id="passVisible"
						class="passwordVisible">
				</div>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['tokenIdentityValidity']->value > 0) {?>
			<div class="form-group center checkbox col-sm-12 input-lg">
				<label>
					<?php $_smarty_tpl->_assignInScope('duration', $_smarty_tpl->tpl_vars['tokenIdentityValidity']->value/3600);?>
					<input type="checkbox" name="loginByTokenRequested" class="" value="1" checked>
					<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Conserver la connexion pendant<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo $_smarty_tpl->tpl_vars['duration']->value;?>
 <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>heures<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</label>
			</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['lostPassword']->value == 1) {?>
			<div class="form-group center col-sm-12 input-lg">
				<a href="index.php?module=passwordlostIslost">
					<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mot de passe oublié ?<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
			</div>
			<?php }?>
			<div class="form-group center">
				<button type="submit" class="btn btn-primary button-valid input-lg"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Se connecter<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
			</div>
			<?php echo $_smarty_tpl->tpl_vars['csrf']->value;?>

		</form>
		<?php if ($_smarty_tpl->tpl_vars['CAS_enabled']->value == 1 || $_smarty_tpl->tpl_vars['OIDC_enabled']->value == 1) {?>
			<?php if ($_smarty_tpl->tpl_vars['CAS_enabled']->value == 1) {?>
				<form id="loginCasForm" method="GET" action="loginCasExec">
				<input type="hidden" name="identificationType" value="CAS">
			<?php } else { ?>
				<form id="loginCasForm" method="GET" action="oidcExec">
				<input type="hidden" name="identificationType" value="OIDC">
			<?php }?>
				<div class="form-group">
					<label for="cas" class="control-label col-sm-4"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>ou :<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
					<div class="col-sm-8">
						<button type="submit" id="cas" class="btn btn-info">
							<img src="oidcGetLogo" height="25">
							<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Se connecter avec l'identification centralisée<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</button>
					</div>
				</div>
			</form>
		<?php }?>
	</div>
</div><?php }
}
