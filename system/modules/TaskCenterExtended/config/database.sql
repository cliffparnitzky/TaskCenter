-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_task`
-- 

CREATE TABLE `tl_task` (
  `priority` varchar(32) NOT NULL default '3_normal',
  `tasktype` varchar(32) NOT NULL default 'exercise',
  `project` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8; 

-- --------------------------------------------------------

-- 
-- Table `tl_task_status`
-- 

CREATE TABLE `tl_task_status` (
  `commentBy` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_task_project`
-- 
CREATE TABLE `tl_task_project` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `shortname` varchar(32) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `number` varchar(32) NOT NULL default '',
  `description` text NULL,
  `manager` int(10) unsigned NOT NULL default '0',
  `manager_deputy` int(10) unsigned NOT NULL default '0',
  `notifyManagement` char(1) NOT NULL default '', 
  `allowGroups` char(1) NOT NULL default '', 
  `userGroups` blob NULL,
  `memberGroups` blob NULL,
  `published` char(1) NOT NULL default '',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_user`
-- 
CREATE TABLE `tl_user` (
  `taskcenterEmailToYourself` char(1) NOT NULL default '',
  `taskcenterHistorySorting` varchar(4) NOT NULL default 'ASC', 
  `taskcenterColumnsVisibility` blob NULL,
  `taskcenterColumnsShortnameUsage` char(1) NOT NULL default '1',
  `taskcenterIconUsage` char(1) NOT NULL default '1',
  `taskcenterIconPriorityIconSet` varchar(32) NOT NULL default 'flags',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_task_workflow`
-- 
CREATE TABLE `tl_task_workflow` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `shortname` varchar(32) NOT NULL default '',
  `creators` varchar(128) NOT NULL default '',
  `description` text NULL,
  `previewImage` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_task_workflow_steps`
-- 
CREATE TABLE `tl_task_workflow_transitions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `tasktype` varchar(32) NOT NULL default 'exercise',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;