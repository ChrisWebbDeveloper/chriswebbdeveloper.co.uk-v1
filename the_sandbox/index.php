<?php

    $salt = "djhsdbjhsdbjh37978qw3y98dq90";

    $row['id'] = 73;

    //echo md5(md5($row['id'])."password");

    //md5 is not secure, it is much better to use bcrypt. PHP >= 5.5 has this built-in, so look into using this instead

    echo password_hash('password', PASSWORD_DEFAULT);

    $hash = "$2y$10$ND.K4MKescwMgu2GbkQbgO5mDCSV5aAfmMHJ9Ns6AKQvuvrIVNxXO";

    /*if (password_verify('password', $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }*/

    //Look into bcrypt before moving on//

?>
