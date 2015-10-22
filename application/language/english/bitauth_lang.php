<?php

/**
 * This line is required, it must contain the label for your unique username field (what users login with)
 */
$lang['bitauth_username']			= 'Usuário';

/**
 * Password Complexity Labels
 */
$lang['bitauth_pwd_uppercase']		= 'Letras Maiúsculas';
$lang['bitauth_pwd_number']			= 'Números';
$lang['bitauth_pwd_special']		= 'Caracteres Especiais';
$lang['bitauth_pwd_spaces']			= 'Espaços';

/**
 * Login Error Messages
 */
$lang['bitauth_login_failed']		= '%s ou senha inválido(s)';
$lang['bitauth_user_inactive']		= 'Você deve ativar sua conta antes de efetuar seu login.';
$lang['bitauth_user_locked_out']	= 'Você não pode efetuar login por %d minutos em função de várias tentativas de login mal sucedidas, por favor tente mais tarde.';
$lang['bitauth_pwd_expired']		= 'Sua senha expirou.';

/**
 * User Validation Error Messages
 */
$lang['bitauth_unique_username']	= 'O campo %s deve ser único.';
$lang['bitauth_password_is_valid']	= '%s não atende os requisitos de complexidade ';
$lang['bitauth_username_required']	= 'O campo %s é obrigatório.';
$lang['bitauth_password_required']	= 'O campo %s é obrigatório.';
$lang['bitauth_passwd_complexity']	= 'Senha não atende os requisitos de complexidade: %s';
$lang['bitauth_passwd_min_length']	= 'Senha deve ter no mínimo %d caracteres.';
$lang['bitauth_passwd_max_length']	= 'Senha não deve ter mais do que %d caracteres.';

/**
 * Group Validation Error Messages
 */
$lang['bitauth_unique_group']		= 'O campo %s deve ser único.';
$lang['bitauth_groupname_required']	= 'Nome do grupo é obrigatório.';

/**
 * General Error Messages
 */
$lang['bitauth_instance_na']		= "BitAuth was unable to get the CodeIgniter instance.";
$lang['bitauth_data_error']			= 'You can\'t overwrite default BitAuth properties with custom userdata. Please change the name of the field: %s';
$lang['bitauth_enable_gmp']			= 'You must enable php_gmp to use Bitauth.';
$lang['bitauth_user_not_found']		= 'User not found: %d';
$lang['bitauth_activate_failed']	= 'Unable to activate user with this activation code.';
$lang['bitauth_expired_datatype']	= '$user must be an array or an object in Bitauth::password_is_expired()';
$lang['bitauth_expiring_datatype']	= '$user must be an array or an object in Bitauth::password_almost_expired()';
$lang['bitauth_add_user_datatype']	= '$data must be an array or an object in Bitauth::add_user()';
$lang['bitauth_add_user_failed']	= 'Adding user failed, please notify an administrator.';
$lang['bitauth_code_not_found']		= 'Activation Code Not Found.';
$lang['bitauth_edit_user_datatype']	= '$data must be an array or an object in Bitauth::update_user()';
$lang['bitauth_edit_user_failed']	= 'Updating user failed, please notify an administrator.';
$lang['bitauth_del_user_failed']	= 'Deleting user failed, please notify an administrator.';
$lang['bitauth_set_pw_failed']		= 'Unable to set user\'s password, please notify an administrator.';
$lang['bitauth_no_default_group']	= 'Default group was either not specified or not found, please notify an administrator.';
$lang['bitauth_add_group_datatype']	= '$data must be an array or an object in Bitauth::add_group()';
$lang['bitauth_add_group_failed']	= 'Adding group failed, please notify an administrator.';
$lang['bitauth_edit_group_datatype']= '$data must be an array or an object in Bitauth::update_group()';
$lang['bitauth_edit_group_failed']	= 'Updating group failed, please notify an administrator.';
$lang['bitauth_del_group_failed']	= 'Deleting group failed, please notify an administrator.';
$lang['bitauth_lang_not_found']		= '(No language entry for "%s" found!)';
