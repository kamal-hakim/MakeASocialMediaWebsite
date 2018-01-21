$(document).ready(function() { //target the document, when it is ready

  //On click signup, hide login and show registration form
  $("#signup").click(function() {
    $("#first").slideUp("slow", function() {
      $("#second").slideDown("slow");
    });
  });

  //On click login, hide signup and show login form
  $("#signin").click(function() {
    $("#second").slideUp("slow", function() {
      $("#first").slideDown("slow");
    });
  });
});
