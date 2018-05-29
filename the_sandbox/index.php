<?php

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$consumer_key         = "1aJM7MpTDePN8U1CvyslP3lto";
$consumer_secret      = "Insert Consumer Secret Key, available at apps.twitter.com";
$access_token         = "732875185783746560-ewCzfOio1P12nOClbwttshOka418FMi";
$access_token_secret  = "Insert Access Token Secret Key, available at apps.twitter.com";

$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

$statues = $connection->post("statuses/update", ["status" => "If this is available, it was posted from the Twitter API, available at deanwebbdeveloper.com/the_sandbox"]);

$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

print_r($statuses);

?>
