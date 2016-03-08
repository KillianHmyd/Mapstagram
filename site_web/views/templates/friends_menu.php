<div class="col-xs-3" id="left">
    
      <?php
		if(!isset($_SESSION['user'])){?>
		<center><h2>Hors Connexion</h2></center>
		<div class="panel panel-default">
			<div class="panel-heading"><center><a href="">Déconnecté</a></center></div>
		</div>
		<p>Veuillez vous connecter pour voir des photos</p>
		<hr>
			<?php
		}else{
			?><center><h2><?php echo($_SESSION['user']['login']);?></h2></center>
			<div class="panel panel-default">
					<div class="panel-heading"><center>Vos photos</center></div>
					</div>
					<center><a class="btn btn-primary" id="modal_trigger2" href="#modal">Ajouter photo</a></center>
					<br>
					<?php
					if(isset($_SESSION['pictures']) && is_array($_SESSION['pictures'])){
						foreach($_SESSION['pictures'] as $picture){
							if($picture['login'] == $_SESSION['user']['login']){
							?>
							<?php $url = "http://localhost:8282/api/photo/".$picture['filename'];
									$img =file_get_contents($url);?>
							<a href="javascript:moveMapToPicture(<?php echo $picture['longitude'].','.$picture['latitude']; ?>);"><img src=<?php echo ($img);?> height="42" width="42"></a>
							
						<?php }}
					}
					?><hr><?php
					if(isset($_SESSION['friends']) && is_array($_SESSION['friends'])){
						foreach($_SESSION['friends'] as $friend){?>
							<div class="panel panel-default">
							<div class="panel-heading"><center><a href=""><?php echo($friend['login2']);?></a></center></div>
							</div>
							<?php
							if(isset($_SESSION['pictures'])){
								foreach($_SESSION['pictures'] as $picture){
									if($picture['login'] == $friend['login2']){
										
							?>
							<?php $url = "http://localhost:8282/api/photo/".$picture['filename'];
									$img =file_get_contents($url);?>
							<a href="javascript:moveMapToPicture(<?php echo $picture['longitude'].','.$picture['latitude']; ?>);"><img src=<?php echo ($img);?> height="42" width="42"></a>
					<?php
									}
								}
							}
							?><hr><?php
						}
						
					}
					else{
					?>
						<div class="panel panel-default">
						<div class="panel-heading"><center>Aucun ami 😭</center></div>
						</div>
						<p>Et si tu en cherchais dans la barre de recherche?</p>
						<hr>
					<?php
					}
		}		
		?>  

    </div>