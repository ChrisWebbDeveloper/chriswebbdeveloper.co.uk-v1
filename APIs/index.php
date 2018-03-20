<!DOCTYPE html>

<html>

<head>

    <title>Mini Challenge: Postcode Finder</title>

    <!--Bootstrap 4 CSS-->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!--My CSS-->

        <style type="text/css">

            body {

                text-align: center;
                background: url("background.jpg") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;

            }

            .container {

                padding-top: 120px;

            }

            h1 {

                margin: 40px;
                color: white;

            }

            input {

                width: 60%;
                margin: 40px;

            }

            .alert {

                margin: 20px auto;

            }

            #postcode {

                width: 240px;
            }

            #error {

                width: 400px;

            }

        </style>

</head>

<body>

    <div class="container">

        <h1>Postcode Generator</h1>

        <input type="text" placeholder ="Type the address (or part of) here..." name="address" id="address"></input>

        <br />

        <button type="button" class="btn btn-primary" name="submit" id="submit">Find My Postcode</button>

        <br />

    </div>

    <!--Bootstrap 4 JS, Goes at bottom of body-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <!--AJAX-based jquery for Google API Geocoding JSON-->

        <script type="text/javascript">

            /*AJAX to link to Google Geocode*/

                $.ajax({

                    url : "https://maps.googleapis.com/maps/api/geocode/json?address=11+The+Ropewalk&key=AIzaSyAWgiGduT5GZvSRGwpRkwU-CnUUreU85v0",
                    type: "GET",
                    success: function (data) {

                        $.each(data["results"][0]["address_components"], function(key, value) {

                            /*If there is a post code detected in the array, run and echo file get contents of url in php to see this*/

                                    if (value["types"][0] == ["postal_code"]) {

                                        var postcode_div = '<div class="alert alert-success" role="alert" name="postcode" id="postcode">Postcode: <strong>' + value['short_name'] + '</strong></div>'

                                        $('.container').append(postcode_div);

                                    } else {

                                        var error_div = '<div class="alert alert-danger" role="alert" name="error" id="error">Postcode could not be found. Please try again!</div>';

                                        $('.container').append(error_div);

                                    };

                        });

                    }

                });

        </script>

</body>

</html>

<?php

    echo file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=Room+26+11+The+Ropewalk&key=AIzaSyAWgiGduT5GZvSRGwpRkwU-CnUUreU85v0");

?>
