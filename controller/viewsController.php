<?php

class viewsController
{
  static public function Home(){
    include_once './views/home.php';


  }

  static public function Player($videoId){

  	// var_dump($videoId);
    include_once './views/player.php';
  }
}