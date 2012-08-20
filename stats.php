<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta http-equiv="content-type" content="text-html; charset=utf-8">
   <link href="fugu5.css" type="text/css" rel="stylesheet">
<link media="only screen and (max-device-width: 480px)" 
  href="fugu5iphone.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="favicon.ico">
<link rel="apple-touch-startup-image" href="images/fugugames.png"/>
<link rel="apple-touch-icon" href="images/fugugames.png"/>
<link rel="image_src" href="images/fugugames.png" />
<meta name="description" content="Mobile games on Android and iOS."/>
<title>Fugu Games</title>
</head>
   <body>

<div id="legal">
Copyright&copy;2005-2012
<a href="http://technicat.com/" title="Technicat web site">Technicat, LLC</a>.
All Rights Reserved.
Fugu Games<sup>&trade;</sup> is a
registered trademark of
<a href="http://www.technicat.com/">Technicat, LLC</a>.
Read our <a href="http://fugutalk.com/">blog</a>.
<br/>
	  Fugu logos by
	  <a href="http://www.shanenakamuradesigns.com/">Shane Nakamura
	  Designs</a>.
  Stars from <a
  href="http://www.channel-ai.com/blog/plugins/star-rating/">Star
  Ratings for Reviews</a>. <a href="http://hyperbowl3d.com/">HyperBowl</a> is a trademark of <a href="http://hyperentertainment.com/">Hyper
  Entertainment, Plc.</a>
	</div>

<div id="twitterWidget">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 3,
  interval: 6000,
  width: 250,
  height: 300,
  theme: {
    shell: {
      background: '#333333',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#4aed05'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: false,
    timestamp: false,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('fugugames').start();
</script>
</div>

<div id="adsense">
     <script type="text/javascript"><!--
     google_ad_client = "ca-pub-9222769003491643";
     /* fugutalkbutton */
   google_ad_slot = "3959694235";
google_ad_width = 125;
google_ad_height = 125;
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>
  </div>

<table cellspacing="0" cellpadding="0" id="appstore">
<tr>
  <th scope="col"></th>
        <th scope="col">	  <a
	  href="http://itunes.apple.com/WebObjects/MZStore.woa/wa/viewArtist?id=295241742"><img
	  src="images/App_Store_badge.png" alt="Available on the App Store"/></a>
</th>
        <th scope="col">Unit Sales <a href="http://fugugames.com/stats.php?type=sales"><img
	  src="bar.png"/></a> Revenue <a href="http://fugugames.com/stats.php?type=rev"><img src="moneybar.png"></a></th>

      </tr>
<?php
  
include_once "appdata.php";

$sales = file("Totals by Product.txt");
array_shift($sales); // get rid of column headers
$salestotal = array();
$saleslabel = array();
$dollartotal = array();
      $totaldollars = 0;
$maxlength = 1;
$maxdollars = 1;
while (list ($index, $val) = each($sales)) {
  $val = trim($val);
  $valarray = explode("\t",$val);
  $dollars = array_pop($valarray);
  $num = array_pop($valarray);
  $type = array_pop($valarray);

  if ($type != "Mac") {
    $name = array_pop($valarray);
  
    $realnum = str_replace(",", "", $num);
    if ($realnum>$maxlength) $maxlength = $realnum;

    $realdollars = str_replace(",", "", $dollars);
    $realdollars = str_replace("$", "", $realdollars);
    if ($realdollars>$maxdollars) $maxdollars = $realdollars;
$totaldollars += $realdollars;
    
    $salestotal[$name]=$realnum;
    $saleslabel[$name]=$num;
    $dollartotal[$name]=$realdollars;
  }

}

if ($_GET["type"]=="sales" || $_GET["type"]=="") {
arsort($salestotal,SORT_NUMERIC);
while (list ($name, $realnumber) = each($salestotal)) {
 $length = $realnumber/$maxlength*$barlength;
 $label = $saleslabel[$name];

  beginrowbar($name);

 echo("<td class=\"value\"><img src=\"bar.png\" width=\"$length\" />$label</td>");
endrow();
}
}

if ($_GET["type"]=="rev") {
 arsort($dollartotal,SORT_NUMERIC);
while (list ($name, $realnumber) = each($dollartotal)) {
  $portion = $realnumber/$maxdollars;
  $percent=number_format($realnumber/$totaldollars*100);
 $length = $portion*$barlength;
 $label = $saleslabel[$name];

  beginrowbar($name);
  echo("<td class=\"value\"><img src=\"moneybar.png\" width=\"$length\" />$percent%</td>");
 endrow();
}
}
 
echo("</table>");

$star = "<img src=\"images/star.png\"/>";
$reviews = file("Reviews.txt");
array_shift($reviews);
$fivestars = array();
while (list ($index, $val) = each($reviews)) {
  $val = trim($val);
  $valarray = explode("\t",$val);
  $review = array_pop($valarray);
  $author = array_pop($valarray);
  $rating = array_pop($valarray);
  $title = array_pop($valarray);
  $country = array_pop($valarray);
  $version = array_pop($valarray);
  $date = array_pop($valarray);
  $type = array_pop($valarray);
  $name = array_pop($valarray);

  if ($type != "Mac" && $rating==5) {
array_push($fivestars,"$star$star$star$star$star from $author for <a
href=\"$urls[$name]\">$name</a>\n<div class=\"quote\">\"$review\"</div>");
}
  if ($type != "Mac" && $rating==4) {
array_push($fivestars,"$star$star$star$star from $author for <a
href=\"$urls[$name]\">$name</a>\n<div class=\"quote\">\"$review\"</div>");
}

}

echo("<div id=\"users\">");
echo($fivestars[array_rand($fivestars)]);
 echo("</div>");
?>
<!--
  <div id="nook"><a
  href="http://www.barnesandnoble.com/c/technicat%2c-llc"
  target="_new"><img
  src="https://nookdeveloper.barnesandnoble.com/tools/dev/badge/2940043856555"
  width="120" height="40" /></a>
  </div>

	<div id="android">
	  <a
	  href="https://market.android.com/developer?pub=Technicat,+LLC"><img
	  src="android_app_on_play_logo_small.png" alt="Android Market"/></a>
	  </div>

	  <div id="amazon">
	    	  <a
	  href="http://www.amazon.com/s/ref=bl_sr_mobile-apps?_encoding=UTF8&node=2350149011&field-brandtextbin=Technicat%2C%20LLC"><img
	  src="amazon-icon-final-114px.png" width="52" height="52" alt="Amazon Appstore"/></a>
	    </div>

	    <div id="assetstore">
	      <a href="http://u3d.as/publisher/technicat-llc/1JM"
	      ><img src="http://fugugames.com/assetstore.png"
	      width="88" height="40"/></a>
	      </div>
	-->    
<div id="reviews">
 <a
  href="http://smartappdevelopers.com/2010/10/17/iphone-application-review-fugu-maze/">SmartApp
  Developers</a>
  <div class="quote">
  "Challenging. Really creates the feeling of being lost in a maze. Fugu Maze
  is an interesting and intense application for the iPhone."
    </div>
  <br/>
  <a
  href="http://www.1888freeonlinegames.com/iphonegames/free-fugu-bowl-8241.html">AppGames</a>
    <div class="quote">
  "The Fugu Bowl is a great and unique arcade styled puzzle game for
 your iPhone and iPod touch."
      </div>
<br/>
  <a
 href="http://itunes.apple.com/us/app/hyperbowl/id344209253?mt=8">HyperBowl</a>
 is one of MacLife's
 <br>
 <a href="http://www.maclife.com/article/feature/100_greatest_iphone_apps_2009?page=0%2C2">100
 Greatest iPhone Apps of 2009</a>
</div>
<!-- AppStoreHQ:developer_claim_code:bdb4f185ef1824bdf15126a8bcbd484a2f5eafac --> 

<div id="hyperbowl">
<a href="http://www.hyperbowl3d.com/">
<img src="http://hyperbowl3d.com/hyperbowl-logo-banner-scaled110x159.png" title="HyperBowl web
site" alt="HyperBowl web site"/>
</a>
</div>

	<div id="facebook">
	  <a href="http://www.facebook.com/fugugames"
	  target="_TOP" title="Fugu Games"><img
	  src="http://badge.facebook.com/badge/107276163331.1698.289464401.png"
	  style="border: 0px;" /></a>
	</div>



</body>
</html>