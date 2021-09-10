<?php include('../layouts/header.php') ?>

<?php
// Create empty form variables
$name = '';
$phoneNo = '';
$address = '';
$roleId = '';
$avatar = '';
$btnText = 'Update';

// Check that the user's id has been passed
if (isset($_GET['id'])) {
  // Get the user id passed with the update request
  $id = $_GET['id'];

  // Fetch the user details from the DB with the passed id ($_GET['id'])
  $sql = "SELECT * FROM users WHERE id = " . $id;
  $result = $db->query($sql);

  // If the user exists in the DB, update the form variables
  if ($result->rowCount() > 0) {
    $row = $result->fetch();

    $name = $row['name'];
    $phoneNo = $row['phoneNo'];
    $address = $row['address'];
    $roleId = $row['roleId'];
    $avatar = $row['avatar'];
  } else {
    // Redirect back to the users index.php since the user does not exist
    header('Location: /library_management/users/');
  }
?>

  <div>
    <div class="container">
      <h1>Update User Details</h1>

      <form action="update.php" method="post">
        <?php
        echo '<input type="hidden" name="id" id="id" value="' . $id . '">';

        include('form.php');
        ?>
      </form>
    </div>
  </div>

<?php
} else {
  // Redirect back to the users index.php since the action is invalid
  header('Location: /library_management/users/');
}

if (isset($_POST['submit'])) {
  // Get the submitted form data
  $id = $_POST['id'];
  $name = $_POST['name'];
  $phoneNo = $_POST['phoneNo'];
  $address = $_POST['address'];
  $roleId = $_POST['roles'];

  // Prepare SQL Update statement
  $sql = "UPDATE users SET name = ?, phoneNo = ?, address = ?,  roleId = ? WHERE id = " . $id;
  $stmtUpdate = $db->prepare($sql);
  $result = $stmtUpdate->execute([$name, $phoneNo, $address,  $roleId]);

  // Inform the user if the SQl operation was successful or not
  if ($result) {
    echo 'Saved.';
    // Since it was a success, redirect the user to the roles index page
    header('Location: /library_management/users/');
  } else {
    echo 'error';
  }
}
?>

<?php include('../layouts/footer.php') ?>