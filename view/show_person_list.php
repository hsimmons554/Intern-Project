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
<div id="person_list">
  <select id="person_id" name="person_id" pagecontainerload="loadPeople(this.value)" /><!--
    <script type="text/javascript" charset="utf-8">
      $.getJSON("api/people", function(json){
        $('#select').empty();
        $('#select').append($('<option>').text("Select"));
        $.each(json, function(i, obj){
          $('#select').append($('<option>').text(obj.first_name).attr('value', obj.id));
        });
      });
    </script> -->
    <!-- <?php /*
    <?php foreach($persons as $person) : ?>
    <option value="<?php echo $person['id']; ?>"
      <?php if($person['id'] == $person_stats['id']) : ?>
        selected <?php endif; ?>>
      <?php echo $person[first_name] . ' ' . $person[last_name]; ?>
    </option>
  <?php endforeach; ?> */ ?>-->
  </select>
</div>
  <input type="submit" value="Submit Person" />
</form><br>
<?php if($flag) : ?>
  <label>Name: <?php echo $person_stats['first_name'] . ' ' . $person_stats['last_name']; ?></label><br>
  <label>Food: <?php echo $person_stats['favorite_food']; ?></label><br>
  <?php if(!empty($visits)) : ?>
    <label>States:</label><br>
    <?php foreach ($visits as $visit) : ?>
      <label>&nbsp;</label><label> <?php echo $visit['state_name']; ?></label><br>
    <?php endforeach; ?>
  <?php else : ?>
    <?php {echo '<label>States: None</label>'; break;} ?>
  <?php endif; ?>
<?php endif; ?>
<script>
  function loadPeople(str) {
    $.ajax({
      url: 'api/people',
      type: 'GET',
      data: 'q=' + str,
      dataType: 'json',
      success: function( json ) {
        $.each(json, function(i, value) {
          $('#person_list').append($('<option>').text(value).attr('value', value));
        });
      }
    });
  };
</script>
<!--
<script>
  function loadPeople() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        <! Code to load list of people >
        document.getElementById("person_list").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "api/people", true);
    xhttp.send();
  }
</script> -->
<?php include('footer.php'); ?>
