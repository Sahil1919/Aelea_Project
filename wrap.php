<?php 

$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

$url_components = parse_url($CurPageURL);

parse_str($url_components['query'], $params);

echo $params['id'];
?>
