<?php

namespace Icybee\Modules\Users\Logins;

use ICanBoogie\ActiveRecord\Model;
use ICanBoogie\Module;

return array
(
	Module::T_CATEGORY => 'dashboard',
	Module::T_DESCRIPTION => 'Record users logins',
	Module::T_MODELS => array
	(
		'primary' => array
		(
			Model::T_SCHEMA => array
			(
				'fields' => array
				(
					'uid' => 'foreign',
					'logged_at' => 'timestamp',
					'ip' => array('varchar', 39)
				)
			)
		)
	),

	Module::T_NAMESPACE => __NAMESPACE__,
	Module::T_TITLE => 'Logins',
	Module::T_VERSION => 'dev-master'
);
