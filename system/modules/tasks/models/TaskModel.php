<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Tasks;


/**
 * Reads and writes tasks
 */
class TaskModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_tasks';

	
}
