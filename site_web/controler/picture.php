<?php
	include '/model/picture.php'
?>

<script>
function setSessionPictures(token, callback){
	getPictures(token, function(err,pictures){
		if(err){
			callback(err)
		}
		else{
			$.ajax({
				url: 'controler/storesession.php', 
			type: 'POST', 
			dataType: 'json',
			data: {
				'valeur' : pictures,
				'variable' : 'pictures'	
				}
			}).always(function(data){
			if(callback)
				callback(null);
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
				'variable' : 'pictures'	
				}
			}).done(function(data){
				callback(null, data)
			})
			.fail(function(data){
				callback(data)
			})
}

function setMarkers(){
	getSessionPictures(function(err, data){
		//alert(JSON.stringify(data))
		//map = L.map('map').setView([latitude,longitude], 13);
		if(!err){
			var marker;
			for(var i = 0; i < data.length; i++){
				var j = i
				marker = L.marker([data[i].latitude, data[i].longitude]).on('click', function(e){
					$.magnificPopup.open({
						items: {
							title: "Photo de " + data[j].login,
							src: 'http://localhost:8282/api/photo/'+data[j].filename
						},
						type: 'image'
					});
				}).addTo(map);
			}
		}
	});
}

</script>