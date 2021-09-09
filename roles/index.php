<?php include('../layouts/header.php') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" href="/library_management/users">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="/library_management/roles">Roles</a>
    </li>
  </ul>

  <a href="/library_management/roles/create.php" class="btn btn-outline-primary btn-sm">
    <i class="bi bi-plus"></i>
    Add Role
  </a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th></th>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
    <?php
    $sql = "SELECT * FROM roles";
    $result = $db->query($sql);
    $counter = 0;
    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        $counter++;
    ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['description']; ?></td>
          <td>
            <a href="/library_management/roles/update.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">
              <i class="bi bi-pencil"></i>
              Edit Role
            </a>
          </td>
        </tr>
    <?php
      }
      // Free result set
      unset($result);
    } else {
      echo "No records matching your query were found.";
    }
    ?>
  </tbody>
</table>

<?php include('../layouts/footer.php') ?>