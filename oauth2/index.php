<?php
session_start();
define('MYDIR','../');
require_once(MYDIR."vendor/autoload.php");

$redirect_uri = 'https://wt129.fei.stuba.sk/zadanie3/oauth2/';

$client = new Google_Client();
$client->setAuthConfig('../configs/credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
      
$service = new Google_Service_Oauth2($client);
			
if(isset($_GET['code'])){
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);
  $_SESSION['upload_token'] = $token;

  // redirect back to the example
  header('Location:' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
  $client->setAccessToken($_SESSION['upload_token']);
  if ($client->isAccessTokenExpired()) {
    unset($_SESSION['upload_token']);
  }
} else {
  $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    var_dump($client->getAccessToken());
    if(!empty($UserProfile)){
        $output = '<h1>Profile Details </h1>';
        $output .= '<img src="'.$UserProfile['picture'].'">';
        $output .= '<br/>Google ID : ' . $UserProfile['id'];
        $output .= '<br/>Name : ' . $UserProfile['given_name'].' '.$UserProfile['family_name'];
        $output .= '<br/>Email : ' . $UserProfile['email'];
        $output .= '<br/>Locale : ' . $UserProfile['locale'];
        $output .= '<br/><br/>Logout from <a href="logout.php">Google</a>'; 
    }else{
        $output = '<h3 style="color:#ff0000">Some problem occurred, please try again.</h3>';
    }   
  } else {
      $authUrl = $client->createAuthUrl();
      header('Location:'.filter_var($authUrl, FILTER_SANITIZE_URL));
  }
?>

<div><?php echo $output; ?></div>
