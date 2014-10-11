
<html lang="es">
<head>
	<?php 
	include('./class/rockola.php');
	$params = "./multimedia/";
	$rock = new rockola();
	$path = $rock->dirList($params);
	$mod = 2;
	$countsound = 0;


	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Media Center</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="./css/cover.css">
	<link rel="stylesheet" href="./css/pos.css">
	<!--link rel="stylesheet" href="./media/build/mediaelementplayer.min.css" /-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="./js/bootstrap.min.js"></script>
	<!--script src="./media/build/mediaelement-and-player.min.js"></script-->

	<!--script src="./js/fullscreen.js"></script-->
	<script src="./js/proccess.js"></script>
	<style type="text/css">
	<?php 
	$in_credit = 1;

	$fileJson = file_get_contents('./list/list.json');
	$fileArray = json_decode($fileJson, true);

	?>

	</style>

</head>
<body>
	<div id="elements" class="site-wrapper">
		<div class="site-wrapper-inner">
			<h4 class="credit_number">Creditos: 
				<span id="credit_number" class="credit_number">0</span></h4>
				<span id="credit_extra" class="credit_extra">0</span>
				<h4><span id="tecla" class="tecla"></span></h4>
			<div class="masthead clearfix">
				<div class="inner">

				</div>
			</div>
			<div class="clear"></div>
			<div class="inner cover">
				<?php if($in_credit == 1):?>
				<div class='span6' id="module_1">
					<video   id="video"class="video" controls autoplay="autoplay" loop="loop">

						<source type="video/mp4" src="./multimedia/loop.mp4" />
						<!--source type="video/youtube" src="https://www.youtube.com/watch?v=LO4rTHTrGl4" /-->

						Tu navegador no implementa el elemento <code>video</code>.
					</video>
				</div>
			<?php endif; ?>

			<?php foreach ($path[0] as $key => $level1) :
				$mudule = 'mudule_' . ($mod++);
				if($level1['gender'] != '0'):
					if($mod%2 == 0)
						print '<div class="clear"></div>';
			?>

			<div class='span6' id="<?php print $mudule; ?>">
				<h3><?php print $level1['gender'] ?></h3>
				<ul class='list_music'>
					<?php foreach ($level1 as $key1 => $level2) :
						if($key1 != 'gender'):
						foreach ($level2 as $key2 => $level3) :
							if($key1 != $level3):
					?>
					<?php 
						$arrayPath = explode('/', $level3);
						++$countsound;
						if(strlen($countsound) == 1)
							$idsound = '000' . $countsound;
						else if(strlen($countsound) == 2)
							$idsound = '00' . $countsound;
						else if(strlen($countsound) == 3)
							$idsound = '0' . $countsound;
						else 
							$idsound = $countsound;

					print '<li data-path="'.$level3.'" id="'.$idsound.'">' . 
						$idsound .' ' . $key1 . ' - '. trim($arrayPath[4], '.mp4') .'</li>';

					endif;
					endforeach; 
					endif;
					 endforeach;
					 
					  ?>
				</ul>
			</div>
			<?php endif; ?>
		<?php endforeach; ?>


		<!--div id="repro">
			<a role="button" class="btn btn-primary" href="#">Button</a>
			<div>
				
			</div>
			<div class="mastfoot"></div>
		</div-->
	</div>


	
	<?php

		//print_r($path);

	?>


	

	<script type="text/javascript">
	var statusFull = false;
	var videoFull = false;
	$(function(){
		//var video = document.getElementById('video');
		var video = $('video');
		
		// http://www.chipwreck.de/blog/2010/03/01/html-5-video-dom-attributes-and-events/
		
		
		//if (BigScreen.enabled) {
				//$("video#video").play();

		//} else {
		//	alert("este navegador no soporta el método fullscreen");
		//}

	});

	$(document).keydown(function(tecla){
        //tecla.preventDefault();
        var credit = parseInt($("span#credit_number").text());
        
        $().charCodeNum(tecla.keyCode);
        //console.log(tecla.keyCode);
        var playSong = $('span#tecla').html();
        
        if(playSong.length == 4){
        //if (playSong == 01 || playSong == 02) {
        	if(credit > 0)
        		$("span#credit_number").text((credit - 1));
        		var newsong = $('li#' + playSong).attr('data-path');
        	var song = "./multimedia/genero1/artista 1/Dios_manda_lluvia.mp4";
        	if(playSong == 02){
        		song = "./multimedia/genero1/artista 1/Haz_tu_obra_en_mi.mp4";
        	}
        	$("video#video").removeAttr('loop');
        	$("video#video source").attr('src', newsong);
        	$('span#tecla').html('');
        	
        	if(credit == 1){
        		$(video).fullScreen();
        		videoFull = true;
        	}else{
        		videoFull = false;
        	}
        	
        	video.load()

        	video.addEventListener("ended", function(){
        		var song = "./multimedia/loop.mp4";
        		$("video#video").attr('loop', 'loop');
        		$("video#video source").attr('src', song);
        		$('span#tecla').html('');
        		video.load()
        	});

        	
   		 	//video.play();
   		 }
   		});



$('div#elements').on('click', function(e){
	e.preventDefault();

	var credits = parseInt($("span#credit_number").text());
		//video.mozRequestFullScreen();
		var params = {
			"bucle_count":5,
			"cant_max":2,
			"cant_credit":1,
			"sum_credit":1,
			"count_extra":2
		};
		$(this).setCredits(params);

		if(videoFull == true){
			statusFull = false;
			videoFull = false;
			if(document.exitFullscreen) {
				document.exitFullscreen();
			} else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
		}

		if(statusFull == false){
			statusFull = true;
			$(document.documentElement).fullScreen();
		}


		//video.play();
		//var video = $('video#video');
		//BigScreen.toggle(document);
	});


	/*$("video").mediaelementplayer({

		success: function(media, node, player) {


			
			$(document).keydown(function(tecla){
				console.log(tecla.keyCode);


				if(tecla.keyCode == "97"){
					player.pause();

					

				}else if(tecla.keyCode == "98"){
					player.play();
					



				}
			});

		}
	});*/

</script>
</body>
<html>