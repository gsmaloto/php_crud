<?php
include('../include/db.php');

$errorMsg = $matchMsg = "";



if (isset($_POST['add'])) {
  $firstName = ucwords($_POST['fistName']);
  $lastName = ucwords($_POST['lastName']);
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPw = $_POST['confirmPw'];


  if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPw)) {
    $errorMsg = '<div class="alert alert-danger" role="alert">
                      All fields are required!
                    </div>';
  } else {

    if ($password !== $confirmPw) {
      $matchMsg = '<p class="text-danger">Password is not match!</p>';
    } else {
      //insert query
      $query = "INSERT INTO user
      (first_name, last_name, username, password) VALUES 
      ('$firstName','$lastName','$username', md5('$password'))";
      mysqli_query($conn, $query) or die('Query Error');

      //message
      $errorMsg = '<div class="alert alert-success" role="alert">
                      User added successfully!
                  </div>';

      $firstName = "";
      $lastName = "";
      $username = "";
      $password = "";
      $confirmPw = "";

      header('create.php');
    }
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
    <h1 class="text-center">User's Information</h1>
    <?= $errorMsg ?? $errorMsg  ?>
    <form action="create.php" method="POST">
      <div class="row">
        <div class="mb-3 col">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="fistName" value=<?= isset($_POST['add']) ? $firstName : '' ?>>
        </div>
        <div class="mb-3 col">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value=<?= isset($_POST['add']) ? $lastName : '' ?>>
        </div>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value=<?= isset($_POST['add']) ? $username : '' ?>>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value=<?= isset($_POST['add']) ? $password : '' ?>>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPw">
        <?= $matchMsg ?? $matchMsg  ?>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-3" name="add">Add</button>
      <a class="btn btn-secondary w-100" href="index.php">Back</a>
    </form>
  </div>
</body>

</html>