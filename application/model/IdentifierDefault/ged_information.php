<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class ged_information extends Model
{
var $schema = "CREATE TABLE `ged_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_event` int(11) NOT NULL,
  `date_saved` int(11) NOT NULL,
  `amount` double NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `file_md5` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

var $field = array("id","date_event","date_saved","amount","file_md5","title","description");

var $validate = array(
	'date_event' => array(
		'numeric' => array('This must be an int.')
	),
	'date_saved' => array(
		'numeric' => array('This must be an int.')
	),
);

function get_validate()
{
return $this->validate;
}
}
