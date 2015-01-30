<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class get_tag extends Model
{
var $schema = "CREATE TABLE `get_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(32) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4";

var $field = array("id","date_start","date_end","libelle");

var $validate = array(
	'date_start' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'date_end' => array(
		'dateTime' => array('This must be a datetime.')
	),
);

function get_validate()
{
return $this->validate;
}
}
