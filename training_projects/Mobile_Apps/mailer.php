<?php

  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //set variables to post data
    $sender     = "From: " . $_POST["sender"];
    $recipient  = $_POST["recipient"];
    $subject    = $_POST["subject"];
    $message    = $_POST["message"];

    if(mail($recipient, $subject, $message, $sender)) {
      if (http_response_code(200)) {
        return("Email successfully sent!");
      } else {
        return("Error - Email could not be sent. Please try again later!");
      };
    };

  };

?>
