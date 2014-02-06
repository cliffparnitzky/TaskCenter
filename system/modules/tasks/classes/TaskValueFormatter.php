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
 * Class TaskValueFormatter
 *
 * Provide methods to get task values formated
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Tasks
 */
class TaskValueFormatter extends \Backend
{
	/**
	 * Initialize the object
	 */
	protected function __construct()
	{
		parent::__construct();
		$this->loadLanguageFile('tl_task');
		$this->loadLanguageFile('tl_task_status');
	}

	/**
	 * Returns the given tasktype in a formated form
	 */
	public static function getTasktypeFormated($value, $blnImage = false, $blnImageAndText = false)
	{
		if ($value == null && is_array($GLOBALS['TL_LANG']['tl_task']['tasktype_values']))
		{
			$value = TaskModel::getDefaultValue('tasktype');
		}
		
		$outTxt = $GLOBALS['TL_LANG']['tl_task']['tasktype_values'][$value];
		$outImg = '<img src="' . TL_FILES_URL . 'system/modules/tasks/html/tasktype/' . $value . '.png" width="16" height="16" alt="' . $outTxt . '" title="' . $outTxt . '" />';
		
		if ($blnImage && \BackendUser::getInstance()->tasksUseIcons)
		{
			if ($blnImageAndText)
			{
				return $outImg . ' ' . $outTxt;
			}
			return $outImg;
		}
		return $outTxt;
	}
	
	/**
	 * Returns the given tasktype in a formated form (searches by label)
	 */
	public static function getTasktypeFormatedByLabel($label, $blnImage = false, $blnImageAndText = false)
	{
		$value = static::getKeyByLabel($GLOBALS['TL_LANG']['tl_task']['tasktype_values'], $label);
		return static::getTasktypeFormated($value, $blnImage, $blnImageAndText);
	}
	
	/**
	 * Returns the given priority in a formated form
	 */
	public static function getPriorityFormated($value, $blnImage = false, $blnImageAndText = false)
	{
		if ($value == null && is_array($GLOBALS['TL_LANG']['tl_task']['priority_values']))
		{
			$value = TaskModel::getDefaultValue('priority');
		}
		
		$outTxt = $GLOBALS['TL_LANG']['tl_task']['priority_values'][$value];
		$outImg = '<img src="' . TL_FILES_URL . 'system/modules/tasks/html/priority/' . $value . '.png" width="16" height="16" alt="' . $outTxt . '" title="' . $outTxt . '" />';
		
		if ($blnImage && \BackendUser::getInstance()->tasksUseIcons)
		{
			if ($blnImageAndText)
			{
				return $outImg . ' ' . $outTxt;
			}
			return $outImg;
		}
		return $outTxt;
	}
	
	/**
	 * Returns the given priority in a formated form (searches by label)
	 */
	public static function getPriorityFormatedByLabel($label, $blnImage = false, $blnImageAndText = false)
	{
		$value = static::getKeyByLabel($GLOBALS['TL_LANG']['tl_task']['priority_values'], $label);
		return static::getPriorityFormated($value, $blnImage, $blnImageAndText);
	}
	
	/**
	 * Returns the given status in a formated form
	 */
	public static function getStatusFormated($value, $blnImage = false, $blnImageAndText = false)
	{
		if ($value == null && is_array($GLOBALS['TL_LANG']['tl_task_status']['status_values']))
		{
			$value = TaskModel::getDefaultValue('status');
		}
		
		$outTxt = $GLOBALS['TL_LANG']['tl_task_status']['status_values'][$value][0];
		$outImg = '<img src="' . TL_FILES_URL . 'system/modules/tasks/html/status/' . $value . '.png" width="16" height="16" alt="' . $outTxt . '" title="' . $outTxt . '" />';
		
		if ($blnImage && \BackendUser::getInstance()->tasksUseIcons)
		{
			if ($blnImageAndText)
			{
				return $outImg . ' ' . $outTxt;
			}
			return $outImg;
		}
		return $outTxt;
	}
	
	/**
	 * Returns the given status in a formated form (searches by label)
	 */
	public static function getStatusFormatedByLabel($label, $blnImage = false, $blnImageAndText = false)
	{
		$value = static::getKeyByLabel($GLOBALS['TL_LANG']['tl_task_status']['status_values'], $label);
		return static::getStatusFormated($value, $blnImage, $blnImageAndText);
	}
	
	/**
	 * Returns the given progress in a formated form
	 */
	public static function getProgressFormated($value, $blnImage = false, $blnImageAndText = false)
	{
		if ($value == null && is_array($GLOBALS['TL_LANG']['tl_task_status']['progress_values']))
		{
			$value = TaskModel::getDefaultValue('progress');
		}
		
		$outTxt = $GLOBALS['TL_LANG']['tl_task_status']['progress_values'][$value];
		$outImg = '<img src="' . TL_FILES_URL . 'system/modules/tasks/html/progress/' . $value . '.png" width="33" height="16" alt="' . $outTxt . '" title="' . $outTxt . '" />';
		
		if ($blnImage && \BackendUser::getInstance()->tasksUseIcons)
		{
			if ($blnImageAndText)
			{
				return $outImg . ' ' . $outTxt;
			}
			return $outImg;
		}
		return $outTxt;
	}
	
	/**
	 * Returns the given progress in a formated form (searches by label)
	 */
	public static function getProgressFormatedByLabel($label, $blnImage = false, $blnImageAndText = false)
	{
		$value = static::getKeyByLabel($GLOBALS['TL_LANG']['tl_task_status']['progress_values'], $label);
		return static::getProgressFormated($value, $blnImage, $blnImageAndText);
	}
	
	/**
	 * Returns the given user in a formated form
	 */
	public static function getAssignedUserFormated($user)
	{
		if ($user == null)
		{
			return $GLOBALS['TL_LANG']['TaskCenter']['notAssigned'];
		}
		return $user->name;
	}
	
	/**
	 * Returns the index of the given field in the task table.
	 *
	 * @return The index or FALSE, if nothing found
	 */
	public static function getTaskTableFieldIndex ($field)
	{
		$indices = array_keys($GLOBALS['TL_DCA']['tl_task']['list']['label']['fields'], $field);
		if (is_array($indices) && count($indices) > 0)
		{
			return $indices[0];
		}
		return FALSE;
	}
	
	/**
	 * Returns the key for a label
	 */
	public static function getKeyByLabel ($arrLabelDefinitions, $actLabel)
	{
		foreach ($arrLabelDefinitions as $key => $definition)
		{
			$label = $definition;
			if(is_array($definition))
			{
				$label = $definition[0];
			}
			if ($label == $actLabel)
			{
				return $key;
			}
		}
		return null;
	}
}

?>