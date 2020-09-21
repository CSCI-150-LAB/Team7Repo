<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>FeedbackLoop Registration</title>
    <style>
                                                                                                                                <!--Insert padding on the left hand margin -->
        form {
            padding-left: 50px;
        }

        h1 {
            padding-left: 50px;
        }

        h2 {
            padding-left: 50px;
        }

        p {
            padding-left: 50px;
        }
    </style>
</head>
<body>

    <?php

    $first = $last = $email = $pass = $id = $role = "";                                                                         // Initialize empty variables for different entries in DB

    $firstError = $lastError = $emailError = $passError = $idError = $roleError = "";                                           // Initialize empty variables for error messages
    // when invalid inputs are entered
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["first"])) {                                                                                               // Check if the user did not enter a first name
    $firstError = "Please enter your first name.";                                                                              // Prepare error message for this case
    }
    else {
    $first = clean_data($_POST["first"]);                                                                                       // Allow the first name variable to equal the user's input
    if (preg_match("/[^\w]/", $first) || preg_match("/[0-9]/", $first))  {                                                      // Check if any numbers or special characters are in the name
    $firstError = "Invalid character entered.";                                                                                 // Prepare error message for this case
    }
    }

    if (empty($_POST["last"])) {                                                                                                // Check if the user did not enter a last name
    $lastError = "Please enter your last name.";                                                                                // Prepare error message for this case
    }
    else {
    $last = clean_data($_POST["last"]);                                                                                         // Allow the last name variable to equal the user's input
    if (preg_match("/[^\w]/", $last) || preg_match("/[0-9]/", $last))  {                                                        // Check if any numbers or special characters are in the name
    $lastError = "Invalid character entered.";                                                                                  // Prepare error message for this case
    }
    }


    if (empty($_POST["email"])) {                                                                                               // Check if the user did not enter an email
    $emailError = "Please enter your school/work email.";                                                                       // Prepare error message for this case
    }
    else {
    $email = clean_data($_POST["email"]);                                                                                       // Allow the email variable to equal the user's input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))  {                                                                          // Check if the format of the email is email@example.com
    $emailError = "Invalid email format.";                                                                                      // Prepare error message if the above is false
    }
    elseif (!strpos($email, "mail.fresnostate.edu") == !strpos($email, "csufresno.edu")) {                                      // Check that the email is in the CSU Fresno domain
    $emailError = "Please enter your school/work email.";                                                                       // Prepare error message if the above is false
    }
    }

    if (empty($_POST["pass"])) {                                                                                                // Check if the user did not enter a password
    $passError = "Please enter a password.";                                                                                    // Prepare error message for this case
    }
    else {
    $pass = clean_data($_POST["pass"]);                                                                                         // Allow the password variable to equal the user's input

    $uppercase = preg_match("/[A-Z]/", $pass);                                                                                  // Check if the password has a capital letter in it
    $lowercase = preg_match("/[a-z]/", $pass);                                                                                  // Check if the password has a lowercase letter in it
    $numbers = preg_match("/[0-9]/", $pass);                                                                                    // Check if the password has a number in it
    $specChar = preg_match("/[^\w]/", $pass);                                                                                   // Check if the password has a special character in it

    if (!$uppercase || !$lowercase || !$numbers || !$specChar || (strlen($pass) < 8 || strlen($pass) > 16)) {                   // Check that the above four criteria are met with the
    $passError = "Make sure your password is between 8 - 16 characters and contains at LEAST <br>                               // addition of the length of the password needing to be
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp                                         // between 8 - 16 characters long
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp                                                                       // Prepare an error message if these criteria are not met
    one uppercase letter, one lower case letter, one number, and a special character.";
    }
    }

    if (empty($_POST["id"])) {                                                                                                  // Check if the user did not enter an ID
    $idError = "Please enter your ID.";                                                                                         // Prepare error message in this case
    }
    else {
    $id = clean_data($_POST["id"]);                                                                                             // Allow the ID variable to equal the user's input

    $uppercase = preg_match("/[A-Z]/", $id);                                                                                    // Check if any capital letters are in the ID
    $lowercase = preg_match("/[a-z]/", $id);                                                                                    // Check if any lowercase letters are in the ID
    $specChar = preg_match("/[^\w]/", $id);                                                                                     // Check if any special characters are in the ID

    if ($uppercase || $lowercase || $specChar) {                                                                                // If any of the above are true, issue an error
    $idError = "Invalid character in ID.";
    }
    }


    if (empty($_POST["role"])) {                                                                                                // Check if the user did not select a role
    $roleError = "Please select your role at your institution.";                                                                // Prepare error message in this case
    }
    else {
    $role = clean_data($_POST["role"]);                                                                                         // Allow the role variable to equal the user selection
    }

    }


    function clean_data($in) {                                                                                                  // Function designated to clean data
    $in = trim($in);                                                                                                            // Remove extra whitespace
    $in = stripslashes($in);                                                                                                    // Remove slashes so they may be used as delimiters
    $in = htmlspecialchars($in);                                                                                                // Convert all input to HTML characters
    return $in;                                                                                                                 // Return modified data

    }


    ?>

    <h1>FeedbackLoop</h1>
    <h2>Registration</h2>
    <p style="color:red">* All fields are required.</p>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <!--Initialize form-->
        First Name: <br>
        <input type="text" name="first">                                                                                        <!--Input for first name is text entry stored as 'first'-->
        <span style="color:red">* <?php echo $firstError; ?> </span>                                                            <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        Last Name: <br>
        <input type="text" name="last">                                                                                         <!--Input for last name is text entry stored as 'last'-->
        <span style="color:red">* <?php echo $lastError; ?> </span>                                                             <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        Email: <br>
        <input type="text" name="email">                                                                                        <!--Input for email is text entry stored as 'email'-->
        <span style="color:red">* <?php echo $emailError; ?> </span>                                                            <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        Password:<br>                                                                                                           <!--Input for password is of type password stored as 'pass'-->
        <input type="password" name="pass">                                                                                     <!--Type password allows for the password to be hidden-->
        <span style="color:red">* <?php echo $passError; ?> </span>                                                             <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        ID: <br>
        <input type="text" name="id">                                                                                           <!--Input for ID is text entry stored as 'id'-->
        <span style="color:red">* <?php echo $idError; ?> </span>                                                               <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        Role:                                                                                                                   <!--Input for role is a radio option stored as 'role'-->
        <input type="radio" name="role" value="student">Student                                                                 <!--The first option is to set the role value to 'student'-->
        <input type="radio" name="role" value="professor">Professor                                                             <!--The second option is to set the role value to 'professor'-->
        <input type="radio" name="role" value="admin">Admin                                                                     <!--The last option is to set the role value to 'admin'-->
        <span style="color:red">* <?php echo $roleError; ?> </span>                                                             <!--Output the appropriate error message (if there is one)-->
        <br>
        <br>
        <br>
        <input type="submit" name="submit" value="Submit">                                                                      <!--Create a submit button to complete the form-->
    </form>                                                                                                                     <!--End form-->
    <?php
    $serverName = "localhost";                                                                                                  // Variable for server name to pass to functions
    $serverUser = "root";                                                                                                       // Variable for username on server to pass to function
    $serverPass = "";                                                                                                           // Variable for password for server to pass to function
    $dbName = "FeedbackLoop";                                                                                                   // Variable for database name to pass to function

    if ($firstError == "" && $lastError == "" && $emailError == "" && $passError == "" && $idError == "" && $roleError == "") { // Check that there are no errors
    $connect = new mysqli($serverName, $serverUser, $serverPass, $dbName);                                                      // Begin connection to Database server

    if ($connect->connect_error) {                                                                                              // In the case of an error connecting
    die("Connection failed: " . $connect->connect_error);                                                                       // Issue statement on what the error is
    }

    $mysql = "INSERT INTO users (id, email, first_name, last_name, password, type)

    VALUES ('$_POST[id]', '$_POST[email]', '$_POST[first]', '$_POST[last]', '$_POST[pass]', '$_POST[role]') ";                  // Insert into these columns in the 'users' table
    // these values retrieved from the user entries
    if ($connect->query($mysql) == FALSE) {                                                                                     // Check for query/insertion error
    echo "Error: " . $mysql . "<br>" . $connect->error;                                                                         // If so, issue an error statement
    }

    $connect->close();                                                                                                          // Close server connection

    }

    ?>

</body>
</html>