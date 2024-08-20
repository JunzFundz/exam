<?php

require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_POST['register'])) {

    $email = $_POST["email"];
    $name = $_POST["name"];
    $hashed  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $db->query("SELECT EMAIL FROM users WHERE EMAIL='$email'");

    if ($check->num_rows > 0) {
        echo '<script type="text/javascript">';
        echo 'alert("Email exist!");';
        echo 'window.location.href = "../index.php" ';
        echo '</script>';

        return false;
    } else {

        $insert = $db->query("INSERT INTO users (NAME, EMAIL, PASSWORD) VALUES ('$name','$email', '$hashed')");

        if ($insert) {
            echo '<script type="text/javascript">';
            echo 'alert("Account created");';
            echo 'window.location.href = "../pages/home.php" ';
            echo '</script>';
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("Error occured");';
            echo 'window.location.href = "../home.php" ';
            echo '</script>';
        }

        return true;
    }
}
