<!DOCTYPE html>
<html lang="en">
	<head>
	<?php
	session_start();
	?>
	<script>
	var map;
	</script>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>PWEB</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="views/css/bootstrap.min.css" rel="stylesheet">
		<link href="views/css/styles.css" rel="stylesheet">
		<link href="views/css/magnific-popup.css" rel="stylesheet">
		<link rel="stylesheet" href="views/leaflet/leaflet.css"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" rel="stylesheet" />
		<link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css" />

	</head>
	<body>
	
	
	
<!-- begin template -->
<div id="menu" class="navbar navbar-custom navbar-fixed-top">
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
		
      </ul>
	  <?php if(isset($_SESSION['user'])){?>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <select class="js-data-example-ajax">
						<option value="3620194" selected="selected">Rechercher un(e) ami(e)</option>
					</select>
                </div>
            </form>
	  <?php }?>
    </div>

	
</div>