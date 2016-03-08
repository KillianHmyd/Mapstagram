<?php
	include '/model/picture.php';
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
		if(!err){
			var marker;
			for(var i = 0; i < data.length; i++){
				var j = i
				var pictures = data
				var nameFile = JSON.stringify(pictures[j].filename)
				nameFile = nameFile.replace(/"/g,""); 
				makePicture('http://localhost:8282/api/photo/'+nameFile, function(err, img){
					if(!err){
						marker = L.marker([pictures[j].latitude, pictures[j].longitude]).on('click', function(e){
							$.magnificPopup.open({
							items: {
								title: "Photo de " + pictures[j].login,
								src: img
							},
							type: 'image'
							});
						}).addTo(map);
					}
				})
				
			}
		}
	});
}

function sendpicture(){
	var file = document.getElementById('pictureToSend').files[0];
    if (file) {
        // create reader
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            getSessionUser(function(errUser, dataUser){
				if(!errUser){
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(function(position){
							var longitude = position.coords.longitude
							var latitude = position.coords.latitude
							setPicture(dataUser.token, e.target.result, longitude, latitude, function(errPicture){
							if(!errPicture)
								initSession(function(err){
									if(!err)
										location.reload()
								})
						})
						
					})
					} else { 
						alert("Localisation non détécté")
					}
				}
			})
        };
    }
}

function moveMapToPicture(longitude, latitude){
	map.panTo(new L.LatLng(latitude, longitude));
}

</script>