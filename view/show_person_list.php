<?php include('header.php'); ?>
<h1>Select Person</h1>
<form ".">
  <input type="hidden" name="action" value="show_add_person" />
  <input type="submit" value="Add Person" />
</form>
<form ".">
  <input type="hidden" name="action" value="show_add_visit" />
  <input type="submit" value="Add Visit" />
</form>
<form ".">
  <input type="hidden" name="action" value="show_person_stats" />
  <select name="person_id">
    <?php foreach($persons as $person) : ?>
    <option value="<?php echo $person['id']; ?>"
      <?php if($person['id'] == $person_stats['id']) : ?>
        selected <?php endif; ?>>
      <?php echo $person[first_name] . ' ' . $person[last_name]; ?>
    </option>
    <?php endforeach; ?>
  </select>
  <input type="submit" value="Submit Person" />
</form><br>
<?php if($flag) : ?>
  <label>Name: <?php echo $person_stats['first_name'] . $person_stats['last_name']; ?></label><br>
  <label>Food: <?php echo $person_stats['favorite_food']; ?></label><br>
  <label>States: </label>
<?php endif; ?>
