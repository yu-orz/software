<?php
require_once("./twitteroauth/twitteroauth.php");
$consumer_key = "";
$consumer_secret = "";
$access_token = "";
$access_token_secret = "";

$to = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

$name = $argv[1];

if ( $name == "" ){
  print "Syntax Error\n";
  exit;
}
$i=1;
$cursor = -1;
while($cursor!=0){
  $req = $to->OAuthRequest("http://api.twitter.com/1/statuses/user_timeline.xml?id="."$name","GET",array("cursor" => (string)$cursor));

  $xml = simplexml_load_string($req);
  //var_dump($xml);
  print "ID: ".$xml->status->user->id."\n";
  print "ScreenName: ".$xml->status->user->screen_name."\n";
  print "Name: ".$xml->status->user->name."\n";
  print "Follow: ".$xml->status->user->friends_count."\n";
  print "Follower: ".$xml->status->user->followers_count."\n";
  print "Tweet: ".$xml->status->user->statuses_count."\n";
  $cursor = $xml->next_cursor;
}
?>
