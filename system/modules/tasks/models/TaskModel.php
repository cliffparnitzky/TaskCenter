<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Tasks;

use \Contao\UserModel;


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

	/**
	 * List all task updates
	 * @param array
	 * @return string
	 */
	public function listStatusUpdates($arrRow)
	{
		$return = ' <span class="tl_gray">' . $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']).' - '.UserModel::findOneById($arrRow['createdBy'])->name.'</span>';
		$return .= '<div class="comment">'.$arrRow['comment'].'</div>';

		unset($arrRow['comment']);
		unset($arrRow['id']);
		unset($arrRow['pid']);
		unset($arrRow['tstamp']);
		unset($arrRow['createdAt']);
		unset($arrRow['createdBy']);

		$return .= '<ul class="updated">';
		foreach($arrRow as $k=>$v)
		{
			if($v < 1)
			{
				// not false so something has changed
				continue;
			}

			if($k === 'assignedTo')
			{
				$v = UserModel::findOneById($v)->name;
			}

			if($k === 'progress')
			{
				$v = $v.'%';
			}

			if(is_string($GLOBALS['TL_LANG']['tl_task'][$k]))
			{
				$k = $GLOBALS['TL_LANG']['tl_task'][$k];
			}
			elseif(is_array($GLOBALS['TL_LANG']['tl_task'][$k]))
			{
				$k = $GLOBALS['TL_LANG']['tl_task'][$k][0];
			}

			$return .= '<li>'.$k.': '.$v.'</li>';
		}
		$return .= '</ul>';

		return $return;
	}

	public function getCurrentAssignedUser()
	{
		$objResult = \Database::getInstance()->prepare("SELECT `assignedTo`, `tstamp` FROM `tl_task_status` WHERE pid=? AND `assignedTo` > 0 ORDER BY `createdAt` DESC")
									 ->limit(1)
									 ->execute($this->id);

		$return = null;

		while ($objResult->next())
		{
			if($intUserId = $objResult->assignedTo)
			{
				$return = UserModel::findOneById($intUserId)->name;
			}			
		}

		return $return;
	}

	public static function getCurrentAssignedUserByTaskId($id)
	{
		return static::findOneById($id)->getCurrentAssignedUser();
	}

	public function getCurrentProgress()
	{
		$objResult = \Database::getInstance()->prepare("SELECT `progress` FROM `tl_task_status` WHERE pid=? AND `progress` IS NOT NULL ORDER BY `createdAt` DESC")
									 ->limit(1)
									 ->execute($this->id);
		$return = '0';

		while ($objResult->next())
		{
			$return = $objResult->progress;			
		}

		return $return;
	}

	public static function getCurrentProgressByTaskId($id)
	{
		return static::findOneById($id)->getCurrentProgress();
	}
}
