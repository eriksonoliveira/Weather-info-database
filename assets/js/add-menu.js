$(document).ready(function() {

  var backBtn = $(".back"),
      menu = $(".menu-box");

  //Hide menu on click
  $(".menu-btn").on("click", function(e) {
    e.preventDefault();

    let id = $(this).attr("href");

    id = $("#"+id);

    $(menu).fadeToggle("fast", function() {
      $([id, backBtn]).each(function(){
        $(this).fadeToggle();
      });
    });
  });

  //Hide form and show menu if click on back button
  $(backBtn).on("click", function() {
    let id = $('.menu-input-form[style="display: block;"]').attr("id");
    id = $("#"+id);

    $(backBtn).fadeToggle("fast");
    $([id]).each(function() {
      $(this).fadeToggle("fast", function() {
        $(menu).fadeToggle();
      });
    });
  });

});
