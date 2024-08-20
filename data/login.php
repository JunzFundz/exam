<?php
session_start();
require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $password  = trim($_POST['password']);

    $login = $db->query("SELECT * FROM users WHERE EMAIL='$email'");

        if ($login->num_rows > 0) {
            while ($row = $login->fetch_assoc()) {
                $stored_password = $row["PASSWORD"];
                if (password_verify($password, $stored_password)) {
                    $_SESSION['id'] = $row["S_ID"];
                    $_SESSION['email'] = $row["EMAIL"];
                    $_SESSION['password'] = $row["PASSWORD"];

                    header("location: ../pages/home.php");
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Credentials incorrect!");';
                    echo 'window.location.href = "../login-page.php" ';
                    echo '</script>';
                }
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("No user exist!");';
            echo 'window.location.href = "../login-page.php" ';
            echo '</script>';
        }
}
