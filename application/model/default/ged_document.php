<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class ged_document extends Model
{
var $schema = "CREATE TABLE `ged_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

var $field = array("id","document");

var $validate = array(
	'document' => array(
		'not_empty' => array('This field is requiered.')
	),
);

function get_validate()
{
return $this->validate;
}
}
