<div id="modal" class="popupContainer" style="display:none;">
	<header class="popupHeader">
		<span class="header_title">Login</span>
	</header>
	<section class="popupBody">		
		<div class="social_login">
			<div class="action_btns">
				<div class="one_half">
					<a class="bouton" href="#" id="login_form" name="login_form">Login</a>
				</div>
				<div class="one_half last">
					<a class="bouton" href="#" id="register_form" name="register_form">Sign up</a>
				</div>
			</div>
		</div>
		
		<div class="user_register">
			<form id="form_signup" action="http://localhost:8282/api/user" method="POST" enctype='application/json'>
				<label>Pseudo</label> <input id="login_signup" name="login" class="field" type="text"><br>
				<label>Mot de Passe</label> <input id="password_signup" name="password" class="field" type="password"><br>
				<label>Confirmation</label> <input id="confirmation_signup" name="confirmation" class="field" type="password"><br>

				<div class="action_btns">
					<div class="one_half">
						<a class="bouton back_btn" href="#">Back</a>
					</div>
					<div class="one_half last">
						<a class="bouton btn_red" onClick="event.preventDefault(); signup();">Register</a>

					</div>
				</div>
			</form>
		</div>
			
		<div class="user_login">
			<form id="form_login" action="http://localhost:8282/api/authenticate" method="POST" enctype='application/json'>
				<label>Pseudo</label> <input id="login_login" name="login" class="field" type="text"><br>
				<label>Mot de Passe</label> <input id="password_login" name="password" class="field" type="password"><br>
				<div class="action_btns">
					<div class="one_half">
						<a class="bouton back_btn" href="#">Back</a>
					</div>
					<div class="one_half last">
						<a class="bouton btn_red" onClick="event.preventDefault(); authenticate();">Login</a>
					</div>
				</div>
			</form>
		</div>
		
			
	</section>
</div>