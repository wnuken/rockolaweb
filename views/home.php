<div class="over-video" id="overVideo">
</div>
<div id="video-youtube" video-id="<?php print $videoId; ?>"></div>
<div class="controls">
  <!--span id="pause">PAUSAR</span>
  <span id="play">PLAY</span-->
  </div>
  <!-- Modal -->
  <div class="modal fade" id="songsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
  data-page="<?php print $initalPage; ?>" 
  data-gender="<?php print $genderId; ?>"
  data-cont="<?php print $songscont; ?>">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><strong><?php print $Gender->getName(); ?> </strong>
          <span class="label label-warning" style="left: 3px;position: absolute;">Creditos: <i id="credits"><?php print $credits; ?></i></span>
            <span class="label label-warning" style="right: 3px;position: absolute; width: 75px;height: 20px;"><i id="numSong"></i></span>
          </h4>
        </div>
        <div class="modal-body">
        <?php include_once('./views/songslist.php'); ?>
       </div>

     </div>
   </div>
 </div>

 <div class="genders" id="genders" style="
      z-index: 1050;
    position: absolute;
    top: 10%;
    left: 44%;
    display: none;
    min-width: 250px;
    ">
  <ul class="list-group">
   <?php 
   foreach ($Genders as $key => $gen) {
      $activeId = 0;
      $activeClass = '';
    if($key == 0){
      $activeId = 1;
      $activeClass = 'active';
    }
      


     print '<li class="list-group-item ' .$activeClass.'" data-index="' . $key . '" data-active="' . $activeId . '" data-genderid="'. $gen->getId() .'">' . $gen->getName() . '</li>';
   }

   ?>
   </ul>

 </div>

