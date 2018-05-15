<?php

    $weather = "";
    $error = "";

    if ($_GET['city']) {

      $url = "http://api.openweathermap.org/data/2.5/weather?q=" . rawurlencode($_GET['city']) . "&appid=c320f38054db9fff28682e0ceb376e59";

      //print_r($url);

      $urlContents =  file_get_contents($url);

      //print_r($urlContents);

      $weatherArray = json_decode($urlContents, true);

      //print_r($weatherArray);

      if($weatherArray["cod"] == "200") {

        $weather = "<div id='success' class='alert alert-success'>The weather in <strong>" . $_GET['city'] . "</strong> is currently <strong>'" . $weatherArray['weather'][0]['description'] . "'</strong>.";

        $tempInCelcius = $weatherArray['main']['temp'] - 273;

        $weather .= " The temperature is <strong>" . round($tempInCelcius) . "&deg;C</strong> and the wind speed is <strong>" . $weatherArray['wind']['speed'] . "m/s<strong>.</div>";

      } else {

        $error = "<div id='danger' class='alert alert-danger'>The city you have entered could not be found, please try again.</div>";

      };

    };

?>

<!doctype html>

<html>

<head>

    <title>PHP Project - Weather Scraper</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css" integrity="sha256-y4TDcAD4/j5o4keZvggf698Cr9Oc7JZ+gGMax23qmVA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js" integrity="sha256-m2ByX2d6bw2LPNGOjjELQGPrn6XyouMV9RuVzKhJ5hA=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

    <style>

        body {

            background: url(images/background.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center top;
            background-attachment: fixed;
        }

        .container {

            text-align: center;
            padding-top: 100px;

        }

    </style>

    <!--<script>

    $(document).ready(function() {

        $("form").submit(function(event) {

                var error = "";

            if($("#city").val() == "") {

                error += "You have not typed in a city!";

            };

            if (error != "") {

                $("#alert_box").html('<div id="error" class="alert alert-danger">' + error + '</div>');

                return false;

            } else {

                return true;

            };

        });

    });


  </script>-->

</head>

<body>

    <div class="container">

        <h1>What's the Weather?</h1>

        <p>Enter the name of a city.</p>

        <br />

        <form method="get">

            <div class="form-group">

                <input class="form-control input-lg" id="city" name="city" type="text" placeholder="Type in your city here. Eg, 'London'">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    <br />

    <div id="alert_box" name="alert_box"><?php echo $error; echo $weather; ?></div>

    </div>

</body>

</html>
