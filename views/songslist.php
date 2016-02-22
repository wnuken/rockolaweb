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