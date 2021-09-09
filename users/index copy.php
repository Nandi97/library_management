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

  <a href="/library_management/users/create.php" class="btn btn-outline-primary">
    <i class="bi bi-plus"></i>
    Add User
  </a>
</div>

<?php
$sql = "SELECT * FROM users";
$result = $db->query($sql);
$counter = 0;
if ($result->rowCount() > 0) {
?>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php
      while ($row = $result->fetch()) {
        $counter++;
      ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['phoneNo']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <td><?php
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
          <td>
            <a href="/library_management/users/update.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">
              <i class="bi bi-pencil"></i>
              Edit User
            </a>
          </td>
        </tr>
      <?php
      }
      // Free result set
      unset($result);
      ?>
    </tbody>
  </table>

<?php
} else {
  echo "No users have been created in the system.";
}
?>

<?php include('../layouts/footer.php') ?>