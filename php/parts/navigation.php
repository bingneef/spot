<?php

/*****************************
loader.php
*****************************/

?>

<?php
#handle the menu in Android/iOS
if(!isset($_GET['agent'])){
?>

<!-- Navigation Bar
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="navbar-fixed">
    <nav class="indigo">
        <div class="nav-wrapper">
            <a href="" class="brand-logo">Spot</a>
            <ul class="right">
                <?php
                    //if more than spooter
                    if(isset($UserMasterObject) && $UserMasterObject->getLevel() > 0 && !isset($_GET['agent'])){
                ?>
                <li><a href="?page=map">Map</a></li>
                <li><a href="?page=spot">Spot</a></li>

                <?php
                        //if more than viewser
                        if($UserMasterObject->getLevel() > 1){
                ?>
                <li><a href="?page=control_panel">Admin</a></li>
                <?php
                        }
                    }
                ?>
                <li><a href="<?php print ROOT;?>?destroy=true">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>

<?php
//end $_GET['agent']
}
?>