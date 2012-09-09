<?php 
// GoldUI facebook interface - newsfeed renderer to JSON for AJAX use
// XIM 2012

// TO BE PASSED TO THIS PAGE: userId and feedId (name of the URI of the fb feed the carer has selected (eg family news))

	$guiId = $_REQUEST['userId'];
	$feedID = $_REQUEST['feedId'];

	// uses the user's fb access key from the goldui fb user db

	require_once("fb.GoldUI.class.php");
	  
	// connect to xim's goldui database and grab the current user's friends' news feed...
    $feedUrl = "https://graph.facebook.com/me/home";
// $feedUrl = "https://api.facebook.com/method/fql.query?query=SELECT%20post_id%2C%20actor_id%2C%20target_id%2C%20message%20FROM%20stream%20WHERE%20filter_key%20in%20(SELECT%20filter_key%20FROM%20stream_filter%20WHERE%20uid%3Dme()%20AND%20type%3D'newsfeed')%20AND%20is_hidden%20%3D%200";

    $myFeed = new Feed($guiId,$feedUrl);
 
 	// print results back to javascript in JSON format
 	echo json_encode($myFeed->news->data); 
 ?>