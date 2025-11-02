<?php

require_once __DIR__ . '/router.php';

get('/', 'views/index.php');
post('/', 'views/index.php');

get('/create', 'include/create.php');
post('/create', 'include/create.php');

any('/404', 'views/404.php');