<?php

  session_start();

  if (isset($_POST)) {

    $error = "";
    $alert = "";

    if(array_key_exists("submit_email",$_POST) OR array_key_exists("submit_password", $_POST)) {

      //Validating input values email & password

      $email = $_POST["submit_email"];
      $pass = $_POST["submit_password"];

      if(!isset($email) OR $email == null) {

        $error .= "You have not entered an email <br />";

      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error .= "The format you have entered for you email is invalid <br />";

      };

      if(!isset($pass) OR $pass == null) {

        $error .= "You have not entered a password <br />";

      };

      if($error != "" OR $error != null) {

        $alert = "<span class ='error'>The following errors are present above: <br />" . $error . "Please fix these and try again.</span>";

      } else {

        $link =		mysqli_connect("shareddb1a.hosting.stackcp.net", "cl59-diary", "nXhHC3B/c", "cl59-diary");		//enter db details
        $email =	mysqli_real_escape_string($link, $email);
        $pass =		mysqli_real_escape_string($link, $pass);

        if(mysqli_connect_error()) {

          die("Could not connect to server");

        } else {

          if (isset ($_POST["stay_signed_in"])) {

              setcookie("email_cook", $email, time() + 60 * 60 * 24 * 365);

          } else {

              setcookie("email_cook", '', time() - 3600);

          };

          if(isset($_POST["signup_button"])) {

            $query = "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'";

            $result = mysqli_query($link, $query);

            if(mysqli_num_rows($result) > 0) {

              $alert = "There is already an account with this email. Login instead!";

            } else {

              $query = "INSERT INTO `users` (`email`, `password`) VALUES ('" . $email . "', '" . password_hash($pass, PASSWORD_DEFAULT) . "')";

              if(mysqli_query($link, $query)) {

                $alert = "<span class='success'>You have successfully signed up, try logging in now!</span>";

              } else {

                $alert = "<span class='error'>We could not sign you up at this time. Please try again later.</span>";

              };

            };

          } else if (isset($_POST["login_button"])) {

            $query = "SELECT `id`, `email`, `password` FROM `users` WHERE `email` = '" . $email . "'";

            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_array($result);

            if (password_verify($pass, $row["password"])) {

              $_SESSION["email"] = $row["email"];
              $_SESSION["id"] = $row["id"];
              header("Location: login.php");

            } else {

              $alert = "<span class='error'>The login details you have provided are incorrect. Please try again. <span class='switch to_signup'>If you have not got an account, click here to Sign up!</span></span>";

            };

          };

        };

      };

    };

  };

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108066932-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-108066932-1');
        </script>

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

        <div class="container">

            <div id="box">

                <h1>Secret Diary</h1>

                <p class="signup"><strong>Hide it here! Sign up below!</strong></p>

                <p class="login"><strong>Here to write some more? Login below!</strong></p>

                <form name="form" method="post">

                    <div class="form-group">

                        <input type="email" class="form-control" name="submit_email" placeholder="Email" value='<?php if(isset ($_COOKIE["email_cook"])) { echo ($_COOKIE["email_cook"]); } else { echo (""); }; ?>' required>

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="submit_password" placeholder="Password" required>

                    </div>

                    <div class="form-check">

                        <label class="form-check-label">

                            <input type="checkbox" class="form-check-input" name="stay_signed_in" checked>
                            Save my email

                        </label>

                    </div>

                    <button type="submit" class="btn btn-primary signup" name="signup_button">Sign up</button>

                    <p class="signup">Already have an account with us? Why not <span class="switch to_login">Login</span> instead?</p>

                    <button type="submit" class="btn btn-success login" name="login_button">Login</button>

                    <p class="login">New here? <span class="switch to_signup">Click here to Sign up!</span></p>

                </form>

                <div><?php echo $alert; ?></div>

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
