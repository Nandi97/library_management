<?php include('../layouts/header.php') ?>

<?php
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $description = $_POST['description'];

      $sql = "INSERT INTO roles (name,description) VALUES(?,?)";
      $stmtinsert = $db->prepare($sql);
      $result = $stmtinsert->execute([$name, $description]);

      if ($result) {
        echo 'Saved.';
        header('Location: /library_management/roles/index.php');
      } else {
        echo 'error';
      }
    }
    ?>

<div>
  <div class="container">
    <h1>Create User Role</h1>

    <form action="create.php" method="post">
      <?php include('form.php') ?>
    </form>
  </div>
</div>

<?php include('../layouts/footer.php') ?>