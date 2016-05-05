<?php
/*****************************


*****************************/

# require login validate
require 'php/worker/login_validate_form.php';

?>
<!-- Primary Layout
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="content" class="container">
    <div class="row">
        <form class="col s12 m6 offset-m3" action="#" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="username" id="username" type="text" class="login" name="username">
                </div>
                <div class="input-field col s12">
                    <input placeholder="password" id="password" type="password" class="login" name="password">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                	<input type="hidden" value="login" name="login_submit">
                    <button class="btn waves-effect waves-light full-width" type="submit" name="action">
                    	Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Center Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script>
$(document).ready(function(){
    verticalCenterContent($('#content'));
});
</script>