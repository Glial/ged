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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8";

var $field = array("id","parent_id","title","url","class","position","group_id");

var $validate = array(
	'parent_id' => array(
		'numeric' => array('This must be an int.')
	),
	'title' => array(
		'not_empty' => array('This field is requiered.')
	),
	'url' => array(
		'not_empty' => array('This field is requiered.')
	),
	'class' => array(
		'not_empty' => array('This field is requiered.')
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
