<!DOCTYPE html>
<html lang="en">
	<head>
	<?php
	session_start();
	?>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>2 column Google maps, foursquare (outer scroll)</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="views/css/bootstrap.min.css" rel="stylesheet">
		<link href="views/css/styles.css" rel="stylesheet">
		<link rel="stylesheet" href="views/leaflet/leaflet.css"/>
		
	</head>
	<body>
	
	
	
<!-- begin template -->
<div class="navbar navbar-custom navbar-fixed-top">
 <div class="navbar-header"><a class="navbar-brand" href="#">PWEB</a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav" id="menu">
        <li class="active"><a href="#">Accueil</a></li>
        <?php
		if(!isset($_SESSION['user'])){
			echo('<li><a id="modal_trigger" href="#modal">Connexion</a></li>');
		}
		else{
			echo('<li><a onClick="event.preventDefault(); disconnect();">Deconnexion</a></li>');
		}?>
		
        <li>&nbsp;</li>
      </ul>
      <form class="navbar-form">
        <div class="form-group" style="display:inline;">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Qui recherchez vous?">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
          </div>
        </div>
      </form>
    </div>
</div>