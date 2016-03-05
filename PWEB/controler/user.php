<?php
 include '/model/user.php';
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
				alert(err)
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
				alert("readyState: " + xhr.readyState + " \n responseText: "+ xhr.responseText + 
				"\n status: " + xhr.status + "\n text status: " + textStatus +"\n error: " + err);
			}
			else{
				$.ajax({
					url: 'storesession.php', 
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
					setSessionFriends(data.token);
				});
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
			url: 'unsetsession.php', 
			type: 'GET'
		}).always(function(xhr,textStatus,err)
			{
				location.reload();
			});
}

function setSessionFriends(token){
	$.ajax({
			url: 'http://localhost:8282/api/friend', 
			type: 'GET', 
			dataType: 'json',
			headers: {
				'token' : token
			}
	}).done(function(data){
		$.ajax({
				url: 'storesession.php', 
			type: 'POST', 
			dataType: 'json',
			data: {
				'valeur' : data,
				'variable' : 'friends'	
				}
			}).always(function(data){
			location.reload();
		})
			}).fail(function(xhr,textStatus,err)
			{
				alert("readyState: " + xhr.readyState + " \n responseText: "+ xhr.responseText + 
				"\n status: " + xhr.status + "\n text status: " + textStatus +"\n error: " + err);
	})
}
</script>