<?php include('header.php'); ?>
<form ".">
  <input type="hidden" name="action" value="add_visit" />
  <label>Person: </label>
  <select name="person_id">
    <?php foreach ($persons as $person) : ?>
      <option value="<?Php echo $person['id']; ?>">
          <?php echo $person['first_name'] . ' ' . $person['last_name']; ?>
      </option>
    <?php endforeach; ?>
  </select><br>
  <label>State:</label>
  <select name="state_id">
    <?php foreach ($states as $state) : ?>
      <option value="<?php echo $state['id']; ?>">
        <?php echo $state['state_name']; ?>
      </option>
    <?php endforeach; ?>
  </select><br>
  <input type="submit" value="Submit" />
</form>
