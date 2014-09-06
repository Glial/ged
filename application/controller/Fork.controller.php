<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Glial\Synapse\Controller;

class Fork extends Controller
{

    function index()
    {
        $this->view = false;


        $db = $this->di['db']->sql('default');

        declare(ticks = 1);
        $max = 5;
        $parallel = 0;
        $childId = 0;

        function sig_handler($signo)
        {
            global $parallel, $childId;
            switch ($signo) {
                case SIGCHLD:
                    $parallel--;
                    echo "SIGCHLD recu pour le fils #$childId" . PHP_EOL;
                    echo "Decrementation a $parallel" . PHP_EOL;
                    break;
            }
        }

        pcntl_signal(SIGCHLD, "sig_handler");

        for ($childId = 0; $childId < 10; $childId++) {
            usleep(1000);

            $pid = pcntl_fork();
            if ($pid == -1) {
                die("Impossible de creer le processus");
            } elseif ($pid) {
                if ($parallel >= $max) {
                    pcntl_wait($status);
                } else {
                    $parallel++;
                    echo "Incrementation a $parallel" . PHP_EOL;
                    usleep(20000);
                }
            } else {
                echo "Creation d'un nouveau fils :  #$childId " . PHP_EOL;
                echo "Nous avons maintenant $parallel processus fils en parallele" . PHP_EOL;

                foreach ($db->sql_fetch_yield("SHOW DATABASES") as $database) {
                    echo $database['Database'] . PHP_EOL;
                }


                sleep(rand(5, 20));

                echo "Fin du fils :  #$childId " . PHP_EOL;
                exit;
            }
        }
    }

}
