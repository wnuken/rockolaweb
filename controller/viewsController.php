<?php

class viewsController
{
  static public function Home(){

  	//$firstAuthor = AuthorQuery::create()->findPK(1);
	//var_dump($firstAuthor);


    include_once './views/home.php';


  }

  static public function Player($videoId){

  	// var_dump($videoId);
    include_once './views/player.php';
  }
}