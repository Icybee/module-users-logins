<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Users\Logins\ManageBlock;

use ICanBoogie\ActiveRecord\Query;

use Icybee\ManageBlock\Column;

/**
 * Representation of the `login_count` column.
 */
class LoginCountColumn extends Column
{
	public function __construct(\Icybee\Modules\Users\ManageBlock $manager, $id, array $options=array())
	{
		parent::__construct
		(
			$manager, $id, array
			(
				'class' => 'pull-right cell-fitted',
				'orderable' => true
			)
		);
	}

	public function alter_query_with_order(Query $query, $order_direction)
	{
		return $query->order("(SELECT COUNT(uid) FROM {prefix}users_logins WHERE uid = user.uid) " . ($order_direction < 0 ? 'desc' : 'asc'));
	}

	public function alter_records(array $records)
	{
		global $core;

		$keys = array();

		foreach ($records as $record)
		{
			$keys[] = $record->uid;
		}

		if (!$keys)
		{
			return $records;
		}

		$login_count_collection = $core->models['users.logins']
		->filter_by_uid($keys)
		->count('uid');

		foreach ($records as $record)
		{
			$record->login_count = isset($login_count_collection[$record->uid]) ? $login_count_collection[$record->uid] : 0;
		}

		return $records;
	}

	public function render_cell($record)
	{
		return $record->login_count;
	}
}