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
			?><center><h2><?php echo($_SESSION['user']['login']);?></h2></center><?php
			if(isset($_SESSION['friends'])){
			foreach($_SESSION['friends'] as $friend){?>
			      <div class="panel panel-default">
					<div class="panel-heading"><center><a href=""><?php echo($friend['pseudo']);?></a></center></div>
					</div>
				<p>BLABLA</p>
				<hr>
			<?php
			}
			}
			else{
				?>
			      <div class="panel panel-default">
					<div class="panel-heading"><center><a href="">Aucun ami 😭</a></center></div>
					</div>
				<p>Et si tu en cherchais dans la barre de recherche?</p>
				<hr>
			<?php
			}
		}
		?>  

    </div>