<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
      <input type="text" name="name" id="name" class="form-control" placeholder="Role Name" value="<?= $name; ?>" required>
      <label for="name" class="form-label">Full Name</label>
    </div>
  </div>

  <div class="col">
    <div class="form-floating mb-3">
      <input type="text" name="phoneNo" id="phoneNo" class="form-control" placeholder="Phone" value="<?= $phoneNo; ?>" required>
      <label for="phoneNo" class="form-label">Phone Number</label>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
      <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="<?= $address; ?>" required>
      <label for="address" class="form-label">Address</label>
    </div>
  </div>

  <div class="col">
    <div class="form-floating mb-3">
      <select name="roleId" id="roleId" class="form-select">
        <option>Select User Role</option>
        <?php
        $sql = "SELECT * FROM roles";
        $result = $db->query($sql);

        if ($result->rowCount() > 0) {
          
          while ($row = $result->fetch()) {

            if ($roleId === $row['id']) {
        ?>
              <option selected value="<?= $row['id']; ?>">
              <?php
            } else {
              ?>
              <option value="<?= $row['id']; ?>">
              <?php
            }
              ?>
              <?= $row['name']; ?>
              </option>
          <?php
          }
          // Free result set
          unset($result);
        }
          ?>
      </select>

      <label for="roleId" class="form-label">Role</label>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
      <input type="text" name="avatar" id="avatar" class="form-control" placeholder="Avatar URL" value="<?= $avatar; ?>" required>
      <label for="avatar" class="form-label">Avatar URL</label>
    </div>
  </div>
</div>

<button class="btn btn-primary" type="submit" name="submit" id="submit"><?= $btnText; ?></button>
<a href="/library_management/users" class="btn btn-secondary">
  Cancel
</a>