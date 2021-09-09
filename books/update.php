<?php include('../layouts/header.php') ?>

<?php

if (isset($_POST['submit'])) {
  // Create form data
  $id = $_POST['id'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $description = $_POST['description'];
  $publishDate = $_POST['publishDate'];

  // Prepare SQL Update statement
  $sql = "UPDATE books SET title = ?, author = ?, description = ?, publishDate = ? WHERE id = " . $id;
  $stmtUpdate = $db->prepare($sql);
  $result = $stmtUpdate->execute([$title, $author, $description, $publishDate]);

  // Inform the user if the SQl operation was successful or not
  if ($result) {
    echo 'Saved.';
    // Since it was a success, redirect the user to the roles index page
    header('Location: /library_management/books/index.php');
  } else {
    echo 'error';
  }
}
?>

<div>
  <div class="container">
    <h1>Update Book Details</h1>

    <form action="update.php" method="post">
      <?php include('form.php') ?>
    </form>
  </div>
</div>

<?php include('../layouts/footer.php') ?>