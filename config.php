<?php  
	require_once 'vendor/autoload.php';

	$google_client = new Google_Client();

	$google_client->setClientId('984649141151-dnt2mi7aebvd93rciaqi651g7jg45uik.apps.googleusercontent.com');

	$google_client->setClientSecret('zqbNDYM9G44RG0PxULrLfCHl');

	$google_client->setRedirectUri('https://localhost/hotnews.vn/index.php');

	$google_client->addScope('email');
	$google_client->addScope('profile');


?>