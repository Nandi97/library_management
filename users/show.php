<?php include('../layouts/header.php') ?>

<?php
// Create empty form variables
$name = 'Full Name';
$phoneNo = 'Phone Number';
$address = 'Address';
$roleId = 'Role';
$avatar = 'User Avatar Image';

// Check if this is an update request
if (isset($_GET['id'])) {
  // Get the book id passed with the update request
  $id = $_GET['id'];

  // Fetch the book details from the DB with the passed id ($_GET['id'])
  $sql = "SELECT * FROM users WHERE id = " . $id;
  $result = $db->query($sql);

  // If the book exists in the DB, update the form variables
  if ($result->rowCount() > 0) {
    $row = $result->fetch();

    $name = $row['name'];
    $phoneNo = $row['phoneNo'];
    $address = $row['address'];
    $roleId = $row['roleId'];
    $avatar = $row['avatar'];
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><?= $name; ?></h1>

      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <a href="/library_management/users" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left-short"></i>
          </a>
          <a href="/library_management/users/create.php" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus"></i>
          </a>
          <a href="/library_management/users/update.php?id=<?= $id; ?>" class="btn btn-sm btn-outline-dark">
            <i class="bi bi-pencil-square"></i>
          </a>
          <button type="button" class="btn btn-sm btn-outline-danger">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
          <img src="<?= $avatar; ?>" alt="Cover Image" class="card-img-top">
        </div>
      </div>
      <div class="col-12 col-md-8">
        <table class="table table-borderless">

          <tr>
            <td>
              <i class="bi bi-person-circle text-primary"></i>
              <?= $name; ?>
            </td>
            <td>
              <i class="bi bi-telephone text-primary"></i>
              <?= $phoneNo; ?>
            </td>
            <td>
              <i class="bi bi-person-bounding-box text-primary"></i>
              <?php
              $sql1 = "SELECT * FROM roles WHERE id = " . $row['roleId'];
              $result1 = $db->query($sql1);
              if ($result1->rowCount() > 0) {
                while ($row1 = $result1->fetch()) {
                  echo $row1['name'];
                }
                // Free result set
                unset($result1);
              }
              ?>
            </td>
          </tr>

          <tr>
            <td colspan="3">
              <i class="bi bi-geo-alt text-primary" ></i>
              <?= $address; ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  <?php
  } else {

  ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">User does not exist!</h1>
    </div>
<?php
  }
} else {
  // Redirect back to the books index.php since the action is invalid
  header('Location: /library_management/users/');
}
?>

<?php include('../layouts/footer.php') ?>