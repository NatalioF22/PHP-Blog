<?php

if (empty($_POST["f_name"])) {
    die("First name is required");
}
if (empty($_POST["l_name"])) {
    die("Last name is required");
}
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (f_name,l_name, email, password_hash)
        VALUES (?, ?, ?,?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}


        if($query_run){
            echo"good";
        }else{
            echo"Not done";
        }
$stmt->bind_param("ssss",
                  $_POST["f_name"],
                  $_POST["l_name"],
                  $_POST["email"],
                  $password_hash);

try {
    if ($stmt->execute()) {

        header("Location: signup-success.php");
        exit;

    } else {

        if ($mysqli->errno === 1062) {
            die("email already taken");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}
catch(Exception $e){
    echo "Not working" . $e;
}