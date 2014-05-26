<?php

use \Glial\Synapse\Controller;

class Ged extends Controller
{

    function index()
    {
        
    }

    function see()
    {
        $this->title = "GED";
        $this->ariane = " > " . $this->title;

        $db = $this->di['db']->sql('default');

        $sql = "SELECT * FROM ged_information a "
                . "INNER JOIN link__ged_information__ged_tag b ON a.id = b.id_ged_information "
                . "INNER JOIN get_tag c on c.id = b.id_ged_tag "
                . "ORDER BY date_saved ";



        $res = $db->sql_query($sql);


        $data['elems'] = array();
        while ($ob = $db->sql_fetch_object($res)) {

            $data['elems'][] = $ob;
        }
    }

    function add()
    {
        
        $db = $this->di['db']->sql('default');
        
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            
            
            $data = array();
            $data['ged_information'] = $_POST['ged_information'];
            $data['ged_information']['date_saved'] = date('Y-m-d H:i:s');
            
            
        }
        
        
        
        $this->title = __("Add");
        $this->ariane = ' > <a href="' . LINK . 'ged/index">GED</a> > ' . $this->title;

        $this->addJavascript(array("jquery-latest.min.js","http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" ,"bootstrap-datepicker.js"));
        $this->code_javascript[] = "$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-1m'
})";

        

        $sql = "SELECT * FROM `get_tag` order by libelle";
        $res = $db->sql_query($sql);

        $data['tag'] = array();
        while ($ob = $db->sql_fetch_object($res)) {

            $tag = array();
            $tag['id'] = $ob->id;
            $tag['libelle'] = $ob->libelle;
            
            $data['tag'][] = $tag;
        }
        

        $this->set('data',$data);
    }

}
