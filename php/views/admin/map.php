<?php

/*****************************
map.php
map page template
*****************************/

# set session for updating
$_SESSION['admin_last_update'] = date("Y-m-d H:i:s",0);

# require load tracks in group
require 'php/worker/user_load_tracks.php';
?>

<!-- Page Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="content">
	<div id="map-canvas" style="height: 100%;"></div>

	<div id="map-legend" class="indigo lighten-2 z-depth-1" style="width: 100%;">
		<div class="row">
			<?php
				foreach($TrackObjects as $TrackObject){
			?>
			<div class="col s6 m3 l2 map-legend-col">
				<h5><?php print $TrackObject->getName();?></h5>
				<img src="<?php print ROOT . 'images/markers/' . $TrackObject->getIcon();?>" />
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>

<!-- Show Legend
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<a id="show-legend" class="btn-floating btn-medium waves-effect waves-light pink accent-2"><i style="display: none;" class="material-icons">&#xE88E;</i><i class="material-icons">&#xE88F;</i></a>

<!-- Page JS
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script>

var group_id = <?php echo $UserMasterObject->getUserGroup();?>;
var zoom_level = 14;

var image_root = '<?php print ROOT;?>images/markers/';

</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3"></script>
<script src="js/admin/map.js"></script>


