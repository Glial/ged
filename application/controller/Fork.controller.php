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

    public function test2()
    {

        $this->view = false;

        $db = $this->di['db']->sql('default');

        echo "[pere] Debut du pere" . PHP_EOL;
        for ($i = 0; $i < 10; $i++) {
            $pid = pcntl_fork();
            if ($pid == -1) {
                die('Impossible de creer un processus');
            } elseif ($pid == 0) {
                echo "[fils] Fils $i Travaille" . PHP_EOL;
                sleep(5);
                foreach ($db->sql_fetch_yield("SHOW DATABASES") as $database) {
                    echo $database['Database'] . PHP_EOL;
                }
                echo "[fils] Fils $i Finit son execution" . PHP_EOL;
                exit;
            }
        }
        echo "[pere] Fin du pere" . PHP_EOL;
        exit;
    }

    public function test_simple()
    {

        $this->view = false;

        $db = $this->di['db']->sql('default');


        echo "[pere] Je suis dieu, mon pid est : " . posix_getpid() . PHP_EOL;



        $pid = pcntl_fork();
        if ($pid == -1) {
            die('Creation de processus impossible');
        } elseif ($pid) {
            echo "[pere] Je suis le pere, mon pid est : " . posix_getpid() . ", mon processus fils a un PID $pid" . PHP_EOL;
            echo "[pere] J'attends la mort de mon processus fils :D  " . PHP_EOL;

            foreach ($db->sql_fetch_yield("select * from mysql.user") as $database) {
                
            }

            pcntl_wait($status);
            echo "[pere] Mon fils est mort! Bye! (status : $status)" . PHP_EOL;

            foreach ($db->sql_fetch_yield("SHOW GLOBAL VARIABLES") as $database) {
                echo "PERE : " . $database['Database'] . PHP_EOL;
            }
        } else {
            for ($i = 0; $i < 10; $i++) {
                echo "[fils] Je suis le fils, c'est l'iteration $i, mon pid est : " . posix_getpid() . " je v dormir pour une seconde! ..." . PHP_EOL;
                sleep(1);


                if ($i == 5) {
                    foreach ($db->sql_fetch_yield("SHOW DATABASES") as $database) {
                        echo $database['Database'] . PHP_EOL;
                    }
                }
            }


            echo "[fils] Woups! je meurs!" . PHP_EOL;
            exit;
        }

        foreach ($db->sql_fetch_yield("SHOW TABLES") as $database) {
            echo "SHOW TABLES". PHP_EOL;
        }
    }

}
