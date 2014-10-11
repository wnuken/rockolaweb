$.fn.setCredits = function(params){
	var that = this;
	var count_credits = parseInt($("span#credit_number", that).text());
	var credit_extra = parseInt($("span#credit_extra", that).text());

	count_credits = (count_credits + params.cant_credit);
	credit_extra = (credit_extra + params.sum_credit);

	if((credit_extra%params.bucle_count) == 0){
		count_credits = (count_credits + params.cant_max);
	}

	$("span#credit_number", that).text(count_credits);
	$("span#credit_extra", that).text(credit_extra);
	
	console.log("hola");
}

$.fn.charCodeNum = function(params){

	 var keyValue = String.fromCharCode(params);
	 if (params == 96) keyValue = 0;
	 if (params == 97) keyValue = 1;
     if (params == 98) keyValue = 2;
     if (params == 99) keyValue = 3;
     if (params == 100) keyValue = 4;
     if (params == 101) keyValue = 5;
     if (params == 102) keyValue = 6;
     if (params == 103) keyValue = 7;
     if (params == 104) keyValue = 8;
     if (params == 105) keyValue = 9;
	 
	 var numValue = $('span#tecla').html();
	 if(isNaN(keyValue) == false)
	 	$('span#tecla').html(numValue + keyValue);

}

$.fn.fullScreen = function() {
	var element = this[0];
	console.log(element);
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}


/*
$.fn.playControl = function(params){
	//http://gdata.youtube.com/feeds/api/standardfeeds/most_popular?v=2&alt=json
	var audio = document.getElementById('audio');
    $('.audiocontrols a.play').on('click',function(e){
        e.preventDefault();
        audio.play();
    });
    $('.audiocontrols a.pause').on('click',function(e){
        e.preventDefault();
        audio.pause();
    });
    $('.audiocontrols a.stop').on('click',function(e){
        e.preventDefault();
        audio.pause();
        audio.currentTime=0;
    });


}
*/