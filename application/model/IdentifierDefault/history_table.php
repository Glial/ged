<?php

namespace Application\Model\IdentifierDefault;
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

var $field = array("id","date_insterted","name");

var $validate = array(
	'date_insterted' => array(
		'dateTime' => array('This must be a datetime.')
	),
);

function get_validate()
{
return $this->validate;
}
}
