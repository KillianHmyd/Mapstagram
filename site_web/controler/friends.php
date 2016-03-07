<?php
 include '/model/friends.php';
?>
<script>

function setSessionFriends(token, callback){
	getFriends(token, function(err,friends){
		if(err){
			callback(err)
		}
		else{
			$.ajax({
				url: 'controler/storesession.php', 
			type: 'POST', 
			dataType: 'json',
			data: {
				'valeur' : friends,
				'variable' : 'friends'	
				}
			}).always(function(data){
			if(callback)
				callback(null, data);
		})
		}
	})
}

function getSessionPictures(callback){
	$.ajax({
			url: 'controler/getsession.php', 
			type: 'POST', 
			dataType: 'json',
			data: {
				'variable' : 'friends'	
				}
			}).done(function(data){
				callback(null, data)
			})
			.fail(function(data){
				callback(data)
			})
}

function addFriend(token, loginFriend, callback){
	setFriend(token, loginFriend, function(err){
		if(err)
			callback(err)
		else{
			setSessionFriends(token, callback(null))
		}
	})
}

</script>