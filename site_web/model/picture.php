<script>

function getPictures(token, callback){
	$.ajax({
			url: 'http://localhost:8282/api/photo', 
			type: 'GET', 
			dataType: 'json',
			headers: {
				'token' : token
			}
	}).done(function(data){
		callback(null, data);
			}).fail(function(xhr,textStatus,err)
			{
				callback(err)
	})
}

function deletePicture(token, filename, callback){
	$.ajax({
		url: 'http://localhost:8282/api/photo',
		type: 'DELETE',
		dataType: 'json',
		headers: {
			'token' : token
		},
		data: {
			'filename' : filename
		}
	}).done(function(data){
		callback(null, data);
	}).fail(function(xhr,textStatus,err)
	{
		callback(err)
	})
}

function makePicture(url, callback){
	$.ajax({
			url: url, 
			type: 'GET', 
			dataType: 'text',
	}).done(function(data){
		callback(null, data);
			}).fail(function(xhr,textStatus,err)
			{
				callback(err)
	})
}

function setPicture(token, photo, longitude, latitude, callback){
	$.ajax({
			url: 'http://localhost:8282/api/photo', 
			type: 'post', 
			dataType: 'json',
			headers: {
				'token' : token
			},
			data: {
				'photo':photo,
				'longitude': longitude,
				'latitude': latitude
			}
	}).done(function(data){
		callback(null, data);
			}).fail(function(xhr,textStatus,err)
			{
				callback(err)
	})
}

</script>