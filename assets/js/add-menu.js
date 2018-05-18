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
        $(this).toggleClass("active");
      });
    });
  });

  //Hide form and show menu if click on back button
  $(backBtn).on("click", function() {
    let id = $('.menu-input-form[class*="active"]').attr("id");
    id = $("#"+id);

    $(backBtn).toggleClass("active");
    $(id).toggleClass("active");
    $(menu).fadeToggle();
  });

});
