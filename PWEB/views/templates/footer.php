
		<script src="views/js/bootstrap.min.js"></script>
		<script src="views/leaflet/leaflet.js"></script>
		<script src="views/leaflet/leafletembed.js"></script>
		<script src="views/leaflet/leaflet-src.js"></script>
		<script src="views/js/jquery-2.2.1.js"></script>
		<script type="text/javascript" src="views/js/jquery.leanModal.min.js"></script>
		<?php 
		include 'controler/user.php';
		?>
		<script type="text/javascript">
		
		$(function(){
		    init();
				$(function () {
					// Calling Login Form
					$("#login_form").click(function () {
					$(".social_login").hide();
					$(".user_login").show();
					return false;
				});
				// Calling Register Form
				$("#register_form").click(function () {
					$(".social_login").hide();
					$(".user_register").show();
					$(".header_title").text('Register');
					return false;
				});
				// Going back to Social Forms
				$(".back_btn").click(function () {
					$(".user_login").hide();
					$(".user_register").hide();
					$(".social_login").show();
					$(".header_title").text('Login');
					return false;
				});
			})
		})
		
		function init(){
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position){initmap(position.coords.longitude, position.coords.latitude)}, handleError);
			} else { 
				initmap(2.333333,48.866667);
			}
			$("#modal_trigger").leanModal({});
			
			
		}
		
		</script>
			
	</body>
</html>