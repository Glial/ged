<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class translation_en extends Model
{
var $schema = "CREATE TABLE `translation_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_history_etat` int(11) NOT NULL,
  `key` char(40) NOT NULL,
  `source` char(2) NOT NULL,
  `text` text NOT NULL,
  `date_inserted` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `translate_auto` int(11) NOT NULL,
  `file_found` varchar(255) NOT NULL,
  `line_found` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`,`file_found`),
  KEY `id_history_etat` (`id_history_etat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

var $field = array("id","translate_auto","date_updated","date_inserted","id_history_etat","line_found","source","key","file_found","text");

var $validate = array(
	'translate_auto' => array(
		'numeric' => array('This must be an int.')
	),
	'date_updated' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'date_inserted' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'id_history_etat' => array(
		'reference_to' => array('The constraint to history_etat.id isn\'t respected.','history_etat', 'id')
	),
	'line_found' => array(
		'numeric' => array('This must be an int.')
	),
);

function get_validate()
{
return $this->validate;
}
}
