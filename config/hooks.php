<?php

namespace Icybee\Modules\Users\Logins;

$hooks = __NAMESPACE__ . '\Hooks::';

return array
(
	'events' => array
	(
		'Icybee\Modules\Users\LoginOperation::process' => $hooks . 'on_login'
	),

	'prototypes' => array
	(
		'Icybee\Modules\Users\User::get_last_login_times' => $hooks . 'get_last_login_times',
		'Icybee\Modules\Users\User::get_login_count' => $hooks . 'get_login_count'
	)
);