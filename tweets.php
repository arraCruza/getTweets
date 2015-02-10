<?php
require 'Auth.php'; // Get it from: https://github.com/themattharris/tmhOAuth

// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)

$connection = new tmhOAuth(array(
  'consumer_key' => '6TjXygNTavR4jRKqjh6GBWqJU',
	'consumer_secret' => 'ODvbjzWbVMeaYhTsKssmSBdBj5jkXLx8QebKdb5EnWfGrRV9CZ',
	'user_token' => '784094394-NUjykNczCyWuHkBInDXhltC8EkKZWbFHUtdvl0Mr', //access token
	'user_secret' => 'Ys1YQvQIsq4IKMGpf05JST2GHRHOp4AE4lCl0E2rfeoJJ' //access token secret
));

// set up parameters to pass
$parameters = array();

if ($_GET['count']) {
	$parameters['count'] = strip_tags($_GET['count']);
}

if ($_GET['screen_name']) {
	$parameters['screen_name'] = strip_tags($_GET['screen_name']);
}

if ($_GET['twitter_path']) { $twitter_path = $_GET['twitter_path']; }  else {
	$twitter_path = '1.1/statuses/user_timeline.json';
}

$http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

if ($http_code === 200) {
	$response = strip_tags($connection->response['response']);
    

	if ($_GET['callback']) { 
		echo $_GET['callback'],'(', $response,');';
	} else {
		echo $response;	
	}
} else {
	echo "Error ID: ",$http_code, "<br>\n";
	echo "Error: ",$connection->response['error'], "<br>\n";
}
