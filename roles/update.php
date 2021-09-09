<?php include('../layouts/header.php') ?>

<?php
$id = $_GET['id'];

if (isset($_POST['submit'])) {
  // Create form data
  $name = $_POST['name'];
  $description = $_POST['description'];

  // Prepare SQL Update statement
  $sql = "UPDATE roles SET name = ?, description = ? WHERE id = ?";
  $stmtUpdate = $db->prepare($sql);
  $result = $stmtUpdate->execute([$name, $description, $id]);

  // Inform the user if the SQl operation was successful or not
  if ($result) {
    echo 'Saved.';
    // Since it was a success, redirect the user to the roles index page
    header('Location: /library_management/roles/index.php');
  } else {
    echo 'error';
  }
}
?>

<div>
  <div class="container">
    <h1>Update Role Details</h1>

    <form action="update.php" method="post">
      <?php include('form.php') ?>

    </form>
  </div>
</div>

<?php include('../layouts/footer.php') ?>