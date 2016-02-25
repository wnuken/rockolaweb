

var $songsModal = $('div#songsModal');
var $genders = $('div#genders');
var player;
var $videoYoutube = $('div#video-youtube');
var countNumber = 0;
var codeSearh = '';
var videData = {};
var credits = parseInt($('i#credits', $songsModal).html());

function onYouTubePlayerAPIReady() {
  var videoId = $videoYoutube.attr('video-id');
  if(typeof videoId === 'undefined' || videoId == ''){
    videoId = 'rXtck9odkiA';
  }else{
    player = new YT.Player('video-youtube', {
    height: '99%',
    width: '100%',
    videoId: videoId,
    events: {
      'onReady': onAutoPlay,
      'onStateChange': onFinish
    }
  });
  }

  
};

function onAutoPlay(event) {
  // player.playVideo();
};

function onFinish(event) {        
  if(event.data === 0) {
    var video_id_play = getSong();
    player.loadVideoById(video_id_play);
  }
};

function getSong(){
    var result = '';

    var params = {
      "url":"getsong"
    };

    $.ajax({
      type: "POST",
      url: params.url,
      dataType: 'json',
      data: params,
      async: false,
      success: function(response) {
        if(response.Playing !== null){
          result = response.Playing;
        }else{
          result = 'rXtck9odkiA';
        }
      },
      error: function() {
        var message = "Rayos parece que no puedo traer datos";
        console.log(message);
        result = 'rXtck9odkiA';
      }
    });

    console.log(result);
    return result;

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
      $('i#credits', $songsModal).html(credits);
    },
    error: function() {
      var response = "Rayos parece que no puedo traer datos";
      console.log(message);
    }
  });
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

function songsList(page, gender){

  var params = {
    "url":"songslist",
    "page": page,
    "gender": gender
  };

  $.ajax({
    type: "POST",
    url: params.url,
    dataType: 'json',
    data: params,
    async: true,
    success: function(response) {
      // console.log(response);
      $songsModal.attr('data-cont', response.songscont);
      $('.modal-body', $songsModal).html(response.html);
      
      
    },
    error: function() {
      var message = "Rayos parece que no puedo traer datos";
      console.log(message);
    }
  });

  
};

launchFullScreen(document.documentElement);

$(document).keypress(function(e){

 if(e.charCode > 47 && e.charCode < 58){
    codeSearh = codeSearh + String.fromCharCode(e.charCode);
    //console.log(countNumber);
    // console.log(credits);
    if(codeSearh.length == 5){
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

           if(response.Songlist !== null){
              credits = credits - 1;
              setCredits(credits);
            }
            videData = player.getVideoData();
            if(videData.video_id == 'rXtck9odkiA'){
              var video_id_play = getSong();
              player.loadVideoById(video_id_play);
              }
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

  if(e.charCode > 41 &&  e.charCode < 48){
    codeSearh = '';
  }

  $('i#numSong', $songsModal).html(codeSearh);

  var genderid = parseInt($songsModal.attr('data-gender'));
  var pageid = parseInt($songsModal.attr('data-page'));
  var pagecount = parseInt($songsModal.attr('data-cont'));

  if(e.charCode == 47){
      //$('.carousel').carousel('prev');
      if(pageid > 1){
        pageid = pageid - 1;
        songsList(pageid, genderid);
      }

    }

    if(e.charCode == 42){
      //$('.carousel').carousel('next');
      if(pagecount == 28){
        pageid = pageid + 1;
        songsList(pageid, genderid);
      }
    }

    $songsModal.attr('data-page', pageid);

    if(e.charCode == 13){
    $('#songsModal').modal('toggle');

    }

    if(e.charCode == 43 || e.charCode == 45){
      var $gendersUl = $('ul', $genders);
      var $gendersli = $('li', $genders);
      var len = $gendersli.length - 1;
      var $curentActive = {};
      $.each($gendersli, function(index, element){
        var $that = $(this);
        var active = parseInt($that.attr('data-active'));
        if(active == 1){
          $curentActive = $(this);
        }
      });

      $genders.css('display', 'block');
      $curentActive.removeClass('active');
      $curentActive.attr('data-active', '0');
      var dataIndex = parseInt($curentActive.attr('data-index'));
      var $selectElement = {};
      if(dataIndex == len && e.charCode == 43){
        $selectElement = $('li:first', $gendersUl).attr('data-active', '1');
      }else if(dataIndex == 0 && e.charCode == 45){
        $selectElement = $('li:last', $gendersUl).attr('data-active', '1');
      }else if (e.charCode == 43){
        $selectElement = $curentActive.next().attr('data-active', '1');
      }else if (e.charCode == 45){
        $selectElement = $curentActive.prev().attr('data-active', '1');
      }

      $selectElement.addClass('active');

      

      console.log($selectElement.attr('data-genderid'));
      pageid = 1;
      genderid = $selectElement.attr('data-genderid');
      songsList(pageid, genderid);
      var nameGender = $selectElement.html();
      //$('h4#myModalLabel strong', $songsModal).html(nameGender);
      $songsModal.attr('data-gender', genderid);

      $('h4#myModalLabel strong', $songsModal).fadeOut( "slow", function() {
          var $that = $(this);
          $that.html(nameGender);
          $that.fadeIn();
          $genders.css('display', 'none');
      });


      


    }


  });

// $(document).on('' function(e){});

$(document).on('click', function(){
  $('#songsModal').modal({
    show: true,
    backdrop: false
  })
  credits = credits + 1;
  setCredits(credits);

});


/*var playButton = document.getElementById("play");
playButton.addEventListener("click", function() {
  player.playVideo();
});
  
var pauseButton = document.getElementById("pause");
pauseButton.addEventListener("click", function() {
  player.pauseVideo();
});*/