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
    $sql1 = "SELECT * FROM users WHERE roleId > 2";
    $result1 = $db->query($sql1);

    // Fetch borrowers from the DB
    $sql2 = "SELECT * FROM users";
    $result2 = $db->query($sql2);
?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Lend: <?= $row['title']; ?></h1>
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
            <form action="lend.php" method="POST" role="form" target="_blank">
              <legend>Borrow Form</legend>

              <input type="hidden" name="bookId" id="bookId" value="<?= $id; ?>">

              <div class="form-floating mb-3">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label for="librarianId" class="form-label">Lender</label>
                    <select name="librarianId" id="librarianId" class="form-select">
                      <option>Select Lender</option>
                      <?php
                      if ($result1->rowCount() > 0) {
                        while ($row1 = $result1->fetch()) {
                          echo '<option value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
                        }
                        // Free result set
                        unset($result1);
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="borrowerId" class="form-label">Borrower</label>
                    <select name="borrowerId" id="borrowerId" class="form-select">
                      <option>Select Borrower</option>
                      <?php
                      if ($result2->rowCount() > 0) {
                        while ($row2 = $result2->fetch()) {
                          echo '<option value="' . $row2['id'] . '">' . $row2['name'] . '</option>';
                        }
                        // Free result set
                        unset($result2);
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" name="lendBook" id="lendBook">Lend Book</button>
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

if (isset($_POST['lendBook'])) {
  // Get the submitted form data
  $bookId = $_POST['bookId'];
  $borrowerId = $_POST['borrowerId'];
  $librarianId = $_POST['librarianId'];

  // echo ("console.log('Book ID: " . $bookId . "')");
  // echo ("console.log('Borrower ID: " . $borrowerId . "')");
  // echo ("console.log('Librarian ID: " . $librarianId . "')");

  // Prepare SQL Update statement
  $sql3 = "INSERT INTO borrowing (bookId, borrowerId, librarianId) VALUES(?,?,?)";
  $stmtInsert = $db->prepare($sql3);
  $result3 = $stmtInsert->execute([$bookId, $borrowerId, $librarianId]);

  // Update the book details too
  $sql4 = "UPDATE books SET borrowed = 1 WHERE id = " . $bookId;
  $stmtUpdate = $db->prepare($sql4);
  $result4 = $stmtUpdate->execute();

  // Inform the user if the SQl operation was successful or not
  if ($result3 && $result4) {
    // echo 'Saved.';
    // Since it was a success, redirect the user to the roles index page
    header('Location: /library_management/books/show.php?id=' . $bookId);
  } else {
    echo 'error';
  }
}
?>

<?php include('../layouts/footer.php') ?>