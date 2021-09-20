<?php include('../layouts/header.php') ?>

<?php
//create empty variables
$title = 'Book Title';
$cover = 'Book Cover Image';

if (isset($_GET['id'])) {
  // Get the book id passed with the update request
  $id = $_GET['id'];

  // Fetch the book details from the DB with the passed id ($_GET['id'])
  $sql = "SELECT * FROM books WHERE id = " . $id;
  $result = $db->query($sql);

  $users = null;

  if ($result->rowCount() > 0) {
    $row = $result->fetch();

    $title = $row['title'];
    $cover = $row['cover'];

    // Fetch librarians from the DB
    // $sql1 = "SELECT * FROM users WHERE roleId > 2";
    // $result1 = $db->query($sql1);

    // Fetch borrowers from the DB
    // $sql2 = "SELECT * FROM users";
    // $result2 = $db->query($sql2);
?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Return: <?= $row['title']; ?></h1>
    </div>

    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
          <img src="<?= $row['cover']; ?>" alt="Cover Image" class="card-img-top">
        </div>
      </div>

      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-body">
            <form action="return.php" method="POST" role="form">
              <legend>Return Form</legend>
              <input type="hidden" name="bookId" id="bookId" value="<?= $id; ?>">

              <div class="form-floating mb-3">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label for="librarianId" class="form-label">Lender</label>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="borrowerId" class="form-label">Borrower</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="returnBook" id="returnBook">Return Book</button>
              <a href="/library_management/books/show.php?id=<?= $id ?>" class="btn btn-secondary">
                Cancel
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
?>

<?php include('../layouts/footer.php') ?>