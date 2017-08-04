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
  <select id="person_id"/>
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

<!-- Testing scripts -->
<button id="btn">add option</button>
<button id="btn2">remove options</button>
<button id="btn3">log obj data</button>
<button id="btn4">add to list</button>
<button id="btn5"> select from list</button>
<p id="testBlock"></p>

<p id="test">hi: </p>
<script>
  function loadPeople(str) {
    $.ajax({
      url: '10.10.10.10/api/people',
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

<!-- working script that adds hard coded options to select list -->
  $(Document).ready(function(){
    $("#btn").click(function() {
      $("select").append("<option>hi</option>");
    });

    $("#btn2").click(function() {
      $("option").remove();
    });

    $("#btn3").click(function() {
      $.get("api.php/states", function(rawdata, status){
        for (i=0; i<JSON.parse(rawdata).length; i++){
        //console.log("Data: " + JSON.parse(rawdata)[i].id + "\nStatus: " + status);
        $("select").append("<option value=\""+ JSON.parse(rawdata)[i].id +
                           "\">" + JSON.parse(rawdata)[i].state_name + "</option>");
      }
      });
    });

    $("#btn4").click(function() {
      $("select").append("<option>" + function() {
        $.get("api.php/states");
      } +"</option>");
    });

    $("#btn5").click(function(){
      alert("option value:" + /*if($("option").)*/$("option").filter(":selected").text() +
    " id:" + $("option").filter(":selected").attr("value"));
    });
});
</script>

<?php include('footer.php'); ?>
