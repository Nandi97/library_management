<?php include('../layouts/header.php') ?>

<?php

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $description = $_POST['description'];
  $cover = $_POST['cover'];
  $publishDate = $_POST['publishDate'];

  $sql = "INSERT INTO BOOKS ( title, author,description,cover,publishDate) VALUES(?,?,?,?,?)";
  $stmtInsert = $db->prepare($sql);
  $result = $stmtInsert->execute([$title, $author, $description, $cover, $publishDate]);

  if ($result) {
    echo 'Saved.';
    header('Location: /library_management/books/index.php');
  } else {
    echo 'error';
  }
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Create a Book</h1>
</div>

<form action="create.php" method="post">
  <?php include('form.php') ?>
</form>

<?php include('../layouts/footer.php') ?>