<!DOCTYPE html>

<?php session_start() ?>

<html>

    <head>

        <title>Secret Diary</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <style type="text/css">

            body {

                background: url(images/background.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;

            }

            h1 {

                padding: 100px 0px 20px 0px;
                text-align: center;

            }

            p {

                text-align: center;

            }

            form {

                text-align: center;

            }

            button {

                margin: 15px 0px;

            }

            .signup {

                display:none;

            }

            .switch {

                color: #0275d8;

            }

            .switch:hover {

                color: #014C8C;
                text-decoration: underline;
                cursor: pointer;

            }

            #box {

                width: 60%;
                margin: auto;

            }

        </style>

    </head>

    <body>

        <?php

          if (array_key_exists('submit_email', $_POST) OR array_key_exists('submit_password', $_POST)) {

              $error = "";
              $alert;

              if ($_POST["submit_email"] && filter_var($_POST["submit_email"], FILTER_VALIDATE_EMAIL) === false) {

                  $error .= ("The email address provided is in an invalid format. <br/>");

              }

              if ($_POST["submit_email"] == null) {

                  $error .= ("You have not input an email. <br/>");

              }

              if ($_POST["submit_password"] == null) {

                  $error .= ("You have not input a password. <br/>");

              }

              if ($error != "") {

                  $alert = $error;

                } else {

                  $link = mysqli_connect("shareddb1a.hosting.stackcp.net", "cl59-diary", "nXhHC3B/c", "cl59-diary");
                  $email = mysqli_real_escape_string($link, $_POST["submit_email"]);
                  $password = mysqli_real_escape_string($link, $_POST["submit_password"]);

                  if (mysqli_connect_error($link)) {

                    die ("Could not connect to database at this time.");

                  } else {

                    $query = "SELECT `password` FROM `users` WHERE `email` = '" . $email . "'";

                    $result = mysqli_query($link, $query);

                    echo $row = mysqli_fetch_array($result);

                  };

                };

              };

            /*if($_POST) {

              $link = mysqli_connect("shareddb1a.hosting.stackcp.net", "cl59-users-ato", "d!CrF.cyx", "cl59-users-ato");

              if(mysqli_connect_error($link)) {

                die ("Server could not be found");

              } else {

                $email = mysqli_real_escape_string($_POST[submit_email]);
                $password = mysqli_real_escape_string($_POST[submit_password]);

                $error = "";

                if ($email == null ) {

                  $error .= "You have not provided an email.";

                };

                if ($password == null) {

                  $error .= "You have not provided a password.";

                };

              };

              //$query =

              //$row =

            };*/

        ?>

        <div class="container">

            <div id="box">

                <h1>Secret Diary</h1>

                <p class="signup"><strong>Hide it here! Sign up below!</strong></p>

                <p class="login"><strong>Here to write some more? Login below!</strong></p>

                <form name="form" method="post">

                    <div class="form-group">

                        <input type="text" class="form-control" name="submit_email" placeholder="Email" value=''>

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="submit_password" placeholder="Password" value=''>

                    </div>

                    <div class="form-check">

                        <label class="form-check-label">

                            <input type="checkbox" class="form-check-input" name="stay_signed_in" checked>
                            Save my details

                        </label>

                    </div>

                    <button type="submit" class="btn btn-primary signup" name="signup_button">Sign up</button>

                    <p class="signup">Already have an account with us? Why not <span class="switch to_login">Login</span> instead?</p>

                    <button type="submit" class="btn btn-success login" name="login_button">Login</button>

                    <p class="login">New here? <span class="switch to_signup">Click here to Sign up!</span></p>

                </form>

                <div><?php echo($alert); ?></div>

            </div>

        </div>

        <script type="text/javascript">

            $(".to_login").click(function() {

                $(".login").show();
                $(".signup").hide();

            });

            $(".to_signup").click(function() {

                $(".login").hide();
                $(".signup").show();

            });

        </script>

    </body>

</html>
