<?php 

require_once("../connection/conn.php");
$dbh = new Dbh();
$db = $dbh->connect();

if (isset($_GET['ID'])) {

    $id = $_GET['ID'];
}
?>

<form action="../data/add.php" method="post">
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="cname">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Company</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="comp">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="phone">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email">
        </div>
    </div>

    <button type="submit" name="add">
        Add
    </button>

</form>