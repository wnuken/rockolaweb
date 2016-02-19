
var $myModal = $('div#myModal');
var player;
var $videoYoutube = $('#video-youtube');
var countNumber = 0;
var codeSearh = '';
var credits = parseInt($('i#credits', $myModal).html());

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
    player.playVideo();
};

function onFinish(event) {        
  if(event.data === 0) {

    var params = {
        "url":"getsong"
      };

    $.ajax({
          type: "POST",
          url: params.url,
          dataType: 'json',
          data: params,
          async: true,
          success: function(response) {
            console.log(response);
            if(response.Playing !== null){
              location.href='./' + response.Playing;
            }else{
              location.href='./';
            }
          },
          error: function() {
            var message = "Rayos parece que no puedo traer datos";
            console.log(message);
          }
        });


    
  }
};

function setCredits(credits){
  var params = {
        "url":"setcredits",
        "credits": credits
      };

  $.ajax({
          type: "POST",
          url: params.url,
          dataType: 'json',
          data: params,
          async: true,
          success: function(response) {
            console.log(response);
          },
          error: function() {
            var response = "Rayos parece que no puedo traer datos";
            console.log(message);
          }
        });
  // return response;
};

function launchFullScreen(element) {
  if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
}

launchFullScreen(document.documentElement);

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
    //console.log(countNumber);
    // console.log(credits);
    if(countNumber == 5){
      countNumber = 0;
      var params = {
        "url":"setlist",
        "id": codeSearh
      };

      if(credits > 0){
        $.ajax({
          type: "POST",
          url: params.url,
          dataType: 'json',
          data: params,
          async: true,
          success: function(response) {
            console.log(response);
            if(response.Songlist !== null){
              credits = credits - 1;
              setCredits(credits);
              $('i#credits', $myModal).html(credits);
            }
            //$('div#loe-preview', $that).html(response);
          },
          error: function() {
            var message = "Rayos parece que no puedo traer datos";
            console.log(message);
          }
        });
      }


      codeSearh = '';
    }
  }

  if(e.charCode == 42 || e.charCode == 43 || e.charCode == 45 || e.charCode == 46 || e.charCode == 47){
    codeSearh = '';
    countNumber = 0;
  }

  $('i#numSong', $myModal).html(codeSearh);


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

// $(document).on('' function(e){});

$(document).on('click', function(){
  $('#myModal').modal({
    show: true,
    backdrop: 'static'
  })
  credits = credits + 1;
  setCredits(credits);
  $('i#credits', $myModal).html(credits);

});


/*var playButton = document.getElementById("play");
playButton.addEventListener("click", function() {
  player.playVideo();
});
  
var pauseButton = document.getElementById("pause");
pauseButton.addEventListener("click", function() {
  player.pauseVideo();
});*/