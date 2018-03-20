<!doctype html>

<html>

<head>

    <title>PHP Project - Weather Scraper</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

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

</head>

<body>

    <?php

        $error = "";
        $success = "";

        ($_POST["city"]); //this finds the inputted city//

        /*looked up scrapers, you'll need this to scrape the weather-forecast site
        the inputted city will be added to the url and searched using the file_get_contents
        that's open in tabs. it should search for the error message if incorrectly inputted.
        if it is, generate error mmessage as used in mini project. if fine, scrape the data
        and output in a success error box.

        the alert box uses error and succes same as mini project. simple compy/paste job */

    ?>

    <div class="container">

        <h1>What's the Weather?</h1>

        <p>Enter the name of a city.</p>

        <br />

        <form method="post">

            <div class="form-group">

                <input class="form-control input-lg" id="city" name="city" type="text" placeholder="London, England">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

    <div id="alert_box" name="alert_box"><?php echo $error; echo $success; ?></div>

</body>

</html>
