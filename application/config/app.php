<?php

$cnf['default_controller'] = 'Index';
$cnf['default_method'] = 'index';
$cnf['namespaces']['Controllers'] = 'C:/xampp/htdocs/php_project/application/controllers/';

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'default';
$cnf['session']['dbTable'] = 'session';
return $cnf;