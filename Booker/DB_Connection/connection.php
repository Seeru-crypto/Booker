<?php
$client = new MongoDB\Client(
    'mongodb+srv://user_1:FlqgvzmIGelTQNXW@cluster-0.6xcy9.mongodb.net/listingsAndReviews?retryWrites=true&w=majority');

$db = $client->test;
?>



//Replace <password> with the password for the user_1 user. 
//Replace <dbname> with the name of the database that connections will use by default.
// Ensure any option params are URL encoded.
