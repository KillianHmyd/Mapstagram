<?php
 include '/model/user.php';
 include '/controler/friends.php';
 include '/controler/picture.php';
 ?>
<script>
function signup() {
	var $this = $('#form_signup');
	var login = $('#login_signup').val();
	var password = $('#password_signup').val();
	var confirmation = $('#confirmation_signup').val();
	var good = true;
	if(login == '') {
		$('#login_signup').css('border-color', '#FF0000');
		good=false;
	}
	else
		$('#login_signup').css('border-color', '#000000');
	if(password == ''){
		$('#password_signup').css('border-color', '#FF0000');
		good=false;
	}
	else
		$('#password_signup').css('border-color', '#000000');
	if(confirmation != password){
		$('#password_signup').css('border-color', '#FF0000');
		$('#confirmation_signup').css('border-color', '#FF0000');
		good=false;
	}
	else
		$('#confirmation_signup').css('border-color', '#000000');
	if(good) {
		setUser(login, password,function(err){
			if(!err){
				authenticateLog(login,password);
			}else{
				disconnect();
				location.reload()
			}
		});
	}
}

function authenticateLog(login, password){
	var $this = $('#form_login');
	var good = true;
	if(login == '') {
		$('#login_login').css('border-color', '#FF0000');
		good=false;
	}
	else
		$('#login_login').css('border-color', '#000000');
	if(password == ''){
		$('#password_login').css('border-color', '#FF0000');
		good=false;
	}
	else
		$('#password_signup').css('border-color', '#000000');
	if(good) {
		getUser(login, password, function(err, data){
			if(err){
				disconnect()
				location.reload()
			}
			else{
				$.ajax({
					url: 'controler/storesession.php', 
					type: 'POST', 
					dataType: 'json',
					data: {
						'valeur' : {
								'login' : data.login,
								'token' : data.token
							},
						'variable' : 'user'	
					}
				}).always(function(xhr,textStatus,err)
				{
					setSessionFriends(data.token, 
						function(err){
							if(err){
								disconnect()
								location.reload()
							}
							else{
								setSessionPictures(data.token, function(err){
									if(err){
										disconnect()
										location.reload()
									}
									else{
										setMarkers()
										location.reload()
									}
								})
							}
						}
					)
				})
			}
		})
		}
}

function authenticate(){
	var login = $('#login_login').val();
	var password = $('#password_login').val();
	authenticateLog(login, password)
}

function disconnect(){
	$.ajax({
			url: 'controler/unsetsession.php', 
			type: 'GET'
		}).always(function(xhr,textStatus,err)
			{
				location.reload();
			});
}

function getSessionUser(callback){
	$.ajax({
			url: 'controler/getsession.php', 
			type: 'POST', 
			dataType: 'json',
			data: {
				'variable' : 'user'	
				}
			}).done(function(data){
				callback(null, data)
			})
			.fail(function(data){
				callback(data)
			})
}

function search(token, username, callback){
	getUsers(token, username, function(err, users){
		if(err)
			callback(err)
		else{
			callback(null, users)
		}
	})
}

</script>