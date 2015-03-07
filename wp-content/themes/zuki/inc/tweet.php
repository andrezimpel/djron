<?php

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "320049245-kRHB2nhahONpwJJU3OXcr4U06CkiFif0FoomtMYS",
    'oauth_access_token_secret' => "7vNLpr8i3Dt0g1O4z7US2qkbpiqQKyT4W5HA8HYXCKkBo",
    'consumer_key' => "7tD1FgIFBUvRpuu1UmSpA",
    'consumer_secret' => "BapxiqxHfoU6787YEjXSuz5z12DCPt0nTJL1o3y9M"
);

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=deejayron';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();


$tweet = $response;
