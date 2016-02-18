var player;
var $videoYoutube = $('#video-youtube');
var countNumber = 0;
var codeSearh = '';

function onYouTubePlayerAPIReady() {
    var videoId = $videoYoutube.attr('video-id');
    console.log(videoId);
    if(typeof videoId === 'undefined')
      videoId = '5QmFK1QPCUo';

    player = new YT.Player('video-youtube', {
      height: '99%',
      width: '100%',
      videoId: videoId,
      events: {
        'onReady': onAutoPlay,
        'onStateChange': onFinish
      }
    });
};

function onAutoPlay(event) {
    // player.playVideo();
    


    
  //  requestFullScreen.bind(videoYoutube);
};

function onFinish(event) {        
    if(event.data === 0) {            
        location.href='./5QmFK1QPCUo';
    }
};

$(document).keypress(function(e){
 console.log(e.charCode);


  if(e.charCode > 47 && e.charCode < 58){
    countNumber++;
    if(e.charCode == 48) codeSearh = codeSearh + '0';
    if(e.charCode == 49) codeSearh = codeSearh + '1';
    if(e.charCode == 50) codeSearh = codeSearh + '2';
    if(e.charCode == 51) codeSearh = codeSearh + '3';
    if(e.charCode == 52) codeSearh = codeSearh + '4';
    if(e.charCode == 53) codeSearh = codeSearh + '5';
    if(e.charCode == 54) codeSearh = codeSearh + '6';
    if(e.charCode == 55) codeSearh = codeSearh + '7';
    if(e.charCode == 56) codeSearh = codeSearh + '8';
    if(e.charCode == 57) codeSearh = codeSearh + '9';
    console.log(countNumber);
    console.log(codeSearh);
    if(countNumber == 5){
      countNumber = 0;
      codeSearh = '';
    }
  }


  if(e.charCode == 47){
      //$('.carousel').carousel('prev');
  }

  if(e.charCode == 42){
      //$('.carousel').carousel('next');
  }

  if(e.charCode == 13){
    $('#myModal').modal('toggle');
  }


});

$('div#overVideo').on('click', function(){
  $('#myModal').modal({
  show: true,
  backdrop: 'static'
  })

});


/*var playButton = document.getElementById("play");
playButton.addEventListener("click", function() {
  player.playVideo();
});
  
var pauseButton = document.getElementById("pause");
pauseButton.addEventListener("click", function() {
  player.pauseVideo();
});*/