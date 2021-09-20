<?php include('../layouts/header.php') ?>

<?php
// Create empty form variables
$title = 'Book Title';
$author = 'Book Author';
$publishDate = 'Book Publish Date';
$description = 'Book Description';
$cover = 'Book Cover Image';

// Check if this is an update request
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
    $borrowed = $row['borrowed'];
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><?= $title; ?></h1>

      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <a href="/library_management/books" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left-short"></i>
          </a>
          <a href="/library_management/books/create.php" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus"></i>
          </a>
          <a href="/library_management/books/update.php?id=<?= $id; ?>" class="btn btn-sm btn-outline-dark">
            <i class="bi bi-pencil-square"></i>
          </a>
        </div>

        <div class="btn-group me-2">
          <?php
          if ($borrowed == 0) {
          ?>
            <a href="/library_management/books/lend.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-success">
              <i class="bi bi-journal-plus"></i>
            </a>
          <?php
          } else {
          ?>
            <a href="/library_management/books/return.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">
              <i class="bi bi-journal-arrow-up"></i>
            </a>
          <?php
          }
          ?>
          <button type="button" class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
          <img src="<?= $cover; ?>" alt="Cover Image" class="card-img-top">
        </div>
      </div>
      <div class="col-12 col-md-8">
        <table class="table table-borderless table-striped">
          <tr>
            <td><b>Author</b></td>
            <td><b>Originally Published On</b></td>
          </tr>

          <tr>
            <td><?= $author; ?></td>
            <td><?= $publishDate; ?></td>
          </tr>

          <tr>
            <td colspan="2"><b>Description</b></td>
          </tr>

          <tr>
            <td colspan="2"><?= $description; ?></td>
          </tr>
        </table>

        <?php
        // Fetch the borrowing details from the DB with the passed book id ($_GET['id'])
        $sql1 = "SELECT * FROM borrowing WHERE bookId = " . $row['id'];
        $result1 = $db->query($sql1);

        // If the book has previously been borrowed
        if ($result1->rowCount() > 0) {
        ?>
          <table class="table table-bordered">
            <tbody>
              <tr class="table-success">
                <td><b>Borrower</b></td>
                <td><b>Borrowed on</b></td>
                <td><b>Returned on</b></td>
              </tr>

              <?php
              while ($row1 = $result1->fetch()) {
                // Fetch the borrower's details from the DB
                $sql2 = "SELECT * FROM users WHERE id = " . $row1['borrowerId'];
                $result2 = $db->query($sql2);

                $user = null;

                // If the borrower exists in the DB
                if ($result2->rowCount() > 0) {
                  $user = $result2->fetch();
                }
              ?>
                <tr>
                  <td><?= $user['name']; ?></td>
                  <td><?= date("M j, Y H:i A", strtotime($row1['borrowedAt'])); ?></td>
                  <td><?= date("M j, Y H:i A", strtotime($row1['returnedAt'])); ?></td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        <?php
        }
        ?>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Book does not exist!</h1>
    </div>
<?php
  }
} else {
  // Redirect back to the books index.php since the action is invalid
  header('Location: /library_management/books/');
}
?>

<?php include('../layouts/footer.php') ?>