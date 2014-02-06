<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  Leo Feyer 2005-2012
 * @copyright  Cliff Parnitzky 2013
 * @package    Tasks
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Tasks;

/**
 * Class TaskMailer
 *
 * Provide methods to mail task infos
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Tasks
 */
class TaskMailer extends \Backend
{
	const CREATED = 'CREATED';
	const UPDATED = 'UPDATED';
	const DELETED = 'DELETED';

	private static $INSTANCE;

	protected function __construct()
	{
		parent::__construct();
	}

	/**
	 * Returns the singlton instance of the mailer.
	 */
	public static function getInstance()
	{
		if (!isset(self::$INSTANCE))
		{
			self::$INSTANCE = new TaskMailer();
		}
		return self::$INSTANCE;
	}
	
	/**
	 * Sends a mail for tasks
	 * 
	 * @param $taskId The id of the task
	 * @param $action The action that will send the mail.
	 */
	public function sendTaskMail($taskId, $action)
	{
		$this->log("Will send a mail that task[" . $taskId . "] was " . $action, "TaskMailer sendTaskMail()", TL_GENERAL);
	}

	/**
	 * Sends a mail for tasks status
	 * 
	 * @param $taskId The id of the task
	 * @param $taskStatusId The id of the task status
	 * @param $action The action that will send the mail.
	 */
	public function sendTaskStatusMail($taskId, $taskStatusId, $action)
	{
		$this->log("Will send a mail that task status [" . $taskStatusId . "] (Task: " . $taskId . ") was " . $action, "TaskMailer sendTaskStatusMail()", TL_GENERAL);
		
		//$objTaskStatus = \TaskModel::getLastActiveTaskStatusForTask($taskId, $dc->id);
		//
		//if ($objTaskStatus)
		//{
		//	$this->updateTaskValues(CURRENT_ID, $objTaskStatus->status, $objTaskStatus->progress, $objTaskStatus->assignedTo);
		//}
	}
}

?>