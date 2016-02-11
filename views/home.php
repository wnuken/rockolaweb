<div class="cover-container">

   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Rockola WEB</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./">Home</a></li>
            <li><a href="./Jn88Aun2SxA">About</a></li>
            <li><a href="./PtFrhHp1Lqk">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

  <div class="inner cover">
            <!--h1 class="cover-heading"></h1>
            <p class="lead"></p>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-default">Learn more</a>
            </p>
            allowfullscreen -->
            <div class="row">

             <div class="col-xs-8">

               <div id="video-youtube" style="height: 371px;"></div>
               <div class="controls">
  <!--span id="pause">PAUSAR</span>
  <span id="play">PLAY</span-->
  </div>


</div>
<div class="col-xs-4"></div>

</div>
<div class="row" style="height: 50%">

</div>


</div>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
    </li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>

  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

  <?php 


  



  
  $filePath = './list/list.json';
  $listContent = file_get_contents($filePath, FILE_USE_INCLUDE_PATH);
  $arraylistContent = json_decode($listContent, true);
//  var_dump($arraylistContent);

  $variable = array('','','');
  $variable1 = array('Cancion 1','Cancion 2','Cancion 3','Cancion 4','Cancion 5','Cancion 6','Cancion 7','Cancion 8');

    foreach ($arraylistContent['salsa'] as $key => $value) {
      $classActive = '';
      if($key == 'artisaA')
        $classActive = 'active';

      print ' <div class="item ' . $classActive . '">';
      foreach ($variable as $key1 => $value1) {
        print '<div class="col-xs-4"><ul class="list-group">';

        foreach ($variable1 as $key2 => $value2) {
        print '<li class="list-group-item"><span class="badge">'.($arraylistContent['salsa'][$key][$key2]).'</span>'.$value2.'</li>';
        }
        print '</ul></div>';
      }
      print '</div>';
    }

  ?>


  



    Cumbia
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


</div>