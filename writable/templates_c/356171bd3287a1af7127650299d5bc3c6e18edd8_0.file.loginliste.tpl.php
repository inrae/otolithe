<?php
/* Smarty version 4.5.3, created on 2024-06-06 08:01:54
  from '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/ident/loginliste.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66616cf22754d4_36334279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '356171bd3287a1af7127650299d5bc3c6e18edd8' => 
    array (
      0 => '/home/equinton/web/otolithe2/vendor/equinton/ppci/src/Views/templates/ppci/ident/loginliste.tpl',
      1 => 1717590385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66616cf22754d4_36334279 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(document).ready(function () {
		var mails = "";
		$(".mail").each(function (i, elem) {
			var mail = $(elem).text();
			if (mail.length > 0) {
				if (mails.length > 0) {
					mails += ";";
				}
				mails += mail;
			}
		});
		$("#mails").val(mails);
		$("#copyMails").click(function () {
			var temp = $("<input>");
			$("body").append(temp);
			temp.val($("#mails").val()).select();
			document.execCommand("copy");
			temp.remove();
			$("#message").text("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Adresses enregistrées dans le presse-papiers<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>");
			$("#messageDiv").show();
		});
	});
<?php echo '</script'; ?>
>
<h2><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Liste des logins déclarés dans la base de données<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h2>

<a href="index.php?module=loginChange&id=0"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nouveau login<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-bordered table-hover datatable" data-order='[[ 1, "asc" ]]'>
					<thead>
						<tr>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Login<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nom - Prénom<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Adresse e-mail<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Actif<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Compte utilisé pour service web<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mot de passe en attente de changement<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Nombre d'essais de connexion infructueux<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></th>
							<th><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Heure du dernier essai infructueux<?php $_block_repeat=false;
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
							<td><a href="index.php?module=loginChange&id=<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['login'];?>
</a></td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['nom'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['prenom'];?>
</td>
							<td>
								<div class="mail"><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['mail'];?>
</div>&nbsp;
							</td>
							<td class="center"><?php if ($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['actif'] == 1) {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>oui<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?></td>
							<td class="center"><?php if ($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['is_clientws'] == 1) {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>oui<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?></td>
							<td class="center">
								<?php if ($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbconnect_provisional_nb'] > 3) {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Compte bloqué<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php } elseif ($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['dbconnect_provisional_nb'] > 3) {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>oui<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php }?>
							</td>
							<td class="center"><?php if ($_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['nbattempts'] > 0) {
echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['nbattempts'];
}?></td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_lst']->value['index'] : null)]['lastattempt'];?>
</td>
						</tr>
						<?php
}
}
?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal">
					<div class="form-group">
						<label for="mails" class="control-label col-md-2">
							<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Adresses mails :<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</label>
						<div class="col-md-9">
							<input class="form-control" id="mails" readonly>
						</div>
						<div class="col-md-1">
							<img src="display/images/copy.png" height="24" id="copyMails">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><?php }
}
