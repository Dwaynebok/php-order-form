<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

// these empty variables are created to be used for the session so that the users info can be stored..
$zipCode = "";
$city = "";
$street = "";
$streetNumber = "";
$email = "";

// here below is the code for session
if (isset($_SESSION["zipCode"])){
   $zipCode =  $_SESSION["zipCode"];
}

if (isset($_SESSION["city"])){
   $city =  $_SESSION["city"];
}

if (isset($_SESSION["street"])){
    $street =  $_SESSION["street"];
}

if (isset($_SESSION["streetNumber"])){
   $streetNumber =  $_SESSION["streetNumber"];
}

// created an empty variable for the error messages
$emailErr = "";
$streetErr = "";
$zipCodeErr = "";
$cityErr = "";
$streetNumberErr = "";
$success = "";


function whatIsHappening()
{
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
// changed the names of the variables from products to q more recognizable ones
$sandwich = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];


$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$products = $drinks;

$food = $_GET['food']; // set variable for food and used the get to fetch for the food data

if(!isset($_GET['food'])){
    $products = $sandwich; // used the isset if the value has not been set
}
else if ($food == 1){
    $products = $sandwich; //else if for if the food is equals to one
} else {
    $products = $drinks;  // else change to drinks
}


//var_dump($products);

/*
$email = ($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
} else {
    echo "Email address '$email' is considered invalid.";
}
*/

//created a validation for the email using the code below
/*
$email = ($_POST["email"]);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$email' is considered valid.";

} else {
    echo "Email address '$email' is considered invalid.";
}
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = ($_POST["email"]);
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = ($_POST["email"]);
    }

    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } elseif($_POST["street"]) {
        $street = ($_POST["street"]);
    } else{
        $_SESSION["street"] = $street;
    }

    if (empty($_POST["streetNumber"])) {
        $streetNumberErr = "Street.Nr is required";
    } elseif ($_POST["streetNumber"]){
        $streetNumber = ($_POST["streetNumber"]);
        if (!preg_match("/^[0-9*#+]+$/", $streetNumber)) {
            $streetNumberErr = "Only numeric values allowed";
        } else{
                $_SESSION["streetNumber"] = $streetNumber;
        }
    }

    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } elseif ($_POST["city"]) {
        $city = ($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "Only letters and white space allowed";
        } else{
            $_SESSION["city"] = $city;
        }
    }

    if (empty($_POST["zipcode"])) {
        $zipCodeErr = "zipcode is required";
    } elseif($_POST["zipcode"]) {
        $zipCode = ($_POST["zipcode"]);
        if (!preg_match("/^[0-9*#+]+$/", $zipCode)) {
            $zipCodeErr = "Only numeric values allowed";
        } else{
            $_SESSION["zipCode"] = $zipCode;
        }
        if ($zipCodeErr == "" && $streetErr == "" && $cityErr == "" && $emailErr == "" && $streetNumberErr == "") {
            $success = '<div class="alert alert-primary" role="alert">Thank you for your Order </div>'; //created a variable here and called the variable with the script tag in html
        }
    }
}

$_SESSION["streetNumber"] = "$streetNumber";
$_SESSION["zipCode"] = "$zipCode";
$_SESSION["street"] = "$street";
$_SESSION["city"] = "$city";

//making express delivery
if (isset($_POST['express_delivery'])){
    $time = 'your food will arrive in 45minutes';
} else{
    $time = ' your food will arrive in 2hours';
}


//creating the mail
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$to = "dwaynebok19@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: dwynebok19@gmail.com" . "\r\n" .
    "CC: somebodyelse@example.com";


mail($to,$subject,$txt,$headers);


// first make session for each checkbox and set the value of the checkbox
// make the attribute check checked
// get access to the price to be able to add them up
// create an empty session and set value to the session,
// create an if statement


//code for the drinks and food to add up
$totalValue = 0;
if(isset($_GET['food']))
{ if ($_GET['food']== '1'){
    $products = $sandwich;
    $_SESSION['products'] = $sandwich;
} else {
    $_SESSION['products'] = $drinks;
    $products = $drinks;
}
$foodCount = count($sandwich);
for ($i = 0;$i < $foodCount; $i++ ){
    if (isset($_POST['products'][$i])){
        $totalValue += $products[$i]['price'];
    }
}
}

//whatIsHappening();

require 'form-view.php';