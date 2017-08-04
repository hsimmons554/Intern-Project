<?php include('header.php'); ?>
<h1>Select Person</h1>
<button id="show_add_person_btn">Add Person</button>
<div id="add_person_form">
  <form>
    fname<input id="add_p_fname" type="text" name="first_name"/><br>
    lname<input id="add_p_lname" type="text" name="last_name"/><br>
    food<input id="add_p_food" type="text" name="food"/><br>
  </form>
  <button id="add_person">add person to list</button><br>
  <button id="cancel_add_prs_btn">Cancel</button>
</div>

<button id="show_add_visit_form_btn">Add Visit</button>
<div id="add_visit_form">
  <form>
      <label>Person:</label><select></select><br>
      <label>State:</label><select></select><br>
      <button id="add_visit">Add Visit</button>
      <button id="cancel_add_vst_btn">Cancel</button>
  </form>
</div>

<select id="person_list"/>
</select>
<button id="sub_prs_btn">Submit Person</button><br>
<label>Name: </label><label id="person_name"></label><br>
<label>Food: </label><label id="person_food"></label><br>
<label>States: </label><label><ul id="person_states"></ul></label><br>

<!-- Testing scripts -->
<!--
<button id="btn">add option</button>
<button id="btn2">jlj</button>
<button id="btn3">log obj data</button>
<button id="btn4">add to list</button> -->



<script>
<!-- working script that adds hard coded options to select list -->
  $(Document).ready(function(){

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

    // show the form for the add person
    $("#show_add_person_btn").click(function(){
      $("#add_person_form").show();
      $("#show_add_person_btn").hide();
    });

    // show the form for the add visit
    $("#show_add_visit_form_btn").click(function(){
      $("#add_visit_form").show();
      $("#show_add_visit_form_btn").hide();
    });

    // Hide the form for the add person
    $("#cancel_add_prs_btn").click(function(){
      $("#add_person_form").hide();
      $("#show_add_person_btn").show();
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

    //Add person to database
    $("#add_person").click(function(){
      var fname = $("#add_p_fname").val();
      var lname = $("#add_p_lname").val();
      var food = $("#add_p_food").val();
      alert(fname + lname + food);
      $.post("testingUploading.php",
      {
        first_name: fname,
        last_name: lname,
        favorite_food: food
      },
      function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        var obj = JSON.parse(data);
        $("#person_list").append("<option value=\"" +
          obj.id + "\">" + obj.name + "</option>");
        $("#add_person_form").hide();
        $("#show_add_person_btn").show();
      });
    });

    // Add a person's visit "temp as button"
    $("#add_visit").click(function(){
      var name = $("#add_s_name")
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
