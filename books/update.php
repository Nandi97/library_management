<?php include('../layouts/header.php') ?>

<?php
// Create empty form variables
$title = '';
$author = '';
$publishDate = '';
$description = '';
$cover = '';

// Check that the book's id has been passed
if (isset($_GET['id'])) {
  // Get the book id passed with the update request
  $id = $_GET['id'];

  // Fetch the book details from the DB with the passed id ($_GET['id'])
  $sql = "SELECT * FROM books WHERE id = " . $id;
  $result = $db->query($sql);

  // If the book exists in the DB, update the form variables
  if ($result->rowCount() > 0) {
    $row = $result->fetch();

    $title = $row['title'];
    $author = $row['author'];
    $publishDate = $row['publishDate'];
    $description = $row['description'];
    $cover = $row['cover'];
  } else {
    // Redirect back to the books index.php since the book does not exist
    header('Location: /library_management/books/');
  }
?>

  <div>
    <div class="container">
      <h1>Update Book Details</h1>

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
  // Redirect back to the books index.php since the action is invalid
  header('Location: /library_management/books/');
}

if (isset($_POST['submit'])) {
  // Get the submitted form data
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
    header('Location: /library_management/books/');
  } else {
    echo 'error';
  }
}
?>

<?php include('../layouts/footer.php') ?>