<?php

require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_GET['c_id'])) {

    $id = $_GET['c_id'];
}
if (isset($_POST['save'])) {

    $c_id = $_POST['c_id'];
    $name = $_POST['name'];
    $company = $_POST['comp'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update = $db->query("UPDATE contacts SET NAME='$name', COMPANY='$company', PHONE='$phone', EMAIL='$email' WHERE C_ID='$c_id'");

    if ($update) {
        echo '<script type="text/javascript">';
        echo 'alert("Contact updated");';
        echo 'window.location.href = "home.php" ';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Updating unsuccessul");';
        echo 'window.location.href = "home.php" ';
        echo '</script>';
    }
}

if ($result = mysqli_query($db, "SELECT * FROM contacts WHERE C_ID = '$id'")) {
    foreach ($result as $row) { ?>
        <form action="" method="post">
            <input type="hidden" value="<?php echo $id; ?>" name="c_id">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input value="<?php echo $row['NAME'] ?>" type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Company</label>
                <div class="col-sm-10">
                    <input value="<?php echo $row['COMPANY'] ?>" type="text" class="form-control" name="comp">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input value="<?php echo $row['PHONE'] ?>" type="text" class="form-control" name="phone">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input value="<?php echo $row['EMAIL'] ?>" type="email" class="form-control" name="email">
                </div>
            </div>

            <button type="submit" name="save">
                Save
            </button>

        </form> <?php
            }
        } ?>