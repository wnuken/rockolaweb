<?php 

include_once './controller/viewsController.php';

include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::setPath('config', dirname(__FILE__));
Epi::init('route');
getRoute()->load('./config/routes.ini');