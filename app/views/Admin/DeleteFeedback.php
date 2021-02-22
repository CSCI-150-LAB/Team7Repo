<?php

$rating = $_GET['ratingId']; // get id through query string


$db = $this->get('Db');
/** @var array[] */
$del = $db->query( 
    "
    SELECT * FROM users
    
    "
);

if ($useraccounts === false) {
    die($db->getLastError());
}
$del = mysqli_query($db,"delete from tblemp where id = '$rating");

if($del)
{
    $accounts = array_map(['User', 'fromArray'], $accounts);

    header("/Instructor/ViewReviews/{$account->id}"); // redirects to feedback page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not deleted
}
?>