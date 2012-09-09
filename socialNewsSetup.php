<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>GoldUI Portal : Social News Setup</title>
<link href="HTML5_thrColFixHdr.css" rel="stylesheet" type="text/css"><!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>

<div class="container">
  <header>
    <a href="http://www.goldUI.eu"><img src="images/goldui.png" width="164" height="67" alt="logo"/></a>
  </header>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="#">Link one</a></li>
      <li><a href="#">Link two</a></li>
      <li><a href="#">Link three</a></li>
      <li><a href="#">Link four</a></li>
    </ul>
    <aside>
      <p> This page allows you to set up some useful 'feeds' of news and social activity directly from Facebook to your end user's GoldUI devices. By selecting specific feeds, GoldUI can present a clear, concise set of news items without the 'noise' that usually accompanies social networks.</p>
    </aside>
  <!-- end .sidebar1 --></div>
  <article class="content">
    <h1>Social news service - setup</h1>
    <section>
     <h2>Enable Access</h2>
      <p>Please click on the following button and login to allow GoldUI to access your user's Facebook account:</p>
      <a href="authenticate.php?userId=<?php echo $_REQUEST['enduser']; ?>" target="new"><img src="images/facebook-connect.png" width="222" height="57" alt="authenticate"></a>
      <p>(devnote: must call this page with <em>?enduser=xyz</em>)</p>
    </section>
    <section id="feedbox">
      <h2>Select Feeds</h2>
      <p>Using the checklist options below, please select a set of news feeds from Facebook that will be of interest to your end user:</p>
      <form action="" method="post" name="feeds" id="feeds">
        <p>
          <input type="checkbox" name="events" id="events" accesskey="e" tabindex="1">
          <label for="events">Events in the local community</label>
          <input name="eventsURL" type="hidden" id="eventsURL" value="https://graph.facebook.com/195466193802264">
        </p>
        <p>
          <input type="checkbox" name="travel" id="travel" accesskey="t" tabindex="2">
          <label for="travel">Travel opportunities</label>
          <input name="travelURL" type="hidden" id="travelURL" value="https://graph.facebook.com/195466193802264">
        </p>
        <p>
          <input type="checkbox" name="culture" id="culture" accesskey="c" tabindex="3">
          <label for="culture">Local culture and places of interest</label>
          <input name="cultureURL" type="hidden" id="ultureURL" value="https://graph.facebook.com/195466193802264">
        </p>
        <p>
          <input type="checkbox" name="volunteer" id="volunteer" accesskey="v" tabindex="4">
          <label for="volunteer">Volunteering</label>
          <input name="volunteeringURL" type="hidden" id="volunteeringURL" value="https://graph.facebook.com/195466193802264">
        </p>
        <p>
          <input type="checkbox" name="localNews" id="localNews" accesskey="l" tabindex="5">
          <label for="localNews">Local news</label>
          <input name="localNewsURL" type="hidden" id="localNewsURL" value="https://graph.facebook.com/195466193802264">
        </p>
        <p>
          <input type="checkbox" name="friends" id="friends" accesskey="f" tabindex="6">
          <label for="friends">Friends and family news</label>
          <input name="friendsURL" type="hidden" id="friendsURL" value="https://graph.facebook.com/me/home">
        </p>
        <p>
          <input type="submit" name="Submit" id="Submit" value="Submit" accesskey="o" tabindex="7">
        </p>
      </form>
    </section>
  <!-- end .content --></article>
  <aside>
    <h4>Why do I need to enable Facebook access?</h4>
    <p>Before GoldUI can see your user's friends' activity on Facebook, it must be given the right to access. Once you have provided this, Facebook allows access for 60 days, after which time we will need to log in again to renew access.</p>
  </aside>
  <footer>
    <p>[GoldUI project copyright / funding / privacy statements]</p>
  </footer>
  <!-- end .container --></div>
</body>
</html>