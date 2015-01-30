<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class link__ged_information__ged_tag extends Model
{
var $schema = "CREATE TABLE `link__ged_information__ged_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ged_information` int(11) NOT NULL,
  `id_ged_tag` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_facture_main` (`id_ged_information`,`id_ged_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

var $field = array("id","id_ged_information","id_ged_tag","date_added");

var $validate = array(
	'id_ged_information' => array(
		'reference_to' => array('The constraint to ged_information.id isn\'t respected.','ged_information', 'id')
	),
	'id_ged_tag' => array(
		'reference_to' => array('The constraint to ged_tag.id isn\'t respected.','ged_tag', 'id')
	),
	'date_added' => array(
		'dateTime' => array('This must be a datetime.')
	),
);

function get_validate()
{
return $this->validate;
}
}
