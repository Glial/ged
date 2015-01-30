<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class menu extends Model
{
var $schema = "CREATE TABLE `menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8";

var $field = array("id","parent_id","position","group_id","title","url","class");

var $validate = array(
	'parent_id' => array(
		'numeric' => array('This must be an int.')
	),
	'position' => array(
		'numeric' => array('This must be an int.')
	),
	'group_id' => array(
		'numeric' => array('This must be an int.')
	),
);

function get_validate()
{
return $this->validate;
}
}
