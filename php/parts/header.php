<?php 

/*****************************
header.php
Head element of each window
*****************************/

?>
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Spot!</title>
  <meta name="description" content="Spot anything, anywhere, anytime.">
  <meta name="author" content="Bing Steup">

  <meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;' name='viewport' />

  <!-- jQuery
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <?php

  //load mobile jquery for Android
  if(isset($_GET['agent']) && true)
    print '<script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.js"></script>';
  ?>

  <!-- js
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

  <!-- js
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="js/tools.js"></script>
  <script src="js/initiate.js"></script>

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/loaders.css">
  <link rel="stylesheet" href="css/forms.css">

  <?php
  //load mobile jquery for Android
  if(isset($_GET['agent']))
    print '<link rel="stylesheet" href="css/mobile.css">';
  ?>

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>