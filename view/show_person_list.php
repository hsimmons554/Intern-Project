<?php include('header.php'); ?>
<!-- Modal to Add People -->
<div class="modal fade" id="personModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add an User Account</h4>
      </div>
      <div class="modal-body">
        <form>
        <h4>Type in the Name and favorite food of the New User:</h4>
        <div class="form-group">
        <label>First Name:</label><input id="add_prs_fname" type="text" class="form-control"><br>
      </div>
      <div class="form-group">
        <label>Last Name:</label><input id="add_prs_lname" type="text" class="form-control"><br>
      </div>
      <div class="form-group">
        <label>Favorite Food:</label><input id="add_prs_food" type="text" class="form-control">
      </div>
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="submit_person" type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal to Add Visits -->
<div class="modal fade" id="visitModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a Visit to User's Account</h4>
      </div>
      <div class="modal-body">
        <p>Select the a User Profile and the State that the User visited recently:</p>
        <label>Name:</label><select id="add_vis_prs_list" class="form-control"></select><br>
        <label>State:</label><select id="add_vis_state_list" class="form-control"></select><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="submit_visit" type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
<!-- Trigger the modals with buttons -->
<button id="add_person" type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#personModal">Add Person</button>
<button id="add_visit" type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#visitModal">Add Visit</button><br>
</div>
<div class="container">
<h1>Select Person</h1>
<button id="sub_prs_btn" type="button" class="btn btn-primary">Submit Person</button>
<select id="person_list" class="form-control" style="width:auto; display:inline-block;"></select>
</div>
<div class="container" style="font-size:25px;">
<label class="label label-success">Name: </label><label id="person_name" class="label label-default"></label><br>
<label class="label label-success">Food: </label><label id="person_food" class="label label-default"></label><br>
<label class="label label-success" style="float:left; margin-top:3px;">States: </label><label>
    <ul id="person_states"></ul></label><br>
</div>
<?php include('footer.php'); ?>

<script>
<!-- working script that adds hard coded options to select list -->
  $(Document).ready(function(){
    $("#buttonTest").click(function(){
      $("#myModal").modal();
    })
    // hide popup forms
    $("#add_person_form").hide();
    $("#add_visit_form").hide();

    // Function to auto load selection list
    $.get("api.php/people", function(data, status){
      var obj = JSON.parse(data);
      for (i=0; i<obj.length; i++){
        $("#person_list").append("<option value=\"" + obj[i].id +
                        "\">" + obj[i].first_name +
                        " " + obj[i].last_name + "</option");
      }
    });

    // Functions to add people to database
    $("#submit_person").click(function(){
      var fname = $("#add_prs_fname").val();
      var lname = $("#add_prs_lname").val();
      var food = $("#add_prs_food").val();
      if(!fname || fname == "" || $.isNumeric(parseInt(fname)) ||
         !lname || lname == "" || $.isNumeric(parseInt(lname))) {
        alert("Please enter a name and try again")
        return;
      }
      if(!food || food == "" || $.isNumeric(parseInt(food))) {
        alert("Please enter a food type and try again")
        return;
      }
        $.post("UploadToServer.php",
        {
          table: "people",
          first_name: fname,
          last_name: lname,
          favorite_food: food
        },
        function(data, status){
          var obj = JSON.parse(data);
          $("#person_list").append("<option value=\"" +
            obj.id + "\">" + obj.name + "</option>");
        });
    });

    // Add Visits functions
    $("#add_visit").click(function(){
      //Clear out the select lists for the next button click
      $("#add_vis_prs_list").empty();
      $("#add_vis_state_list").empty();
      $.get("api.php/people", function(data, status){
        var obj = JSON.parse(data);
        for (i=0; i<obj.length; i++){
          $("#add_vis_prs_list").append("<option value=\"" + obj[i].id +
                          "\">" + obj[i].first_name +
                          " " + obj[i].last_name + "</option");
        }
      });
      $.get("api.php/states", function(data, status){
        var obj = JSON.parse(data);
        for (i=0; i<obj.length; i++){
          $("#add_vis_state_list").append("<option value=\"" + obj[i].id +
                          "\">" + obj[i].state_name + "</option");
        }
      });
    });

    $("#submit_visit").click(function(){
      var prs_id = $("#add_vis_prs_list").val();
      var ste_id = $("#add_vis_state_list").val();
      $.post("UploadToServer.php",
      {
        table: "visits",
        prs_id: prs_id,
        ste_id: ste_id,
      },
      function(data, status){
        var obj = JSON.parse(data);
        $("#person_list").append("<option value=\"" +
          obj.id + "\">" + obj.name + "</option>");
      });
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
        $("#person_name").text(name);
        $("#person_food").text(food);

        //Call Nested function for states visited
        $.get("api.php/people/"+ $("#person_list").val() +"/states",
                                  function(data, status) {
          var obj = JSON.parse(data);
          var name;
          for (i=0;i<obj.length;i++){
            name = obj[i].state_name;
            $("#person_states").append("<li><label class=\"label label-default\">"+name+"</label></li>");
          }
        });
      });
    });
});
</script>

<?php include('footer.php'); ?>
