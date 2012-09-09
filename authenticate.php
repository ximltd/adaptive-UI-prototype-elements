<?php 
// GoldUI facebook interface - Carer authentication
// (feed.php will use the access_token to read the captured data and render it for the end user)
// XIM 2012

// use server-side authentication to grant access on a long-term basis to our end user (via their carer)
// based on example at http://developers.facebook.com/docs/authentication/server-side/

   $app_id = "466972706660934"; // GoldUI app
   $app_secret = "d2f10fdea63aab91c8d01ceb48c8d6c7";
   $my_url = "http://www.xim.co.uk/research/GoldUI/authenticate.php"; // this file. must have same base domain as registered app above
   $scope = "read_stream,publish_stream"; // request access to friends' news streams
   
   session_start();
   $code = $_REQUEST["code"];
   $myGuiId = $_REQUEST['userId'];

   if(empty($code)) { // accessing this page for first time - need to authenticate via fb oauth and come back with a $code set
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //create random value for state to test later for cross-site request forgery (CSRF) protection
	 
     $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" . $app_id . 
	   "&redirect_uri=" . urlencode($my_url) . 
	   "&scope=" . $scope . 
	   "&state=" . $_SESSION['state'];

     echo("<script> top.location.href='" . $dialog_url . "'</script>"); // redirect the page to oauth login
   }
 
 // if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {  -- not using CSRF test for now (allows URL to be copied to another device as long as 'code' is passed
  
  if (isset($code)) { // user has been redirected back (or code has been passed to another GoldUI device)
 
	// make a SERVER SIDE (gives longest expiry - 60 days) request to exchange $code for actual User Access Token 
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url); // get access token from fb
     $params = null;
     parse_str($response, $params);
	 
	 // PRINT FOR NOW. BUT NEED TO STORE TO USER'S DB RECORD inserting/updating WHERE = $myGuiId
	 $access_token = "?access_token=" . $params['access_token']; // GET string to append to graph calls

echo $params['access_token'];

   }

   // could test here to see if user declined granting us access.
	// else if (isset($error_reason)) {echo ('Sorry, but you need to give authorization to GoldUI in order to access Facebook via GoldUI'); }
    // could relaunch page after 10 seconds to give user another chance to register

 //  not using CRSF check for now
 //  else { // from the 'state' test earlier
 //   echo("The state does not match. You may be a victim of CSRF.");
 // }

 ?>