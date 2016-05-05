<?php

/*****************************
control_panel.php
control panel page template
*****************************/


# require load users in group
require 'php/worker/admin/control_panel_load_users.php';

# require load tracks in group
require 'php/worker/user_load_tracks.php';
?>

<!-- Page Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="content" class="container padding-container-page">
    <form action="#">
        <div class="row">
            <div class="col s12">
                <h2>Admin settings</h2>
            </div>
            <div class="col s12 m6">
                <div class="col s12 form-leave-space">
                    <h4>Add track</h4>
                    <?php
                        require 'php/views/admin/templates/control_panel_add_track.php';
                    ?>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="col s12 form-leave-space">
                    <h4>Add user</h4>
                    <?php
                        require 'php/views/admin/templates/control_panel_add_user.php';
                    ?>
                </div>
                <div id="set_user_privileges" class="col s12 form-leave-space">
                    <h4>Set user privileges</h4>
                    <?php
                        require 'php/views/admin/templates/control_panel_set_user_privileges.php';
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>


<!-- Page JS
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script src="js/admin/control_panel.js"></script>