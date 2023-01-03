<?php
include('./include/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('./include/header.php') ?>
</head>

<body>
    <?php include('./include/nav.php') ?>
    <div class="w-75 mx-auto">
        <h1 class="text-center">User's Table</h1>
        <table id="myTable" class="table table-striped " style="width:100%">
            <thead>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Registered in</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                //view query
                $query = mysqli_query($conn, "SELECT * FROM user") or die('Query Error!');
                $no = 1;

                if (mysqli_num_rows($query) == 0) {
                    echo "<tr>
                        <td colspan='5' class='text-center'>No User</td>
                    </tr>";
                } else {
                    while ($row = mysqli_fetch_array($query)) {
                        echo '
						<tr>
                            <td class="d-none d-xl-table-cell">' . $row['id'] . '</td>
                            <td class="d-none d-xl-table-cell">' . $row['first_name'], ' ' . $row['last_name'] . '</td>
							<td class="d-none d-xl-table-cell">' . $row['username'] . '</td>
							<td class="d-none d-xl-table-cell">' . date('M-d-Y | h:i:s a', strtotime($row['created_at'])) . '</td>
                            <td class="d-none d-xl-table-cell">
                            <a type="button" class="btn btn-success" href="./user/update.php?id=' . $row['id'] . '">Update</a>
                            <a type="button" class="btn btn-danger" href="./user/delete.php?id=' . $row['id'] . '">Delete</a>
                            </td>
						</tr>
						';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


</body>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</html>