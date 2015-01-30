<?php

namespace Application\Model\IdentifierDefault;
use \Glial\Synapse\Model;
class user_main extends Model
{
var $schema = "CREATE TABLE `user_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_valid` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `id_geolocalisation_country` int(11) NOT NULL,
  `id_geolocalisation_city` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `date_last_login` datetime NOT NULL,
  `date_last_connected` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `key_auth` char(40) NOT NULL,
  `id_group` int(11) NOT NULL DEFAULT '1',
  `avatar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`),
  KEY `id_geolocalisation_country` (`id_geolocalisation_country`),
  KEY `id_geolocalisation_city` (`id_geolocalisation_city`),
  KEY `id_group` (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8";

var $field = array("id","id_group","date_created","date_last_connected","date_last_login","points","id_geolocalisation_city","id_geolocalisation_country","is_valid","ip","firstname","name","password","key_auth","email","login","avatar");

var $validate = array(
	'id_group' => array(
		'reference_to' => array('The constraint to group.id isn\'t respected.','group', 'id')
	),
	'date_created' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'date_last_connected' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'date_last_login' => array(
		'dateTime' => array('This must be a datetime.')
	),
	'points' => array(
		'numeric' => array('This must be an int.')
	),
	'id_geolocalisation_city' => array(
		'reference_to' => array('The constraint to geolocalisation_city.id isn\'t respected.','geolocalisation_city', 'id')
	),
	'id_geolocalisation_country' => array(
		'reference_to' => array('The constraint to geolocalisation_country.id isn\'t respected.','geolocalisation_country', 'id')
	),
	'is_valid' => array(
		'numeric' => array('This must be an int.')
	),
	'ip' => array(
		'ip' => array('your IP is not valid')
	),
	'email' => array(
		'email' => array('your email is not valid')
	),
);

function get_validate()
{
return $this->validate;
}
}
