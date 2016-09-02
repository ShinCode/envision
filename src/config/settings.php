<?php

return array(


	/*
	|--------------------------------------------------------------------------
	| Autoload Envision classes without creating aliases
	|--------------------------------------------------------------------------
	|
	| Recommended to be true when:
	| - in development
	| - while fast prototyping
	| - when 'create' is true
	|
	| For optimal performance, it's recommended to switch this off
	| and reference Repositories properly either in composer.json or
	| by using namespaces.
	|
	*/

	'autoload' => false,

	/*
	|--------------------------------------------------------------------------
	| Create classes when not found
	|--------------------------------------------------------------------------
	|
	| When on, the following classes will be generated when not found:
	| - Repository
	|
	| Not recommended during deployment, but recommended for fast development
	| Keeping 'autoload' on true makes it load the generated classes immediately
	| as well.
	|
	*/

	'create' => false,


	/*
	|--------------------------------------------------------------------------
	| Logging
	|--------------------------------------------------------------------------
	|
	| Use Laravel logging for irreversable actions like deleting files.
	| Set as '' or false if you don't wish to log (not recommended).
	| (Not yet functional)
	|
	*/

	'log' => true,

);
