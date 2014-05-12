<?php

use \Glial\Synapse\Controller;

class Error extends Controller
{
    use \Glial\Neuron\Controller\Error;
    
    function _404()
    {
		$this->title = __("Error 404");
		$this->ariane = " > ".__("This page doesn't exit !");
        
        
    }
    
    
}
