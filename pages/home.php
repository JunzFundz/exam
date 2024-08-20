<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .search-bar {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
    <title>Contacts</title>
</head>

<body>
    <?php
    echo $_SESSION['email'];

    $id = $_SESSION['id'];
    require_once("../connection/conn.php");
    $dbh = new Dbh();
    $db = $dbh->connect();

    $limit = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    $start = ($page - 1) * $limit; 

    $query = "SELECT COUNT(*) FROM contacts WHERE S_ID = '$id'";
    $result = mysqli_query($db, $query);
    $total = mysqli_fetch_array($result)[0]; 
    $pages = ceil($total / $limit);

    $query = "SELECT * FROM contacts WHERE S_ID = '$id' LIMIT $start, $limit";
    $result = mysqli_query($db, $query);
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="add_contact.php?ID=<?php echo $_SESSION['id']; ?>">Add</a></li>
            <li class="breadcrumb-item">Contacts</li>
            <li class="breadcrumb-item"><a href="../logout.php">Logout</a></li>
        </ol>
    </nav>
    <br>
    <input type="text" id="searchInput" class="search-bar" onkeyup="searchTable()" placeholder="Search for names..">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">COMPANY</th>
                <th scope="col">PHONE</th>
                <th scope="col">EMAIL</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['NAME'] ?></td>
                    <td><?php echo $row['COMPANY'] ?></td>
                    <td><?php echo $row['PHONE'] ?></td>
                    <td><?php echo $row['EMAIL'] ?></td>
                    <td>
                        <a href="edit.php?c_id=<?php echo $row['C_ID'] ?>">Edit</a>
                        <a href="../data/delete.php?id=<?php echo $row['C_ID'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?php if ($page <= 1) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page > 1) {
                                                echo "?page=" . ($page - 1);
                                            } ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
                <li class="page-item <?php if ($page == $i) {
                                            echo 'active';
                                        } ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page >= $pages) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page < $pages) {
                                                echo "?page=" . ($page + 1);
                                            } ?>">Next</a>
            </li>
        </ul>
    </nav>

</body>

</html>