<?php include('../layouts/header.php') ?>

<?php
// Create empty form variables
$name = '';
$phoneNo = '';
$address = '';
$roleId = '';
$avatar = '';
$btnText = 'Create';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Create a User</h1>
</div>

<form action="create.php" method="post">
  <?php include('form.php') ?>
</form>

<?php

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $phoneNo = $_POST['phoneNo'];
  $address = $_POST['address'];
  $roleId = $_POST['roleId'];
  $avatar = $_POST['avatar'];

  $sql = "INSERT INTO users (name,phoneNo,address,roleId,avatar) VALUES(?,?,?,?,?)";
  $stmtInsert = $db->prepare($sql);
  $result = $stmtInsert->execute([$name, $phoneNo, $address, $roleId, $avatar]);

  if ($result) {
    echo 'Saved.';
    header('Location: /library_management/users/index.php');
  } else {
    echo 'error';
  }
}
?>

<?php include('../layouts/footer.php') ?>