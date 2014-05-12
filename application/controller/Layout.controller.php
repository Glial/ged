<?php

use \Glial\Synapse\Controller;

class Layout extends Controller
{

    function header($title)
    {
        $this->set('GLIALE_TITLE', $title);
    }

    function footer()
    {
        
    }

}
