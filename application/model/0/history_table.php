<?php

namespace Application\Model\Identifier0;
use \Glial\Synapse\Model;
class history_table extends Model
{
var $schema = "CREATE TABLE `history_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_insterted` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name` (`name`),
  CONSTRAINT `history_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `history_main` (`id_history_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

var $field = array("id","name","date_insterted");

var $validate = array(
	'name' => array(
		'not_empty' => array('This field is requiered.')
	),
	'date_insterted' => array(
		'datetime' => array('This must be a date time.')
	),
);

function get_validate()
{
return $this->validate;
}
}
