var player;
var $videoYoutube = $('#video-youtube');

function onYouTubePlayerAPIReady() {
    var videoId = $videoYoutube.attr('video-id');
    console.log(videoId);
    if(typeof videoId === 'undefined')
      videoId = '5QmFK1QPCUo';

    player = new YT.Player('video-youtube', {
      height: '100%',
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
    console.log(player);

  //  requestFullScreen.bind(videoYoutube);
};

function onFinish(event) {        
    if(event.data === 0) {            
        location.href='./';
    }
};

$(document).keypress(function(e){
 // console.log(e.charCode);

  if(e.charCode == 47){
      $('.carousel').carousel('prev');
  }

  if(e.charCode == 42){
      $('.carousel').carousel('next');
  }

});


/*var playButton = document.getElementById("play");
playButton.addEventListener("click", function() {
  player.playVideo();
});
  
var pauseButton = document.getElementById("pause");
pauseButton.addEventListener("click", function() {
  player.pauseVideo();
});*/