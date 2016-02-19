<?php 
include_once('./classes.php');

 $urlpost = explode('/', $_SERVER['REQUEST_URI']);
    $classjson = file_get_contents(dirname(__FILE__) . '/config/postrequest.json');
    $classarray = json_decode($classjson, true);


    if(in_array($urlpost[1] , $classarray['postroutes'])){
        getRoute()->run();
    }else{
        require_once('./views/general.php');
    }


?>
