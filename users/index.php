<?php include('../layouts/header.php') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="/library_management/users">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/library_management/roles">Roles</a>
    </li>
  </ul>

  <a href="/library_management/users/create.php" class="btn btn-outline-primary btn-sm">
    <i class="bi bi-plus"></i>
    Add User
  </a>
</div>

<?php
$sql = "SELECT * FROM users";
$result = $db->query($sql);
if ($result->rowCount() > 0) {
?>

  <div class="row">

    <?php
    while ($row = $result->fetch()) {
    ?>
      <div class="col-12 col-sm-2 col-md-2">
        <div class="card">
          <a href="/library_management/users/#">
            <img src="<?= $row['avatar']; ?>" alt="" class="card-img-top">
          </a>

          <div class="card-body">
            <div class="fw-bold"><?= $row['name']; ?></div>

            <div class="fw-light">
              <div class="row">
                <div class="col">
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
                </div>

                <div class="col text-end">
                  <a href="/library_management/users/update.php?id=<?= $row['id'] ?>">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                </div>
              </div>
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
  echo "No users have been created in the system.";
}
?>

<?php include('../layouts/footer.php') ?>