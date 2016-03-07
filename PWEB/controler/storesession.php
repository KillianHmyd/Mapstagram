<?php
session_start();
if(isset($_POST['valeur']))
{
	$_SESSION[$_POST['variable']] = $_POST['valeur'];
	echo json_encode($_SESSION[$_POST['variable']]);
}
else{
	UNSET($_SESSION[$_POST['variable']]);
	echo '';
}

?>
