<?php

require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_POST['add'])) {

    $id = $_POST["id"];
    $name = $_POST["cname"];
    $comp = $_POST["comp"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $insert = $db->query("INSERT INTO contacts (S_ID,NAME,COMPANY,PHONE,EMAIL) VALUES ('$id','$name','$comp','$phone','$email')");

    if ($insert) {
        echo '<script type="text/javascript">';
        echo 'alert("Contact added");';
        echo 'window.location.href = "../pages/home.php" ';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error adding contact");';
        echo 'window.location.href = "../login-page.php" ';
        echo '</script>';
    }
}
