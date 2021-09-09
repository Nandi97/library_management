<?php include('../layouts/header.php') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Books</h1>

  <a href="/library_management/books/create.php" class="btn btn-outline-primary btn-sm">
    <i class="bi bi-plus"></i>
    Add Book
  </a>
</div>

<?php
$sql = "SELECT * FROM books";
$result = $db->query($sql);
if ($result->rowCount() > 0) {
?>

  <div class="row">
    <?php
    while ($row = $result->fetch()) {
    ?>
      <div class="col-6 col-sm-3 col-md-2">
        <div class="card">
          <a href="/library_management/books/show.php?id=<?= $row['id'] ?>">
            <img src="<?= $row['cover']; ?>" alt="" class="card-img-top">
          </a>

          <div class="card-body">
            <div class="fw-bold"><?= $row['title']; ?></div>

            <div class="fw-light">
              <?= $row['author']; ?>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    // Free result set
    unset($result);
    ?>
  </div>

<?php
} else {
  echo "No books have been created in the system.";
}
?>

<?php include('../layouts/footer.php') ?>