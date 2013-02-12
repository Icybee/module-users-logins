# The "Logins" module (`users.logins`)

Record users login times and IPs.





## Requirements

This module requires the CMS [Icybee](http://icybee.org).





## Installation

The recommended way to install this module is through [composer](http://getcomposer.org/).
Create a `composer.json` file and run `php composer.phar install` command to install it:

```json
{
    "minimum-stability": "dev",
    "require": {
		"icybee/module-users-logins": "*"
    }
}
```





### Cloning the repository

The package is [available on GitHub](https://github.com/Icybee/module-users-logins), its repository can be
cloned with the following command line:

	$ git clone git://github.com/Icybee/module-users-logins.git





## Event hooks

### `Icybee\Modules\Users\DeleteOperation::process:before`

An event hook is attache to the `process:before` event of `Icybee\Modules\Users\DeleteOperation`
instances to delete the records associate with a user, before the user is deleted.





### `Icybee\Modules\Users\LoginOperation::process`

An event hook is attached to the `process` event of `Icybee\Modules\Users\LoginOperation` instances
to record the time and IP of the user loggin in.





## Prototype methods

The following prototype methods are added to the user object (`Icybee\Modules\Users\User`).





### `get_last_login_times`

Returns the last five login times for a user:

```php
<?php

var_dump($user->last_login_times);
```




### `get_login_count`

Returns the number of login for a user:

```php
<?php

echo "Number of login for {$user->name}: {$user->login_count}";
```





## License

This module is licensed under the New BSD License - See the LICENSE file for details.