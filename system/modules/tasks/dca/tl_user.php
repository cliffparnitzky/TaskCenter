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
 * Adding the task center settings to the login pallet of the user
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['login'] .= ';{taskcenter_legend},tasksUseIcons';

/**
 * Adding the fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['tasksUseIcons'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['tasksUseIcons'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'                 => 1,
	'eval'                    => array('tl_class'=>'w50 clr'),
	'sql'                     => "char(1) NOT NULL default '1'"
);

?>