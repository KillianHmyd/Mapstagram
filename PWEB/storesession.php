<?php
session_start();
if(isset($_POST['variable']) && isset($_POST['valeur']))
{
$_SESSION[$_POST['variable']] = $_POST['valeur'];
}
?>
