<!DOCTYPE html>

<?php

    session_start();

    $email = $_SESSION["email"];
    $id = $_SESSION["id"];
    $success = "";
    $error = "";
    $past_entries = "";
    $link = mysqli_connect("localhost", "cl59-diary", "nXhHC3B/c", "cl59-diary");

?>

<html>

    <head>

        <title>Secret Diary</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <style>

            body {

                background: url(images/background.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center top;
                background-attachment: fixed;

            }

            h6 {

                margin: 30px 0px;

            }

            #diary_text {

                width: 100%;
                margin-bottom: 10px;
            }

            .logout_button {

                float: right;

            }

            .box {

                width: 80%;
                margin: auto;

            }

            .alert {

                margin-top: 15px;

            }

            .alert-success {

              text-align: center;

            }

            .alert-danger {

              text-align: center;

            }

            h5 {

              text-align: center;

            }


        </style>

    </head>

    <body>

        <?php

            //Previous Entries

            if (isset ($_POST["previous"])) {

                if (mysqli_connect_error()) {

                    die ("Could not connect to database");

                } else {

                    $complete_list = "";

                    $previous_entry_query = "SELECT * FROM `diary` WHERE id = '" . $id . "'"; //gets all previous entries

                    $previous_fetched = mysqli_query($link, $previous_entry_query);

                    $previous_entry = mysqli_fetch_all($previous_fetched); //makes entries into array

                    $reversed_entry = array_reverse($previous_entry); //reverses array so most recent comes first

                    foreach ($reversed_entry as $row) {

                        $string_replacement = str_replace(str_split(" :"),"-",$row[2]); //used to make for unique ids, so modals are all unique. without every modal is most recent modal

                        $complete_list .= '<div data-toggle="modal" data-target="#' . $string_replacement . '-modal"><strong>' . $row[2] .
                                          '</strong> &nbsp;&nbsp;&nbsp;' . substr($row[1], 0, 80) . '<br /></div>' .
                                          '<div class="modal fade" id="' . $string_replacement . '-modal" tabindex="-1" role="dialog" aria-labelledby="' . $string_replacement . '-modal-title" aria-hidden="true">

                                              <div class="modal-dialog" role="document">

                                                  <div class="modal-content">

                                                      <div class="modal-header">

                                                          <h5 class="modal-title" id="' . $string_replacement . '-modal-title">' . $row[2] . '</h5>

                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                                  <span aria-hidden="true">&times;</span>

                                                              </button>

                                                      </div>

                                                      <div class="modal-body">'
                                                      . $row[1] .
                                                      '</div>

                                                      <div class="modal-footer">

                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                      </div>

                                                  </div>

                                              </div>

                                          </div>';

                                          //fix this so that when you click each one, a different modal
                                          //showing the correct entry and title (date) shows

                                          //also work on css so when you hover over an entry, it bolds out
                                          //or something like that

                                          //also put the logout option in, but not in this section.
                                          //will have own section like 'previous' and 'save have'

                    };

                    if ($complete_list == "") {

                        $past_entries = '<div class="alert alert-info" role="alert">You have no previous diary entries. Why not write one above?</div>';

                    } else {

                        $past_entries = '<div class="alert alert-info" role="alert"> <h5> Your previous entries <small>(Click one to view it!)</small> :</h5> '. $complete_list . '</div>';

                    };

                };

            };

            //Save Entry

            if (isset ($_POST["save"])) {

                if (mysqli_connect_error()) {

                    die ("Could not connect to database");

                } else {

                    $entry = $_POST["diary_text"];
                    $safe_entry = mysqli_real_escape_string($link, $entry);

                    $save_entry_query = "INSERT INTO `diary`(id, entry, date) VALUES ('" . $id . "', '" . $safe_entry . "', NOW())";

                    if (mysqli_query($link, $save_entry_query)) {

                        $success = '<div class="alert alert-success" role="alert">'. date("Y-m-d h:i:sa") . ': Your entry has been saved!</div>';

                    } else {

                        $error = '<div class="alert alert-danger" role="alert">Your entry could not be saved at this time. Please try again later!</div>';

                    };

                };

            };

            //Logout

            if (isset ($_POST["logout"])) {

                session_destroy();   // function that Destroys Session
                header("Location: index.php");

            };

        ?>

        <div class="container">

            <div class="box">

                <h6>Welcome, <?php echo $email ?>! Write your thoughts!</h6>

                <form method="post">

                    <textarea id="diary_text" name="diary_text" rows=10 placeholder="Type your thoughts here!"></textarea>

                    <br />

                    <button type="submit" class="btn btn-info diary_button" name="previous">View previous Entries</button>
                    <button type="submit" class="btn btn-success diary_button" name="save">Save</button>
                    <button type="submit" class="btn btn-danger logout_button" name="logout">Logout</button>

                </form>

                <div><?php echo $error; echo $success; echo $past_entries; ?></div>

            </div>

        </div>

    </body>

</html>
