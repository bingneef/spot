<?php
/*****************************
control panel add user template
*****************************/
?>

<!-- NEVER EVER AUTOFILL CHROME FIX-->
<input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" />
<input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />


<div class="input-field col s12 no-padding clearfix">
    <input id="new_user_username" type="text" class="validate">
    <label for="new_user_username">Username</label>
</div>
<div class="input-field col s12 no-padding clearfix">
    <input id="new_user_password" type="password" class="validate">
    <label for="new_user_password">Password</label>
</div>
<div class="input-field col s12 no-padding clearfix">
    <input id="new_user_nickname" type="text" class="validate">
    <label for="new_user_nickname">Nickname</label>
</div>
<div class="input-field col s12 no-padding clearfix">
    <div class="switch">
        <label>
            Spotter
            <input id="new_user_level" type="checkbox">
            <span class="lever"></span>
            Viewer
        </label>
    </div>
</div>
<div class="input-field col s12 no-padding clearfix">
    <button class="btn waves-effect waves-light" id="add-user" type="submit" name="action">Add user
    </button>
</div>