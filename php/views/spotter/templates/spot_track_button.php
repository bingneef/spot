<?php
/*****************************
spot_track_button.php
Requires TrackObject
*****************************/

?>

<div class="col s6 spot">
    <a id="<?php print $TrackObject->getId();?>" style="height: 120px;" class="waves-effect waves-light btn-large spot full-width <?php print $TrackObject->getPrimaryColor();?>"><span class="<?php print $TrackObject->getSecondaryColor();?>-text"><?php print $TrackObject->getName();?></span></a>
</div>