<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class ged_information extends Model
{
var $schema = "CREATE TABLE `ged_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_event` int(11) NOT NULL,
  `date_saved` int(11) NOT NULL,
  `file_name` varchar(190) NOT NULL,
  `amount` double NOT NULL,
  `payed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

var $field = array("id","date_event","date_saved","file_name","amount","payed");

var $validate = array(
	'date_event' => array(
		'numeric' => array('This must be an int.')
	),
	'date_saved' => array(
		'numeric' => array('This must be an int.')
	),
	'file_name' => array(
		'not_empty' => array('This field is requiered.')
	),
	'amount' => array(
		'not_empty' => array('This field is requiered.')
	),
	'payed' => array(
		'numeric' => array('This must be an int.')
	),
);

function get_validate()
{
return $this->validate;
}
}
