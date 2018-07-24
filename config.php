<?php 

require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
  define('BASE_URL', 'http://localhost/projetoy/Monitoramento/');
  $config['dbname'] = 'monitoramento_new';
  $config['dbhost'] = 'localhost';
  $config['dbuser'] = 'root';
  $config['dbpass'] = 'alagoas6e';
} else {
  define('BASE_URL', 'https://eriksonoliveira.com/weather_database/');
  $config['dbname'] = 'id1128313_monitoramento';
  $config['dbhost'] = 'localhost';
  $config['dbuser'] = 'id1128313_root';
  $config['dbpass'] = 'Tempo10';
}

global $db;
try {
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['dbhost'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch(PDOException $e) {
  echo "ERRO: ".$e->getmessage();
  exit;
}

?>
