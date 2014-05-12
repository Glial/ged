<?php

namespace Application\Model\Identifier0;
use \Glial\Synapse\Model;
class job_queue extends Model
{
var $schema = "CREATE TABLE `job_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmd` varchar(200) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8";

var $field = array("id","cmd","date_start","date_end","min","max","length","status");

var $validate = array(
	'cmd' => array(
		'not_empty' => array('This field is requiered.')
	),
	'date_start' => array(
		'datetime' => array('This must be a date time.')
	),
	'date_end' => array(
		'datetime' => array('This must be a date time.')
	),
	'min' => array(
		'numeric' => array('This must be an int.')
	),
	'max' => array(
		'numeric' => array('This must be an int.')
	),
	'length' => array(
		'numeric' => array('This must be an int.')
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
