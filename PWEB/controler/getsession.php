<?php
session_start();
if(isset($_POST['variable']) && isset($_SESSION[$_POST['variable']])){
	echo json_encode($_SESSION[$_POST['variable']]);
}
else{
	echo json_encode(Array('code' => '404', 'message' => 'No session found' ));
}
?>