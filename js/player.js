var player;
var $videoYoutube = $('#video-youtube');

function onYouTubePlayerAPIReady() {
    var videoId = $videoYoutube.attr('video-id');
    console.log(videoId);
    if(typeof videoId === 'undefined')
      videoId = '5QmFK1QPCUo';

    player = new YT.Player('video-youtube', {
      height: '99%',
      width: '99%',
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