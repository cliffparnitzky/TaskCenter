<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    TaskCenterExtended
 * @license    LGPL
 */

/**
 * Class TaskCenterMailSender
 *
 * Provide methods to run send mails from task center
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class TaskCenterMailSender extends Backend
{
	/**
	 * Sends the notification email.
	 */
	public function sendNotificationMail($objTask, $arrTaskStatus, $fromUser) {
		$toUser = $this->Database->prepare("SELECT id, name, email, language FROM tl_user WHERE id=?")
								  ->limit(1)
								  ->execute($arrTaskStatus['assignedTo']);

		if ($toUser->numRows && $this->sendMailToUser($fromUser, $toUser))
		{
			$this->loadLanguageFile('tl_task_mail', $toUser->language);
			
			$objEmail = new Email();

			$objEmail->from = $GLOBALS['TL_ADMIN_EMAIL'];
			$objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];
			$objEmail->subject = $this->replaceTaskAttributes($GLOBALS['TL_LANG']['tl_task_mail']['notification']['subject'], $objTask, $arrTaskStatus, $fromUser, $toUser);

			$objEmail->text = $this->replaceTaskAttributes($GLOBALS['TL_LANG']['tl_task_mail']['notification']['plain'], $objTask, $arrTaskStatus, $fromUser, $toUser);
			$objEmail->html = $this->replaceTaskAttributes($GLOBALS['TL_LANG']['tl_task_mail']['notification']['html'], $objTask, $arrTaskStatus, $fromUser, $toUser, true);
			
			/*echo $objEmail->subject;
			echo '<pre>' . $objEmail->text . '</pre>';
			echo $objEmail->html;*/
		
			$objEmail->sendTo($toUser->email);
		}
	}
	
	/**
	 * Checks if the users are equal. If not, returns true. If they are the same, return the setting for taskcenterEmailToYourself.
	 */
	private function sendMailToUser($fromUser, $toUser)
	{
		if ($toUser->id != $fromUser->id)
		{
			return true;
		}
		return $fromUser->taskcenterEmailToYourself;	
	}
	
	/**
	 * Checks, which tasks deadline will be reached soon and sends an email to the assignee.
	 */
	public function sendDeadlineNotificationMail()
	{
		$this->log('Daily sending of DeadlineNotificationMail for taks is not yet implementet.', 'ModuleTasksExtended sendDeadlineNotificationMail()', TL_CRON);
	}
	
	/**
	 * Strip tags preserving HTML comments
	 * @param  mixed
	 * @param  string
	 * @return mixed
	 */
	private function stripTags($varValue, $strAllowedTags='') {
		// Recursively clean arrays
		if (is_array($varValue)) {
			foreach ($varValue as $k=>$v) {
				$varValue[$k] = $this->stripTags($v, $strAllowedTags);
			}
			return $varValue;
		}

		$varValue = str_replace(array('<!--','<![', '-->'), array('&lt;!--', '&lt;![', '--&gt;'), $varValue);
		$varValue = strip_tags($varValue, $strAllowedTags);
		$varValue = str_replace(array('&lt;!--', '&lt;![', '--&gt;'), array('<!--', '<![', '-->'), $varValue);

		return $varValue;
	}
	
	/**
	 * Replacing the task attributes in the given string.
	 */
	private function replaceTaskAttributes($string, $objTask, $arrTaskStatus, $fromUser, $toUser, $allowHtml=false) {
		$this->loadLanguageFile('tl_task', $toUser->language);
		
		$string = str_replace('{{task::link}}', $this->Environment->base . 'contao/main.php?do=tasks&act=show&id=' . $objTask->id, $string);
		$string = str_replace('{{task::id}}', $objTask->id, $string);
		$string = str_replace('{{task::project}}', $objTask->projectName, $string);
		$string = str_replace('{{task::creator}}', $objTask->creator, $string);
		$string = str_replace('{{task::title}}', $objTask->title, $string);
		$string = str_replace('{{task::deadline}}', date($GLOBALS['TL_CONFIG']['dateFormat'], $objTask->deadline), $string);
		$string = str_replace('{{task::type}}', $GLOBALS['TL_LANG']['tl_task_tasktype'][$objTask->tasktype], $string);
		$string = str_replace('{{task::priority}}', $GLOBALS['TL_LANG']['tl_task_priority'][$objTask->priority], $string);
		$string = str_replace('{{task::assignedTo}}', $toUser->name, $string);
		$string = str_replace('{{task::status}}', $GLOBALS['TL_LANG']['tl_task_status'][$arrTaskStatus['status']], $string);
		$string = str_replace('{{task::progress}}', $arrTaskStatus['progress'], $string);
		if ($allowHtml) {
			$string = str_replace('{{task::comment}}', $this->restoreBasicEntities($arrTaskStatus['comment']), $string);
		} else {
			$string = str_replace('{{task::comment}}', $this->stripTags($this->restoreBasicEntities($arrTaskStatus['comment'])), $string);
		}		
		$string = str_replace('{{task::editor}}', $fromUser->name, $string);
		$string = str_replace('{{task::creation_time}}', date($GLOBALS['TL_CONFIG']['datimFormat'], $objTask->tstamp), $string);
		$string = str_replace('{{task::update_time}}', date($GLOBALS['TL_CONFIG']['datimFormat'], $arrTaskStatus['tstamp']), $string);
		return $string;
	}
}

?>