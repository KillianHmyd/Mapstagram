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

</script>