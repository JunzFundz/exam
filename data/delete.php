<?php

require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_GET['id'])) {

    $id = $_GET['id'];
}
if (isset($_POST['del'])) {
    $insert = $db->query("DELETE FROM contacts WHERE C_ID = '$id'");

    if ($insert) {
        echo '<script type="text/javascript">';
        echo 'alert("Contact deleted");';
        echo 'window.location.href = "../pages/home.php" ';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error deleting contact");';
        echo 'window.location.href = "../login-page.php" ';
        echo '</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    $query = "SELECT * FROM contacts WHERE C_ID = '$id' ";
    $result = mysqli_query($db, $query);

    foreach ($result as $row) { ?>
    <form action="" method="post" style="margin-inline: 40rem;">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <input type="hidden" value="<?php echo $row['C_ID'] ?>">
                <h5 class="card-title"><?php echo $row['NAME'] ?></h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary">Back</a>
                <button type="submit" name="del" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </form>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>