<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Users\Logins;

use ICanBoogie\Operation\BeforeProcessEvent;
use ICanBoogie\Operation\ProcessEvent;

class Hooks
{
	/*
	 * Events
	 */

	/**
	 * Delete login data associated with a user, before the user is deleted.
	 *
	 * @param BeforeProcessEvent $event
	 * @param \Icybee\Modules\Users\DeleteOperation $target
	 */
	static public function before_delete_user(BeforeProcessEvent $event, \Icybee\Modules\Users\DeleteOperation $target)
	{
		global $core;

		$core->models['users.logins']->filter_by_uid($target->key)->delete();
	}

	/**
	 * Adds a logged entry after a user was logged in.
	 *
	 * @param ProcessEvent $event
	 * @param \Icybee\Modules\Users\LoginOperation $target
	 */
	static public function on_login(ProcessEvent $event, \Icybee\Modules\Users\LoginOperation $target)
	{
		global $core;

		$core->models['users.logins']->insert
		(
			array
			(
				'uid' => $target->record->uid,
				'logged_at' => gmdate('Y-m-d H:i:s'),
				'ip' => $event->request->ip
			)
		);
	}

	/**
	 * Adds the column `login_count` to the listview of the "users" module.
	 *
	 * @param \Icybee\ManageBlock\AlterColumnsEvent $event
	 * @param \Icybee\ManageBlock $target
	 */
	static public function on_manageblock_alter_columns(\Icybee\ManageBlock\AlterColumnsEvent $event, \Icybee\ManageBlock $target)
	{
		$event->add(new ManageBlock\LoginCountColumn($target, 'login_count'), 'before:logged_at');
	}

	/*
	 * Prototypes
	 */

	/**
	 * Returns the last five login times of the specified user.
	 *
	 * @param \Icybee\Modules\Users\Users $target
	 *
	 * @return array
	 */
	static public function get_last_login_times(\Icybee\Modules\Users\User $target)
	{
		global $core;

		return $core->models['users.logins']
		->select('logged_at')
		->filter_by_uid($target->uid)
		->order('logged_at DESC')
		->limit(5)
		->all(\PDO::FETCH_COLUMN);
	}

	/**
	 * Returns the number of logins of the specified user.
	 *
	 * @param \Icybee\Modules\Users\Users $target
	 */
	static public function get_login_count(\Icybee\Modules\Users\User $target)
	{
		global $core;

		return $core->models['users.logins']
		->filter_by_uid($target->uid)
		->count;
	}
}