<?php include('../layouts/header.php') ?>

<--?php
//create empty form variables
$title = 'Book Title';
$author = 'Book Author';
$cover = 'Book Cover Image';

// Get the book id passed with the update request
$id = $_GET['id'];

// Fetch the book details from the DB with the passed id ($_GET['id'])
$sql = "SELECT * FROM books WHERE id = " . $id;
$result = $db->query($sql);

if ($result->rowCount() > 0) {
  $row = $result->fetch();

  $title = $row['title'];
  $author = $row['author'];
  $cover = $row['cover'];
}
?-->

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"><?= $title; ?></h1>
</div>
<div class="row">
  <div class="col-12 col-md-4">
    <div class="card">
      <img src="<?= $cover; ?>" alt="Cover Image" class="card-img-top">
    </div>
  </div>
  <div class="col-12 col-md-8">
    <form>

      <legend>Borrow Form</legend>
      <div class="mb-3">
        <label for="librarinaId" class="form-label">Lender</label>
        <select id="disabledSelect" class="form-select">
          <option>Lender</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="borrowerId" class="form-label">Borrower</label>
        <select id="disabledSelect" class="form-select">
          <option>Borrower</option>
        </select>
      </div>
      <div class="mb-3">
        <div class="form-floating">
        <input type="date" name="publishDate" id="publishDate" class="form-control" placeholder="Publish Date" value="<?= $publishDate; ?>" required>
        <label for="publishDate" class="form-label">Book Borrow Date</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      </fieldset>
    </form>
  </div>
</div>
<?php include('../layouts/footer.php') ?>