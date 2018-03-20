<!DOCTYPE html>

<?php session_start(); ?>

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

        $error = "";
        $success = "";

        if ($_POST) {

            $link = mysqli_connect("localhost", "cl59-diary", "nXhHC3B/c", "cl59-diary");
            $email = $_POST["submit_email"];
            $safe_email = mysqli_real_escape_string($link, $email);
            $password = $_POST["submit_password"];
            $safe_password = mysqli_real_escape_string($link, $password);

            if (isset ($_POST["stay_signed_in"])) {

                setcookie("email_cookie", $safe_email, time() + 60 * 60 * 24);
                setcookie("password_cookie", $safe_password, time() + 60 * 60 * 24);

            } else {

                setcookie("email_cookie", '', time() - 3600);
                setcookie("password_cookie",'', time() - 3600);

            };

            //Sign-up Form

            if (isset ($_POST["signup_button"])) {

                if ($email == null) {

                    $error .= "The email field is empty. <br />";

                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $error .= "The email address is considered invalid.";

                };

                if ($password == null) {

                    $error .= "The password field is empty. <br />";

                };

                if ($error != null) {

                    $error = '<div class="alert alert-danger" role="alert">The following errors are present in your Sign-Up form: <br /><br />' . $error . '</div>';

                } else {

                    if(mysqli_connect_error()) {

                        die ("Could not connect to database");

                    } else {

                        $email_check = "SELECT * FROM users WHERE `email` = '" . $safe_email . "'";

                        $result = mysqli_query($link, $email_check);

                        if (mysqli_num_rows($result) > 0) {

                            $error = '<div class="alert alert-danger" role="alert">The email, ' . $email .  ', is already in use. <strong class="switch to_login">Login</strong> instead!</div>';

                        } else {

                            //Inserting new email into database

                            $insert_email = "INSERT INTO `users` (`email`) VALUES ('" . $safe_email . "')";

                            mysqli_query($link, $insert_email);

                            //Getting id from email

                            $select_id = "SELECT `id` FROM `users` WHERE email = '" . $safe_email . "'";

                            $get_id = mysqli_fetch_array(mysqli_query($link, $select_id));

                            echo $id = $get_id["id"];

                            //Using the id to help secure the password

                            $salt="N:U6+Yb9%?8s@+>2@@rq(+5|#g9GM%6;Ec@1Pk>;UptU#] 8S!ES9vqJaM7ZvUdt";
                            $secure_password = md5(md5($id . $salt) . $safe_password);

                            //Saving the Secured password into the database

                            $insert_password = "UPDATE `users` SET password = '" . $secure_password . "' WHERE id = " . $id . " AND email = '" . $safe_email . "'";

                            if(mysqli_query($link, $insert_password)) {

                                $success = '<div class="alert alert-success" role="alert">You have successfully signed up!</div>';

                            } else {

                                $error = '<div class="alert alert-danger" role="alert">We could not sign you up at this time. Please try again later!</div>';

                            };

                        };

                    };

                };

            }

            //Login Form

            else if (isset ($_POST["login_button"])) {

                if ($email == null) {

                    $error .= "The email field is empty. <br />";

                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $error .= "The email address is considered invalid.";

                };

                if ($password == null) {

                    $error .= "The password field is empty. <br />";

                };

                if ($error != null) {

                    $error = '<div class="alert alert-danger" role="alert">The following errors are present in your Login form: <br /><br />' . $error . '</div>';;

                } else {

                    if(mysqli_connect_error()) {

                        die ("Could not connect to database");

                    } else {

                        //Getting id from email

                        $select_id = "SELECT `id` FROM `users` WHERE email = '" . $safe_email . "'";

                        $get_id = mysqli_fetch_array(mysqli_query($link, $select_id));

                        echo $id = $get_id["id"];

                        //Using the id to help secure the password

                        $salt="N:U6+Yb9%?8s@+>2@@rq(+5|#g9GM%6;Ec@1Pk>;UptU#] 8S!ES9vqJaM7ZvUdt";
                        $secure_password = md5(md5($id . $salt) . $safe_password);

                        $email_check = "SELECT email FROM `users` WHERE email = '" . $safe_email . "'";
                        $user_check = "SELECT * FROM `users` WHERE email = '" . $safe_email. "' AND password = '" . $secure_password . "'";

                        $email_result = mysqli_query($link, $email_check);
                        $user_result = mysqli_query($link, $user_check);

                        if (mysqli_num_rows($email_result) == 0) {

                            $error = '<div class="alert alert-danger" role="alert">The email, ' . $email . ', does not exist in the system. Why not <strong class="switch to_signup">Sign up</strong>?</div>';

                        } else if (mysqli_num_rows($user_result) > 0 ) {

                            $_SESSION["email"] = $email;
                            $_SESSION["id"] = $id;
                            header ("Location: login.php");

                        } else {

                            $error = '<div class="alert alert-danger" role="alert">The password is incorrect!</div>';

                        };

                    };

                };

            };

        };


        ?>

        <div class="container">

            <div id="box">

                <h1>Secret Diary</h1>

                <p class="signup"><strong>Hide it here! Sign up below!</strong></p>

                <p class="login"><strong>Here to write some more? Login below!</strong></p>

                <form name="form" method="post">

                    <div class="form-group">

                        <input type="email" class="form-control" name="submit_email" placeholder="Email" value='<?php if(isset ($_COOKIE["email_cookie"])) { echo ($_COOKIE["email_cookie"]); } else { echo (""); }; ?>'>

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="submit_password" placeholder="Password" value='<?php if(isset ($_COOKIE["password_cookie"])) { echo ($_COOKIE["password_cookie"]); } else { echo (""); }; ?>'>

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

                <div><?php echo $error; echo $success;?></div>

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
