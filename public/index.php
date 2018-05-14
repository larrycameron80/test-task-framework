<?php

use classes\App;

include_once __DIR__ . '/../classes/autoloader.php';

$config = include_once __DIR__ . '/../config/app.php';

App::run($config);
