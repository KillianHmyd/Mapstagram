var ajaxRequest;
var plotlist;
var plotlayers=[];

function initmap(longitude, latitude, callback) {
     // initialize the map

  map = L.map('map').setView([latitude,longitude], 13);

  // load a tile layer
  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
      attribution: 'osmAttrib',
      maxZoom: 17,
      minZoom: 2
    }).addTo(map);
	
	if(callback)
		callback(null)
	
	
}

function handleError(error) {
    longitude = 2.333333;
	latitude = 48.866667;
	initmap(longitude, latitude);
}