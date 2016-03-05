<?php
$arr = array('login' => 'abc', 'password' => 'aze');

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => json_encode($arr)
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('http://localhost:8282/api/user', false, $context);
echo($result);
?>