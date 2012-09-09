<?php
class Feed {

  var $itemId, // current item (same as bookmark?)
	  $fromName,
	  $profilePic,
	  $story,
	  $firstItem,
	  $lastItem, // last item read
	  
	  $news = array(); // holds all retrieved stories for this feed

  private $con, $dbUid, $dbPwd; // mysql connection details held locally
  
  // uses db tables 'connections' and 'feeds'

  function __construct($guiUserId, $graph) {
  // open a new connection with user's access key
  
  // connect to xim's goldui database:
  $this->dbUid = "serverto_xim";
  $this->dbPwd = "MFDP;NfK)VCE";
  
  $con = mysql_connect("localhost",$this->dbUid,$this->dbPwd);
  if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
  
  mysql_select_db("serverto_xim", $con);

  // get user's access key from database
 $result = mysql_query("SELECT * FROM `user_fb_ids` WHERE (`user_goldui_id` =  '".$guiUserId."')");
 $params = null; 
 while($row = mysql_fetch_array($result))
   {
     $user_id = $row['user_goldui_id'];
	 $fb_user_id = $row['user_fb_id'];
	 $access_token = "?access_token=" . $row['access_token']; // HTTP string to append to graph calls
   }

     // now grab the current user's friends' requested news feed (appending access token):
     $graph_url = $graph . $access_token;

     $this->news = json_decode(file_get_contents($graph_url));
     // *** TO DO : error check here based on facebook's returned error messages
	 // BUT really messy as this needs to know calling url and app_id!
 /*	 if ($this->news->error) {
  // check to see if this is an oAuth error:
    if ($this->news->error->type== "OAuthException") {
      // Retrieving a valid access token. 
      $dialog_url= "https://www.facebook.com/dialog/oauth?"
        . "client_id=" . $app_id 
        . "&redirect_uri=" . urlencode($my_url);
      echo("<script> top.location.href='" . $dialog_url 
      . "'</script>");
    }
    else {
      echo "other error has happened";
    }
  } */

	 
	 // RUN through the returned array to identify top and bottom, and grab the first item in list
	 $this->firstItem = $this->news->data[0]->id;
	 $i = 0;
     foreach ($this->news->data as $newsitem) {
/*		 
	 	$this->itemId = $newsitem->id;
	 	$this->fromName = $newsitem->from->name;
	 	$this->profilePic ='https://graph.facebook.com/' . $newsitem->from->id . '/picture' . $access_token; // url of poster's profile picture
	 	$this->story = $newsitem->story . $newsitem->message;
	 	$this->lastItem = $this->itemId; // set to current item	 
*/		
	// build simple local array of the IDs of the objects collected by this graph query
	$this->itemIds[$i] = $newsitem->id;
	$i++;				 
	 }
	 
  mysql_close($con); 

} // constructor

function latestItem() {
// return top item 
	echo($this->news->data[count($this->news->data)-1]);

// SHOULD reset bookmark to top of list's id
}

function previous_item() {
}

function next_item() {
}

function like_item() {
}

// Might need to refresh the feed every so often, adding new articles to the top.
// have to get the item ids from fb
// save and manage bookmark within a function
// filter readable articles (ignore links, etc.)
}
?>