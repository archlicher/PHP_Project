<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['admin']['controllers']['index']['to'] = 'index';
$cnf['admin']['controllers']['index']['methods']['index'] = 'index';
$cnf['admin']['controllers']['user']['to'] = 'index';
$cnf['admin']['controllers']['user']['methods']['index'] = 'index';

$cnf['user']['namespace'] = 'Controllers\User';
$cnf['user']['controllers']['index']['to'] = 'index';
$cnf['user']['controllers']['index']['methods']['index'] = 'index';

$cnf['user']['controllers']['auth']['to'] = 'auth';
$cnf['user']['controllers']['auth']['methods']['login'] = 'login';
$cnf['user']['controllers']['auth']['methods']['register'] = 'register';
$cnf['user']['controllers']['auth']['methods']['logout'] = 'logout';

$cnf['user']['controllers']['profile']['to'] = 'profile';
$cnf['user']['controllers']['profile']['methods']['index'] = 'index';
$cnf['user']['controllers']['profile']['methods']['edit'] = 'edit';
$cnf['user']['controllers']['profile']['methods']['cash'] = 'cash';

$cnf['user']['controllers']['product']['to'] = 'product';
$cnf['user']['controllers']['product']['methods']['buy'] = 'buy';
$cnf['user']['controllers']['product']['methods']['sell'] = 'sell';
$cnf['user']['controllers']['product']['methods']['cart'] = 'cart';
$cnf['user']['controllers']['product']['methods']['order'] = 'order';

$cnf['controllers']['products']['to'] = 'category';
$cnf['controllers']['products']['methods'] = 'category';


$cnf['*']['namespace'] = 'Controllers';
return $cnf;