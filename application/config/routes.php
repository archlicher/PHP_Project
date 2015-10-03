<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['admin']['controllers']['index']['to'] = 'index';
$cnf['admin']['controllers']['index']['methods']['index'] = 'index';
$cnf['admin']['controllers']['user']['to'] = 'index';
$cnf['admin']['controllers']['user']['methods']['index'] = 'index';
$cnf['controllers']['login']['to'] = 'index';
$cnf['controllers']['login']['methods']['index'] = 'login';
$cnf['controllers']['login']['methods']['register'] = 'register';

$cnf['*']['namespace'] = 'Controllers';
return $cnf;