<?php

$db = new MySQLi('localhost','root','zeb33tln');

if (pcntl_fork()) {
    echo "pid du pere ".getmypid().PHP_EOL;
    $status = 0;



   $result = $db->query('select version()');
   if ($db->error) echo "error 1".$db->error.PHP_EOL;
    
   //pcntl_wait($status);

   $result = $db->query('select version()');
       if ($db->error) echo "error 2".$db->error.PHP_EOL;


} else {
    echo "pid son ".getmypid().PHP_EOL;
    
    
   $result = $db->query('select version()');
if ($db->error) echo "error 3".$db->error.PHP_EOL;
    
    exit;
}


   $result = $db->query('select version()');
if ($db->error) echo "error 4".$db->error.PHP_EOL;

echo "END".PHP_EOL;
