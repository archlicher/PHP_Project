<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['admin']['controllers']['index']['to'] = 'index';
$cnf['admin']['controllers']['index']['methods']['index'] = 'index';
$cnf['admin']['controllers']['user']['to'] = 'user';
$cnf['admin']['controllers']['user']['methods']['edit'] = 'edit';
$cnf['admin']['controllers']['user']['methods']['remove'] = 'remove';
$cnf['admin']['controllers']['category']['to'] = 'category';
$cnf['admin']['controllers']['category']['methods']['remove'] = 'remove';
$cnf['admin']['controllers']['promotion']['to'] = 'promotion';
$cnf['admin']['controllers']['promotion']['methods']['remove'] = 'remove';
$cnf['admin']['controllers']['product']['to'] = 'product';
$cnf['admin']['controllers']['product']['methods']['remove'] = 'remove';

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

$cnf['editor']['namespace'] = 'Controllers\Editor';
$cnf['editor']['controllers']['index']['to'] = 'index';
$cnf['editor']['controllers']['index']['methods']['index'] = 'index';
$cnf['editor']['controllers']['product']['to'] = 'product';
$cnf['editor']['controllers']['product']['methods']['edit'] = 'edit';
$cnf['editor']['controllers']['product']['methods']['promo'] = 'promo';
$cnf['editor']['controllers']['category']['to'] = 'category';
$cnf['editor']['controllers']['category']['methods']['edit'] = 'edit';
$cnf['editor']['controllers']['promotion']['to'] = 'promotion';
$cnf['editor']['controllers']['promotion']['methods']['edit'] = 'edit';
$cnf['editor']['controllers']['promotion']['methods']['add'] = 'add';

$cnf['controllers']['products']['to'] = 'category';
$cnf['controllers']['products']['methods'] = 'category';


$cnf['*']['namespace'] = 'Controllers';
return $cnf;