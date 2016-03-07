<script>
function setUser(login, password, callback){
	$.ajax({
		url: 'http://localhost:8282/api/user', 
		type: 'POST', 
		dataType: 'json',
		data: {
			'login' : login, 
			'password' : password
			}
	})
	.done(function(data){
		if(data.code == 201){
			callback(null);
			//authenticateLog(login,password);
		}
		else{
			callback(data.message)
		}
	}).fail(function(xhr,textStatus,err)
		{
			callback("readyState: " + xhr.readyState + " \n responseText: "+ xhr.responseText + 
			"\n status: " + xhr.status + "\n text status: " + textStatus +"\n error: " + err);
		})
}

function getUser(login, password, callback){
	$.ajax({
		url: 'http://localhost:8282/api/authenticate', 
		type: 'POST', 
		dataType: 'json',
		data: {
			'login' : login, 
			'password' : password
			}
	}).done(function(data){
			callback(null, data)
	}).fail(function(xhr,textStatus,err)
		{
			callback("readyState: " + xhr.readyState + " \n responseText: "+ xhr.responseText + 
			"\n status: " + xhr.status + "\n text status: " + textStatus +"\n error: " + err);
		})
}

function getUsers(token, username, callback){
	$.ajax({
		url: 'http://localhost:8282/api/user/search', 
		type: 'GET', 
		dataType: 'json',
		headers: {'token' : token},
		data: {
			'username' : username 
			}
	}).done(function(data){
			callback(null, data)
	}).fail(function(xhr,textStatus,err)
		{
			callback("readyState: " + xhr.readyState + " \n responseText: "+ xhr.responseText + 
			"\n status: " + xhr.status + "\n text status: " + textStatus +"\n error: " + err);
		})
}
</script>