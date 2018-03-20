<!doctype html>

<html>

<head>

    <title>PHP Project - Weather Scraper</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>
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

    <?php



        $error = "";
        $success = "";

        if($_POST) {

            $city = $_POST["city"]; //this finds the inputted city

            $city2 = $city; //to allow for posting city name in success box

            if (strpos($city2, " ") == true) {

                $city2 = str_replace(" ", "-", $city); //changes " " into "-" to navigate and link to correct webpage//

            };

            $url = 'http://www.weather-forecast.com/locations/' . $city2 . '/forecasts/latest'; //links to relevant webpage of city

            $file_headers = @get_headers($url);

            if (!$_POST["city"]) { //checks if a city has been entered

                $error = 'You have not typed in a city!';

            } elseif (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') { //if an incorrect city has been entered, page auto 404s. this checks if it has 404'd

                $error = 'The city you have typed in could not be found! You searched for: ' . $city;

            };

            if ($error != "") {

                $error = '<div id="error" class="alert alert-danger">' . $error . '</div>'; //no city or a 404 will post an error. if there is an error, a message is displayed and further action is stopped

            } else {

              $output = file_get_contents($url); //if no error, then the website is scraped

              preg_match_all('!3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.+?)</span>!', $output, $here); //search for the specific text, and output results

                  for ($i=0; $i<count($here[0]); $i++) { //as output is array, this makes it readable

                      $success = '<div id="success" class="alert alert-success"><strong>' . ucwords($city) . ':</strong> '. $here[1][$i] . '</div>'; //success output in box, whilst including name of city in upper case if not typed as such

                  };

            };

        };

    ?>

    <div class="container">

        <h1>What's the Weather?</h1>

        <p>Enter the name of a city.</p>

        <br />

        <form method="post">

            <div class="form-group">

                <input class="form-control input-lg" id="city" name="city" type="text" placeholder="Type in your city here. Eg, 'London'">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    <br />

    <div id="alert_box" name="alert_box"><?php echo $error; echo $success; ?></div>

    </div>

</body>

</html>
