<script>

function getFriends(token, callback){
	$.ajax({
			url: 'http://localhost:8282/api/friend', 
			type: 'GET', 
			dataType: 'json',
			headers: {
				'token' : token
			}
	}).done(function(data){
		if(data.code == 500){
			callback(data.err)
		}
		else{
			callback(null, data);
		}
	}).fail(function(xhr,textStatus,err)
			{
				callback(err)
	})
}

function setFriend(token, loginFriend, callback){
	$.ajax({
			url: 'http://localhost:8282/api/friend', 
			type: 'POST', 
			dataType: 'json',
			data: {'login' : loginFriend},
			headers: {
				'token' : token
			}
	}).done(function(data){
		if(data.code != 201){
			callback(data.err)
		}
		else{
			callback(null, data);
		}
	}).fail(function(xhr,textStatus,err)
			{
				callback(err)
	})
}

</script>