<div class="over-video" id="overVideo">
</div>
<div id="video-youtube" video-id="<?php print $videoId; ?>"></div>
<div class="controls">
  <!--span id="pause">PAUSAR</span>
  <span id="play">PLAY</span-->
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Gospel 
          <span class="label label-warning" style="left: 3px;position: absolute;">Creditos: <i id="credits"><?php print $credits; ?></i></span>
            <span class="label label-warning" style="right: 3px;position: absolute; width: 75px;height: 20px;"><i id="numSong"></i></span>
          </h4>
        </div>
        <div class="modal-body">

          <?php 
          $count = 0;
          foreach ($Music as $key => $sound): 
            $author = $sound->getAuthor();
          if($count == 0 || $count == 14)
            print '<div class="row">';

          if($count == 0 || $count == 7 || $count == 14 || $count == 21 || $count == 28)
            print '<div class="col-xs-6"><ul class="list-group">';
          ?>


          <li class="list-group-item" data-tube-id="<?php print $sound->getYoutubeId(); ?>">

            <i class="label label-info" style="left: 3px;position: absolute;"><?php print $author->getName(); ?></i><span class="badge"><?php print $sound->getRockId(); ?></span>
            <?php print $sound->getTitle(); ?>

          </li>


          <?php



          if($count == 6 || $count == 13 || $count == 20 || $count == 27)
            print '</ul></div>';


          if($count == 13){
            print '</div>';
          }

          if($count == 27){
           print '</div>';
           break;
         }
         $count++;
         endforeach; 
         ?>
       </div>

     </div>
   </div>
 </div>

