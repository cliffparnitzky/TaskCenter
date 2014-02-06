<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Tasks
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Tasks',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Tasks\TaskFilter'         => 'system/modules/tasks/classes/TaskFilter.php',
	'Tasks\TaskHooks'          => 'system/modules/tasks/classes/TaskHooks.php',
	'Tasks\TaskMailer'         => 'system/modules/tasks/classes/TaskMailer.php',
	'Tasks\TaskValueFormatter' => 'system/modules/tasks/classes/TaskValueFormatter.php',

	// Models
	'Tasks\TaskModel'          => 'system/modules/tasks/models/TaskModel.php',
));
