<?php

class viewsController
{
  static public function Home($videoId = ''){


  	$Music = MusicQuery::create()
  		->filterByGenderId(5)
  		->useAuthorQuery() 
    		->orderByName()
  		->endUse()
  		->paginate($page = 1, $rowsPerPage = 28);



	// var_dump($Music);

	if(!$videoId){
		$videoId = 'Jn88Aun2SxA';
	}


    include_once './views/home.php';


  }

  static public function Player($videoId){

  	// var_dump($videoId);
    include_once './views/player.php';
  }
}