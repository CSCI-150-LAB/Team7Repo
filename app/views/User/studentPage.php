<?php
session_start();
 //Student information needs to be passed after registration and login page 
 //Not sure if this is correct 
   $profileFirstName = $_POST['first'];
   $profileLastName = $_POST['last'];
   $profileID = $_POST['id'];

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
    <?php echo 'Hello' + $profileFirstName + $profileLastName?>; <!--Output Student first and last name -->

    <br>
    <h2>Preferred Learning Styles</h2>
    <input type="radio" name="style" value="visual">
    <label for="visual">Visual</label>
    <input type="radio" name="style" value="audio">
    <label for="audio">Audio</label>
    <input type="radio" name="style" value="kinesthetic">
    <label for="kinesthetic">Kinesthetic</label>
    <input type="radio" name="style" value="reading/writing">
    <label for="reading/writing">Reading/Writing</label>


</body>
</html>