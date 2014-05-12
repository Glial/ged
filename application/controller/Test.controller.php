<?php

use \Glial\Synapse\Controller;
use \Glial\Acl\Acl;
use \Glial\Cli\Table;
use \Glial\Cli\Color;
use \Glial\Cli\Glial;
use \Glial\Cli\Window;
use \Glial\Sgbd\Sql\FactorySql;
use \Glial\Synapse\Config;
use Vatson\Callback\IsolatedCallback;
use Glial\Cli\Ansi;
use Glial\Cli\Ansi\Sprite;
use Glial\Cli\Ansi\Point;

function sig_handler($signo)
{
    global $parallel, $childId;
    switch ($signo) {
        case SIGCHLD:
            $parallel--;
            echo "--SIGCHLD recu pour le fils #$childId" . PHP_EOL;
            echo "Decrementation a $parallel" . PHP_EOL;
            break;

        case SIGTERM:
            echo "--Reçu le signe SIGTERM...\n";
            exit;
            break;
        case SIGHUP:
            echo "--Reçu le signe SIGHUP redémarrage...\n"; // gestion du 
            break;
        case SIGUSR1:
            echo "--Reçu le signe SIGUSR1...\n";
            break;
        default:
            echo "----recu :" . $signo . PHP_EOL;
            break;
    }
}

class Test extends Controller
{

    use \Glial\Neuron\Controller\Test;

    function index()
    {
        $this->view = false;


        $tab = new Table(0);
        $tab->addHeader(array("top", "colonne", "Libelle"));
        $tab->addLine(array("3", "sfhgh", "dfxhxsfht"));
        $tab->addLine(array("2", Color::getColoredString("Testing Colors class, " . Color::getColoredString("Testing Colors class, this is purple string on yellow background.", "red", "blue") . " is purple string on yellow background.", "purple", "yellow"), "dfxhxsfht6"));

        for ($i = 0; $i < 10; $i++) {

            $tab->flushAll();
            $tab->addHeader(array("top", date('H:i:s'), "Libelle"));
            $tab->addLine(array("3", "sfhgh", "dfxhxsfht"));
            $tab->addLine(array("2", Color::getColoredString("Testing Colors class, " . Color::getColoredString("Testing Colors class, this is purple string on yellow background.", "red", "blue") . " is purple string on yellow background.", "purple", "yellow"), "dfxhxsfht6"));

            $data = $tab->display();

            $gg = substr_count($data, "\n");

            echo $data;

            sleep(1);

            echo "\033[" . $gg . "A";
        }

        echo "\033[" . $gg . "B";
    }

    function mysql($param)
    {
        $this->view = false;

        $file_name = $param[0];

        $cmd = "cat /proc/cpuinfo | grep processor | wc -l";
        $nb_thread_max = exec($cmd);

        $octet = 0;

        if (file_exists($file_name)) {

            $total_size = exec("du -b " . $file_name, $exit);

            $line = 0;
            $pointeur = array();

            if ($fh = fopen($file_name, "r")) {
                while (!feof($fh)) {
                    $line++;
                    //echo fgets($fh);
                    $octet += strlen($str = fgets($fh));

                    if (substr($str, 0, 10) === "DROP TABLE") {
                        $pointeur[] = array($line, $octet);
                        $octet = 0;
                        echo "--" . $str;
                    }
                }
                fclose($fh);
            }
        }



        echo "full size : " . $total_size . PHP_EOL;
        echo "octet     : " . $octet . PHP_EOL;
        // 1 091 954 121
        // 1 091 954 121
        // 1 091 954 121

        $min = 0;


        $sql = "truncate table job_queue";
        $this->db['default']->sql_query($sql);

        foreach ($pointeur as $elem) {
            $max = $elem[0];

            $data = array();
            $data['job_queue']['min'] = $min;
            $data['job_queue']['max'] = $max;
            $data['job_queue']['cmd'] = "gg";
            $data['job_queue']['status'] = 0;
            $data['job_queue']['length'] = $elem[1];

            if (!$this->db['default']->sql_save($data)) {
                debug($this->db['default']->sql_error());
                exit(10);
            }

            $min = $max;
        }

        $sql = "select max(id) as maxi, min(id) as mini from job_queue";
        $res = $this->db['default']->sql_query($sql);

        while ($ob = $this->db['default']->sql_fetch_object($res)) {
            $first_thread = $ob->mini;
            $last_thread = $ob->maxi;
        }


        $childId = 0;
        $parallel = 0;
        $sig_handler = function ($signo) {
            global $parallel, $childId;
            switch ($signo) {
                case SIGCHLD:
                    $parallel++;
                    echo "--SIGCHLD recu pour le fils #$childId" . PHP_EOL;
                    echo "Decrementation a $parallel" . PHP_EOL;
                    break;

                case SIGTERM:
                    echo "--Reçu le signe SIGTERM...\n";
                    exit;
                    break;
                case SIGHUP:
                    echo "--Reçu le signe SIGHUP redémarrage...\n"; // gestion du 
                    break;
                case SIGUSR1:
                    echo "--Reçu le signe SIGUSR1...\n";
                    break;
                default:
                    echo "----recu :" . $signo . PHP_EOL;
                    break;
            }
        };


        $sqls = array();
        $sqls[] = $this->sql_for_pcntl("select * from job_queue where id =" . $first_thread . "");
        $sqls[] = $this->sql_for_pcntl("select * from job_queue where id != " . $first_thread . " and id !=" . $last_thread . " order by length desc");
        $sqls[] = $this->sql_for_pcntl("select * from job_queue where id =" . $last_thread . "");

        $fork = 0;

        foreach ($this->db as $connect) {
            $connect->sql_close();
        }


        pcntl_signal(SIGCHLD, "sig_handler");


        foreach ($sqls as $sql) {

            foreach ($sql as $ob) {


                //exec

                $childId = $ob['id'];

                $pid = pcntl_fork();
                if ($pid == -1) {
                    die("Impossible de creer le processus");
                } elseif ($pid) {
                    if ($parallel >= $nb_thread_max) {

                        echo "wait un fils dying" . PHP_EOL;
                        pcntl_wait($status);
                        echo "un fils est dead" . PHP_EOL;
                    } else {
                        $parallel++;
                        echo "Number of thread : $parallel" . PHP_EOL;
                        usleep(100);
                    }
                } else {
                    echo "Creation d'un nouveau fils :  #$childId " . PHP_EOL;
                    echo "Nous avons maintenant $parallel processus fils en parallele" . PHP_EOL;

                    $this->load($file_name, $ob);

                    exit;
                }

                $fork++;
                echo "Number of fork : " . $fork . PHP_EOL;
            }

            pcntl_wait($status);
            //pcntl_wait($status);
            //sleep(1);
        }
    }

    function load($file_name, $data)
    {
        $config = new Config;
        $config->load(CONFIG);


        $dbconfig = $config->get("db");
        $dbs = FactorySql::init($dbconfig);
        $db = $dbs['default'];

        $dd = array();
        $dd['job_queue']['id'] = $data['id'];
        $dd['job_queue']['date_start'] = date("c");
        $db->sql_save($dd);


        echo "Fils ID : " . $data['id'] . PHP_EOL;

        if (file_exists($file_name)) {

            $line = 0;
            $octet = 0;
            $pointeur = array();

            if ($fh = fopen($file_name, "r")) {
                while (!feof($fh)) {
                    $line++;
                    //echo fgets($fh);
                    $octet += strlen($str = fgets($fh));
                }
                fclose($fh);
            }
        }

        echo "Fin du files " . $data['id'] . PHP_EOL;




        $dd = array();
        $dd['job_queue']['id'] = $data['id'];
        $dd['job_queue']['date_end'] = date("c");
        $db->sql_save($dd);

        foreach ($dbs as $connect) {
            $connect->sql_close();
        }
    }

    function sql_for_pcntl($sql)
    {
        $res = $this->db['default']->sql_query($sql);
        $ob = $this->db['default']->sql_to_array($res);
        return $ob;
    }

    function isolated()
    {
        $this->view = false;



        $deb = microtime(true);
        $cb = function() {
            return array_slice(range(1, 100000), rand(1, 100), rand(1, 10));
        };

        $icb = new IsolatedCallback($cb);
        $random_slice = $icb();
        echo "time :" . round(microtime(true) - $deb, 4);
    }

    function win()
    {
        $this->view = false;
        new Window("Title", " REquest the good value ?\n[[INPUT]]");
    }

    function win2()
    {
        $this->view = false;
        $win = new Ansi();

        $win->clear();

        $sprite = new Sprite("AAAAAA\nBBBBBB\nCCCCCC");

        //$win->printSprite($sprite, 20,20);

        for ($i = 0; $i < 30; $i++) {
            //$win->clear();
            
            
            $win->Circle(new Point(40, 40), $i);
            
            //$win->triangle(new Point(40 + $i, 20), new Point(25 + $i, 60), new Point(10 + $i, 10));
            $win->moveCursorTo(1,1);
            usleep(200000);
        }


        //$win->segment ( new Point(20,60),new Point(10,60) );

        $win->moveCursorTo(1, 1);
    }

}
