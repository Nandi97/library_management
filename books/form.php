<?php
// Create empty form variables
$title = '';
$author = '';
$publishDate = '';
$description = '';
$cover = '';

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
  }

  echo '<input type="hidden" name="id" id="id" value="' . $id . '">';
}
?>

<div>
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="form-floating mb-3">
        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?= $title; ?>" required>
        <label for="title" class="form-label">Title</label>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="form-floating mb-3">
        <input type="text" name="author" id="author" class="form-control" placeholder="Author" value="<?= $author; ?>" required>
        <label for="author" class="form-label">Author</label>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="form-floating mb-3">
        <input type="date" name="publishDate" id="publishDate" class="form-control" placeholder="Publish Date" value="<?= $publishDate; ?>" required>
        <label for="publishDate" class="form-label">Books Publish Date</label>
      </div>
    </div>

    <div class="col-12">
      <div class="form-floating mb-3">
        <textarea name="description" id="description" class="form-control" placeholder="description" style="height: 150px;" required><?= $description; ?></textarea>
        <label for="description" class="form-label">Description</label>
      </div>
    </div>

    <div class="col-12">
      <div class="form-floating mb-3">
        <input type="text" name="cover" id="cover" class="form-control" placeholder="Cover URL" value="<?= $cover; ?>" required>
        <label for="cover" class="form-label">Cover URL</label>
      </div>
    </div>
  </div>

  <div class="mb-3">
    <button class="btn btn-primary" type="submit" name="submit" id="submit">Save</button>
    <a href="/library_management/books" class="btn btn-secondary">
      Cancel
    </a>
  </div>
</div>