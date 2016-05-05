<?php

/*****************************
loader.php
Show loader for each page
*****************************/

?>

<!-- Loader
-––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="loader" class="loader">
  <div class="loader-inner ball-grid-pulse">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<!-- Force quick center loader and show
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script>
    centerContent($('.ball-grid-pulse'));
    $('#loader').show();
</script>