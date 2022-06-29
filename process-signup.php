<?php

if (empty($_POST["fname"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$phone = $_POST["phone_number"];
$dob = $_POST["dob"];

$sql = "INSERT INTO users (firstname, lastname, email, password, gender, phone ,dob) VALUES ('$fname', '$lname', '$email', '$password_hash', '$gender', '$phone' , '$dob')";

if (!$mysqli->query($sql)) {
    die("SQL error: " . $mysqli->error);
} else {
    header("Location: signup-success.html");
}
