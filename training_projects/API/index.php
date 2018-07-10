

<!doctype html>

<html>

<html lang="en">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108066932-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-108066932-1');
    </script>

    <title>API Project - Twitter Feed</title>

  <!-- START of Training Return Button CSS-->

    <!-- Raleway Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,700,400italic' rel='stylesheet' type='text/css'>
    <!-- jQuery Stylesheet -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../training_button-min.css">

  <!-- END of Training Return Button CSS-->

</head>

<body>

    <!-- START of Training Return Button HTML-->

		<a href="../../index.html#projects" id="training_button" name="training_button">
			<div>
              <p>Click here to return</p>
              <img src="../../images/landing_logo.png" alt="Dean Webb Developer">
			</div>
		</a>

    <!-- END of Training Return Button HTML-->

    <?php

    require "twitteroauth/autoload.php";

    use Abraham\TwitterOAuth\TwitterOAuth;

    $consumer_key         = "1aJM7MpTDePN8U1CvyslP3lto";
    $consumer_secret      = "Insert Consumer Secret Key, available at apps.twitter.com";
    $access_token         = "732875185783746560-ewCzfOio1P12nOClbwttshOka418FMi";
    $access_token_secret  = "Insert Access Token Secret Key, available at apps.twitter.com";

    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
    $content = $connection->get("account/verify_credentials");

    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

    //foreach($statuses as $tweet) {
    //  if($tweet->favorite_count >= 100) {
    //      echo("<p>" . $value->text . "</p>");
    //  };
    //};

    //Based on after watching lecture, way of displaying tweets

    foreach($statuses as $tweet) {
      if($tweet->favorite_count >= 100) {
          $status = $connection->get("statuses/oembed", ["id" => $tweet->id]);
          echo($status->html);
      };
    };

    ?>

    <!-- START of Training Return Button JS-->

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <!-- jQuery UI -->
      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
      <!-- Main Script -->
      <script src="../training_button-min.js"></script>

    <!-- END of Training Return Button JS-->

</body>

</html>
