<?php
/*****************************
login.php
login page template
*****************************/

?>

<!-- Page Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="content" class="container">
    <div class="row">
        <form class="col s12 m6 offset-m3" action="#" method="post">
            <div class="row">
                
                <!-- NEVER EVER AUTOFILL CHROME FIX-->
                <input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" />
                <input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />

                
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
                    <button id="button-login" class="btn waves-effect waves-light full-width" type="submit" name="action">
                    Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Page JS
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script src="js/login.js"></script>