<?php 
require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/generated-conf/config.php';
include_once './controller/viewsController.php';

include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::setPath('config', dirname(__FILE__));
Epi::init('route');
getRoute()->load('./config/routes.ini');

// 