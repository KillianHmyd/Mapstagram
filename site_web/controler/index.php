 <?php
 include '/controler/picture.php';
 include '/controler/friends.php';
 include '/controler/user.php';
 ?>

<script>
$(function(){
	init();		
})

getSessionUser(function(err, dataUser){
	if(!err){
		$(".js-data-example-ajax").select2({
	width: '400%',
	ajax: {
    url: "http://localhost:8282/api/user/search",
	type : "get",
    dataType: 'json',
	headers: {'token' : dataUser.token},
    delay: 250,
    data: function (params) {
      return {
        username: params.term 
      };
    },
    processResults: function (data, params) {
      params.page = data.lenght || 1;
      return {
        results: data,
        pagination: {
          more: (1 * 30) < data.lenght
        }
      };
    },
    cache: true
  },
  escapeMarkup: function (markup) { return markup; }, 
  minimumInputLength: 1,
  templateResult: formatFriend, 
  templateSelection: formatFriendSelection 
});
	}
})

$(".js-data-example-ajax").select2({
	width: '400%',
	ajax: {
    url: "http://localhost:8282/api/user/search",
	type : "get",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        username: params.term 
      };
    },
    processResults: function (data, params) {
      params.page = data.lenght || 1;
      return {
        results: data,
        pagination: {
          more: (1 * 30) < data.lenght
        }
      };
    },
    cache: true
  },
  escapeMarkup: function (markup) { return markup; }, 
  minimumInputLength: 1,
  templateResult: formatFriend, 
  templateSelection: formatFriendSelection 
});

$search = $(".js-data-example-ajax")

$search.on("select2:select", function (evt) { 
var args = JSON.stringify(evt.params, function (key, value) {
      if (value && value.nodeName) return "[DOM node]";
      if (value instanceof $.Event) return "[$.Event]";
      return value;
    });
	args = JSON.parse(args)
	var txt;
	var r = confirm("Ajouter "+args.data.name+" en ami?");
	if (r == true) {
		getSessionUser(function(err, user){
			if(!err){
				addFriend(user.token, args.data.name, function(err){
						if(!err){
							initSession(function(){
								location.reload()
							})
						}
				})
			}
		})
	}

 });


$(window).bind('beforeunload', function(){
	initSession();
});


function formatFriend (friend) {
	return friend.name;
}

function formatFriendSelection (friend) {
	return friend.name;
}

function init(){
	// Calling Login Form
	$("#search_form").click(function () {
	$(".social_login").hide();
	$(".user_login").show();
	return false;
	});
	
	$("#login_form").click(function () {
	$(".social_login").hide();
	$(".user_login").show();
	return false;
	});
	// Calling Register Form
	$("#register_form").click(function () {
		$(".social_login").hide();
		$(".user_register").show();
		$(".header_title").text('Register');
		return false;
	});
	// Going back to Social Forms
	$(".back_btn").click(function () {
		$(".user_login").hide();
		$(".user_register").hide();
		$(".social_login").show();
		$(".header_title").text('Login');
		return false;
	});
	if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position){initmap(position.coords.longitude, position.coords.latitude, initSession)}, handleError);
	} else { 
		initmap(2.333333,48.866667, initSession);
	}
	$("#modal_trigger").leanModal({});
	$("#modal_trigger2").leanModal({});

	$.contextMenu({
		selector: '.context-menu-one',
		callback: function(key, options) {
			controlDeletePicture($(this).attr("filename"))
		},
		items: {
			"delete": {name: "Supprimer", icon: "delete"}
		}
	});

	$('.context-menu-one').on('click', function(e){
		console.log('clicked', this);
	})
}

function initSession(callback){
	getSessionUser(function(errUser, dataUser){
		if(dataUser.code != 404 && !errUser){
			var token = dataUser.token
			setSessionFriends(token, function(errFriends, dataFriends){
				if(errFriends){
					disconnect()
				}
				else{
					setSessionPictures(token, function(errPictures){
						if(errPictures){
							disconnect()
						}
						else{
							setMarkers()
							if(callback)
								callback()
						}
					})
					
				}
			})
		}
	})
}
</script>