<?php

class viewsController
{
  static public function Home(){

  	$firstAuthor = AuthorQuery::create()->filterById(1)->findOne();
	var_dump($firstAuthor);


    include_once './views/home.php';


  }

  static public function Player($videoId){

  	// var_dump($videoId);
    include_once './views/player.php';
  }
}