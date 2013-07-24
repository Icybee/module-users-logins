<?php

namespace Icybee\Modules\Users\Logins;

$hooks = __NAMESPACE__ . '\Hooks::';

return array
(
	'events' => array
	(
		'Icybee\Modules\Users\DeleteOperation::process:before' => $hooks . 'before_delete_user',
		'Icybee\Modules\Users\LoginOperation::process' => $hooks . 'on_login',
		'Icybee\Modules\Users\ManageBlock::alter_columns' => $hooks . 'on_manageblock_alter_columns'
	),

	'prototypes' => array
	(
		'Icybee\Modules\Users\User::get_last_login_times' => $hooks . 'get_last_login_times',
		'Icybee\Modules\Users\User::get_login_count' => $hooks . 'get_login_count'
	)
);