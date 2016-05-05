<?php
/*****************************
control panel add track template
*****************************/
?>

<!-- NEVER EVER AUTOFILL CHROME FIX-->
<input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" />
<input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />
<div class="input-field col s12 no-padding clearfix">
    <input id="track_name" type="text" class="validate">
    <label for="track_name">Track Name</label>
</div>
<div class="col s12 no-padding clearfix">
    <h6>Select marker</h6>
    <input type="hidden" id="track_color_holder" />

    <?php

    //get dir for makers
    $dir    = 'images/markers/';
    $markers = scandir($dir);

    foreach($markers as $marker){
        if(substr($marker, -4) !== '.svg')
            continue;

        //get filename minus .svg
        $rel = substr($marker, 0, -4);

        //default is only fallback
        if($rel == 'default' || $rel == 'test')
            continue;

    ?>
        <img src="<?php print ROOT . $dir . $marker;?>" rel="<?php print $rel;?>" class="control-panel-color" height="48px;"/>
    <?php
    }
    ?>
</div>
<div class="input-field col s12 no-padding clearfix">
    <button class="btn waves-effect waves-light" type="submit" id="add-track" name="action">Add track
    </button>
</div>