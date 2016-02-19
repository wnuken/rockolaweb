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

		if(!$videoId){
			$videoId = 'rXtck9odkiA';
		}

		// var_dump($_COOKIE);

		$credits = 0;
		if (isset($_COOKIE['credits'])){
			$credits = $_COOKIE['credits'];
		}

		include_once './views/home.php';


	}

	static public function Player($videoId){

  	// var_dump($videoId);
		include_once './views/player.php';
	}

	static public function Setlist(){
		$Songlist;
		$RockId = $_POST['id'];

		$Music = MusicQuery::create()->filterByRockId($RockId)->findOne();

		if(!empty($Music)){
			$YoutubeId = $Music->getYoutubeId();
			$Songlist = new Songlist();
			$Songlist->setSong($YoutubeId);
			$Songlist->setTime(strtotime('now'));
			$Songlist->save();
			$Songlist = $Songlist->getSong();
		}

		$ArrayResult = array(
			'message' => 'id_youtube',
			'status' => true,
			'RockId' => $RockId,
			'Songlist' => $Songlist
			);

		$JsonResult = json_encode($ArrayResult);

		print $JsonResult;
	}

	static public function Getsong(){
		$Playing;
		$Song = SonglistQuery::create()->findOne();
		

		if(!empty($Song)){
			$Playing = $Song->getSong();
			$Time = $Song->getTime();
			$Song->delete();
		}

		$ArrayResult = array(
			'message' => 'song play',
			'status' => true,
			'Playing' => $Playing
			);

		$JsonResult = json_encode($ArrayResult);

		print $JsonResult;
	}

	static public function SetCredits(){
		$credits = $_POST['credits'];
		setcookie("credits", $credits, strtotime( '+1 days' ));

		$ArrayResult = array(
			'message' => 'set credits',
			'status' => true,
			'credits' => $credits
			);

		$JsonResult = json_encode($ArrayResult);

		print $JsonResult;


	}

}