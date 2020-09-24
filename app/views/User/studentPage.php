<?php
    //Needs info from registration page 
    require 'RegistrationPage.PHP';
    
    //Connecting to database 
    $serverName = "fsu.dandi.dev";                                                                                                 
    $serverUser = "fluser2020";                                                                                                       
    $serverPass = "Qd7Qbb2LgQ";                                                                                                           
    $dbName = "feedbackloop";
    $conn = new mysqli($serverName, $serverUser, $serverPass, $dbName);

    //Checking to make sure connection was successful to database 
    if($conn->connect_error)
    {
        echo 'Connection error' . $conn->connect_error;
    }

    //Needs to check if user clicked submitted after registering their credentials 
    if(isset($_POST['submit']))
    {
        //Needs to check if the user clicked student as a role
        $userRole = $_POST['role'];

        //If user is a student then register and assign their credentials for database 
        if($userRole == "student")
        {
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
            $useremail = $_POST['email'];
            $userPassword = $_POST['pass'];
            $userId = $_POST['id'];
        }

        //Binding new student parameters into database 
        $sql = "INSERT INTO users (id, email, first_name, last_name password, type) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

                if(!mysqli_prepare($stmt, $sql))
                {
                    echo 'Error';
                    exit();
                }
                else 
                {
                    mysqli_stmt_bind_param($stmt, "isssss", $userId, $useremail, $firstName, $lastName, $userPassword, $userRole); //May need to revise because of issss? 
                }

        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Page </title>
</head>
<body>
    <h1>You are in the student profile</h1>
</body>
</html>