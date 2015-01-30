<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class job_main extends Model
{
var $schema = "CREATE TABLE `job_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

var $field = array("id","date_start","date_end","status","name");

var $validate = array(
	'date_start' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'date_end' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'status' => array(
		'numeric' => array('This must be an int.')
	),
);

function get_validate()
{
return $this->validate;
}
}
