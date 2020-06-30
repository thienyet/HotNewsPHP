<?php  
	require_once 'vendor/autoload.php';

	$google_client = new Google_Client();

	$google_client->setClientId('984649141151-dnt2mi7aebvd93rciaqi651g7jg45uik.apps.googleusercontent.com');

	$google_client->setClientSecret('zqbNDYM9G44RG0PxULrLfCHl');

	$google_client->setRedirectUri('https://localhost/hotnews.vn/index.php');

	$google_client->addScope('email');
	$google_client->addScope('profile');


	if(!session_id()) {
		session_start();
	}

	$facebook = new \Facebook\Facebook([
		'app_id'    	=> '878476555994568',
		'app_secret'	=> '4b9a30c41af58c419debcad5732dfa52',
		'default_graph_version'  => 'v2.10'
	]);
?>