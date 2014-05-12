<?php

namespace Application\Model\Identifier0;
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

var $field = array("id","is_valid","login","email","password","name","firstname","ip","id_geolocalisation_country","id_geolocalisation_city","points","date_last_login","date_last_connected","date_created","key_auth","id_group","avatar");

var $validate = array(
	'is_valid' => array(
		'numeric' => array('This must be an int.')
	),
	'login' => array(
		'not_empty' => array('This field is requiered.')
	),
	'email' => array(
		'email' => array('your email is not valid')
	),
	'password' => array(
		'not_empty' => array('This field is requiered.')
	),
	'name' => array(
		'not_empty' => array('This field is requiered.')
	),
	'firstname' => array(
		'not_empty' => array('This field is requiered.')
	),
	'ip' => array(
		'ip' => array('your IP is not valid')
	),
	'id_geolocalisation_country' => array(
		'reference_to' => array('The constraint to geolocalisation_country.id isn\'t respected.','geolocalisation_country', 'id')
	),
	'id_geolocalisation_city' => array(
		'reference_to' => array('The constraint to geolocalisation_city.id isn\'t respected.','geolocalisation_city', 'id')
	),
	'points' => array(
		'numeric' => array('This must be an int.')
	),
	'date_last_login' => array(
		'datetime' => array('This must be a date time.')
	),
	'date_last_connected' => array(
		'datetime' => array('This must be a date time.')
	),
	'date_created' => array(
		'datetime' => array('This must be a date time.')
	),
	'key_auth' => array(
		'not_empty' => array('This field is requiered.')
	),
	'id_group' => array(
		'reference_to' => array('The constraint to group.id isn\'t respected.','group', 'id')
	),
	'avatar' => array(
		'not_empty' => array('This field is requiered.')
	),
);

function get_validate()
{
return $this->validate;
}
}
