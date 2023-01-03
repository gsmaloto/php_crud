<?php
include('../include/db.php');

$id = $_GET['id'];

// SELECT QUERY
$querySelect = mysqli_query($conn, "SELECT first_name, last_name, username FROM user WHERE id = $id") or die('Query Error');
$row = mysqli_fetch_array($querySelect) or die('fetch Error');

$errorMsg = $matchMsg = "";
if (isset($_POST['update'])) {

  $firstName = $_POST['fistName'];
  $lastName = $_POST['lastName'];
  $username = $_POST['username'];

  if (empty($firstName) || empty($lastName) || empty($username)) {
    $errorMsg = '<div class="alert alert-danger" role="alert">
                      All fields are required!
                    </div>';
  } else {
    //insert query
    $query = "UPDATE user
                SET first_name = '$firstName', last_name = '$lastName', username = '$username'
                WHERE id = '$id';";
    mysqli_query($conn, $query) or die('Query Error');

    //message
    $errorMsg = '<div class="alert alert-success" role="alert">
                      ' . $row['first_name'] . '  ' . $row['last_name'] . ' updated successfully!
                  </div>';
    header("Location: ../dashboard.php");
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include('../include/header.php') ?>
</head>

<body>
  <?php include('../include/nav.php') ?>
  <div class="w-50 mx-auto mt-5">
    <h1 class="text-center">"<?= $row['first_name'] . '  ' . $row['last_name'] ?>" Information</h1>
    <?= $errorMsg ?? $errorMsg  ?>
    <form action="update.php?id=<?= $id ?>" method="POST">
      <input type="hidden" value=<?= $id ?>>
      <div class="row">
        <div class="mb-3 col">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="fistName" value=<?= $row['first_name'] ?>>
        </div>
        <div class="mb-3 col">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value=<?= $row['last_name'] ?>>
        </div>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value=<?= $row['username'] ?>>
      </div>

      <button type="submit" class="btn btn-primary w-100" name="update">Update</button>
      <a href="../dashboard.php" class="btn btn-secondary w-100 mt-3" name="update">Back</a>
    </form>
  </div>
</body>

</html>