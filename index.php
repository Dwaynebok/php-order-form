<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products =  [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products2 =  [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

/*
$email = ($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
} else {
    echo "Email address '$email' is considered invalid.";
}
*/

//created a validation for the email using the code below
$email = ($_POST["email"]);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$email' is considered valid.";

} else {
    echo "Email address '$email' is considered invalid.";
}

$emailErr = "";
$streetErr = "";
$zipCodeErr = "";
$cityErr = "";
$streetNumberErr = "";

$zipcode = "";
$city = "";
$street = "";
$streetNumber = "";
$email = "";

if (empty($_POST["email"])) {
    $emailErr = "Email is required";
} else {
    $email = ($_POST["email"]);

}

if (empty($_POST["street"])) {
    $streetErr = "Street is required";
} else {
    $street = ($_POST["street"]);
}

if (empty($_POST["streetNumber"])) {
    $streetNumberErr = "Street.Nr is required";
} else {
    $streetNumber = ($_POST["streetNumber"]);
}

if (empty($_POST["city"])) {
    $cityErr = "City is required";
} else {
    $city = ($_POST["city"]);
}

if (empty($_POST["zipcode"])) {
    $zipCodeErr = "zipcode is required";
} else {
    $zipcode = ($_POST["zipcode"]);
}

if (is_numeric(887)) {
    echo "Yes";
} else {
    echo "No";
}

$totalValue = 0;

require 'form-view.php';