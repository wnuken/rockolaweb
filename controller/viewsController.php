<?php

class viewsController
{
	static public function Home($videoId = ''){

		$initalPage = 1;
		$genderId = 1;

		$Gender = GendersQuery::create()
			->orderByName()
			->findOne();

		if(!empty($Gender)){
			$genderId = $Gender->getId();
		}

		$Genders = GendersQuery::create()
			->orderByName()
			->find();

		$Music = MusicQuery::create()
			->filterByGenderId($genderId)
			->useAuthorQuery() 
				->orderByName()
			->endUse()
			->orderByTitle()
			->paginate($page = 1, $rowsPerPage = 28);

		$songscont = $Music->count();

		if(!$videoId){
			$videoId = 'rXtck9odkiA';
			$Song = SonglistQuery::create()->findOne();

			if(!empty($Song)){
				$videoId = $Song->getSong();
				$Song->delete();
			}
		}

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
		$credits = 1;
		setcookie("credits", $credits, strtotime( '+1 days' ));

		$ArrayResult = array(
			'message' => 'set credits',
			'status' => true,
			'credits' => $credits
			);

		$JsonResult = json_encode($ArrayResult);

		print $JsonResult;


	}

	static public function SongsList(){


		$initalPage = $_POST['page'];
		$gender = $_POST['gender'];

		$Music = MusicQuery::create()
		->filterByGenderId($gender)
		->useAuthorQuery() 
			->orderByName()
		->endUse()
		->orderByTitle()
		->paginate($page = $initalPage, $rowsPerPage = 28);

		$songscont = $Music->count();

		ob_start(); # open buffer
		include( './views/songslist.php' );
		$htmlData = ob_get_contents();
		ob_end_clean(); # close buffer

		$ArrayResult = array(
			'message' => 'songslist',
			'status' => true,
			'html' => $htmlData,
			'songscont' => $songscont,
			);

		$JsonResult = json_encode($ArrayResult);

		print $JsonResult;

	}

}