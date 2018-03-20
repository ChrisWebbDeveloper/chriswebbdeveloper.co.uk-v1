<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $email = filter_var(trim($_POST["form_email"]), FILTER_SANITIZE_EMAIL);
        $name = strip_tags(trim($_POST["form_name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $subject = strip_tags(trim($_POST["form_subject"]));
				$subject = str_replace(array("\r","\n"),array(" "," "),$subject);
        $message = trim($_POST["form_message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Something went wrong! Try resubmitting the form or send it manually!";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "dean@deanwebbdeveloper.com";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent and you should receive confirmation email. I will get back to you ASAP!";
          
          	$sender_subject = "Your message, '" . $subject . "', has been received.";
          	$sender_content = "Dear " . $name . ", \n\n Thank you for your email. I will respond as soon as possible. \n\n\n Your message:\n\n '" . $message . "'\n\n\n Thank you, \n Dean Webb Developer\n\n P.S. This is an automated response. However, if you wish to contact me, feel free to reply to this email.";
          	$sender_headers = "From: Dean Webb Developer <dean@deanwebbdeveloper.com>";
          	mail($email, $sender_subject, $sender_content, $sender_headers);
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Something went wrong! Try resubmitting the form or send it manually!";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again!";
    }

?>