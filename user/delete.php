<script>
  var result = confirm("Press a button!");
  if (result == true) {
    <?php
    include('../include/db.php');

    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM user WHERE id = $id") or die('Query Error');

    header('Location: index.php');
    ?>
  }
</script>