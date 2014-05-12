<?php

namespace Application\Model\Identifier0;
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

var $field = array("id","name","date_start","date_end","status");

var $validate = array(
	'name' => array(
		'not_empty' => array('This field is requiered.')
	),
	'date_start' => array(
		'datetime' => array('This must be a date time.')
	),
	'date_end' => array(
		'datetime' => array('This must be a date time.')
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
