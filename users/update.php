<?php include('../layouts/header.php') ?>

<?php
$id = $_GET['id'];

if (isset($_POST['submit'])) {
  // Create form data
  $name = $_POST['name'];
  $phoneNo = $_POST['phoneNo'];
  $address = $_POST['address'];
  $roleId = $_POST['roleId'];

  // Prepare SQL Update statement
  $sql = "UPDATE users SET name = ?, phoneNo = ?, address = ?, roleId = ? WHERE id = ?";
  $stmtUpdate = $db->prepare($sql);
  $result = $stmtUpdate->execute([$name, $phoneNo, $address, $roleId, $id]);

  // Inform the user if the SQl operation was successful or not
  if ($result) {
    echo 'Saved.';
    // Since it was a success, redirect the user to the users index page
    header('Location: /library_management/users/index.php');
  } else {
    echo 'error';
  }
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Update User Details</h1>
</div>

<form action="update.php" method="post">
  <?php include('form.php') ?>
</form>

<?php include('../layouts/footer.php') ?>