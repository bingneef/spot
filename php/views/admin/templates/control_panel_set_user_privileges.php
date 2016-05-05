<?php
/*****************************
control panel set user privileges template
*****************************/
?>

<?php
foreach($UserObjects as $UserObject){

	#if super admin, continue
	if($UserObject->getLevel() == 2){
		continue;
	}

?>

<div class="col m4 no-padding">
    <?php print $UserObject->getUsername(); ?>
</div>
<div class="col m8">
    <div class="switch">
        <label>
            Spotter
            <input class="priviliges" type="checkbox" rel="<?php print $UserObject->getId(); ?>" <?php if($UserObject->getLevel() == 1) print 'checked';?>>
            <span class="lever"></span>
            Viewer
        </label>
    </div>
</div>

<?php
}
?>