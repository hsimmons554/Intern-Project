<?php include('header.php'); ?>
<h1>Select Person</h1>
<button id="add_person">Add Person</button>
<button id="add_visit">Add Visit</button>
<div id="dialog"></div>
<!--
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

<div id="person_list"> -->
<select id="person_list"/>
</select>
  <!--
</div> -->
<!--
  <input type="submit" value="Submit Person" />
</form> -->
<button id="sub_prs_btn">Submit Person</button><br>
<label>Name: </label><label id="person_name"></label><br>
<label>Food: </label><label id="person_food"></label><br>
<label>States: </label><label><ul id="person_states"></ul></label><br>

<!--
<?php// if($flag) : ?>
  <label>Name: <?php// echo $person_stats['first_name'] . ' ' . $person_stats['last_name']; ?></label><br>
  <label>Food: <?php// echo $person_stats['favorite_food']; ?></label><br>
  <?php// if(!empty($visits)) : ?>
    <label>States:</label><br>
    <?php// foreach ($visits as $visit) : ?>
      <label>&nbsp;</label><label> <?php// echo $visit['state_name']; ?></label><br>
    <?php// endforeach; ?>
  <?php// else : ?>
    <?php// {echo '<label>States: None</label>'; break;} ?>
  <?php// endif; ?>
<?php// endif; ?> /* ?>
-->

<!-- Testing scripts -->
<!--
<button id="btn">add option</button>
<button id="btn2">jlj</button>
<button id="btn3">log obj data</button>
<button id="btn4">add to list</button>
<button id="btn5"> select from list</button> -->
<script>
<!-- working script that adds hard coded options to select list -->
  $(Document).ready(function(){
    // Function to auto load selection list
    $.get("api.php/people", function(data, status){
      var obj = JSON.parse(data);
      for (i=0; i<obj.length; i++){
        $("#person_list").append("<option value=\"" + obj[i].id +
                        "\">" + obj[i].first_name +
                        " " + obj[i].last_name + "</option");
      }
    });

    //Function to submit person choice to database
    $("#sub_prs_btn_test").click(function(){
      alert("Person Name: " + $("#person_list option:selected").text() +
                  "\nPerson Id:" + $("#person_list").val());
    });

    //Function to retrieve person data to server
    $("#sub_prs_btn").click(function(){
      $("#person_name").text(" ");
      $("#person_food").text(" ");
      $("#person_states").empty();
      //Function call to get person's personal info
      $.get("api.php/people/" + $("#person_list").val(), function(data, status){
        var obj = JSON.parse(data);
        var name = obj[0].first_name + " " + obj[0].last_name;
        var food = obj[0].favorite_food;
        //var url = "api.php/people/" + $("#person_list").val();
        //alert("Name: "+name+"\nFood: "+food+"\nstatus: " + status);
        $("#person_name").text(name);
        $("#person_food").text(food);

        //Call Nested function for states visited
        $.get("api.php/people/"+ $("#person_list").val() +"/states",
                                  function(data, status) {
          var obj = JSON.parse(data);
          var name;
          for (i=0;i<obj.length;i++){
            name = obj[i].state_name;
            $("#person_states").append("<li>"+name+"</li>");
          }
        });
      });
    });

    $("#add_person").onclick(function(){
      document.getElementById('abc').style.display = "block";
    });


    //$("#add_person").click(function(){
      //$("#dialog").css("display", "block");
      //  modal: true;
        //autoOpen: false;

        //onClose: function(){
          //alert("hi");
        //}
    //  $("#dialog").dialog("open");
      //$.post("")
    //});
/*
    $("#btn").click(function() {
      $("select").append("<option>hi</option>");
    });
*/
    /*$("#btn2").click(function() {
      $("option").remove();
    });*/
/*
    $("#btn3").click(function() {
      $.get("api.php/states", function(rawdata, status){
        for (i=0; i<JSON.parse(rawdata).length; i++){
        //console.log("Data: " + JSON.parse(rawdata)[i].id + "\nStatus: " + status);
        $("select").append("<option value=\""+ JSON.parse(rawdata)[i].id +
                           "\">" + JSON.parse(rawdata)[i].state_name + "</option>");
      }
      });
    });
*//*
    $("#btn4").click(function() {
      $("select").append("<option>" + function() {
        $.get("api.php/states");
      } +"</option>");
    });
*//*
    $("#btn5").click(function(){
      alert("option value:" + /*if($("option").)*//*$("option").filter(":selected").text() +
    " id:" + $("option").filter(":selected").attr("value"));
    });
*/
});
</script>

<?php include('footer.php'); ?>
