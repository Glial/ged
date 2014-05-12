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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

var $field = array("id","libelle","date_start","date_end");

var $validate = array(
	'libelle' => array(
		'not_empty' => array('This field is requiered.')
	),
	'date_start' => array(
		'datetime' => array('This must be a date time.')
	),
	'date_end' => array(
		'datetime' => array('This must be a date time.')
	),
);

function get_validate()
{
return $this->validate;
}
}
