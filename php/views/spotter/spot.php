<?php

/*****************************
spot.php
spot page template
*****************************/


# require load tracks
require 'php/worker/user_load_tracks.php';
?>
<!-- Page Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="content">
    <div class="row" style="margin-top: 24px;">
        <div class="input-field col s12">
            <select id="spot_track_id" class="browser-default" >
                <?php
                $i = 1;
                foreach($TrackObjects as $TrackObject){
                ?>
                <option value="<?php print $TrackObject->getId();?>" <?php if($i == 1) print 'selected';?> ><?php print $TrackObject->getName();?></option>
                <?php
                $i++;
                    }
                ?>
            </select>
            <label for="spot_track_id">Select Track</label>
        </div>
        <div class="input-field col s12">
            <?php
            if(isset($_GET['agent']))
                print '<textarea id="spot_description"></textarea>';
            else
                print '<textarea id="spot_description" class="materialize-textarea"></textarea>';
            ?>
            <label for="spot_description">Description</label>
        </div>
        <div class="col s12">
            <button id="spot_submit" class="btn waves-effect waves-light" type="submit" name="action">ADD SPOT
            </button>
        </div>
    </div>
</div>
<div id="gps"></div>
<!-- Page JS
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script src="js/spotter/spot.js"></script>