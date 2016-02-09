var player;
var $videoYoutube = $('#video-youtube');

function onYouTubePlayerAPIReady() {
    var videoId = $videoYoutube.attr('video-id');
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
    player.playVideo();
    console.log(player);

  //  requestFullScreen.bind(videoYoutube);
};

function onFinish(event) {        
    if(event.data === 0) {            
        location.href='./';
    }
};

/*var playButton = document.getElementById("play");
playButton.addEventListener("click", function() {
  player.playVideo();
});
  
var pauseButton = document.getElementById("pause");
pauseButton.addEventListener("click", function() {
  player.pauseVideo();
});*/