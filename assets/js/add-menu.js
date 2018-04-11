function RegistryForm() {
    this.targ;
    this.parentDiv = $(".menu-box");
    this.arrow = $(".prev");
  }

  RegistryForm.prototype = {
    constructor: RegistryForm,
    toggleMenus: function(id) {
      this.targ = $("#"+id);
      $([this.parentDiv, this.targ, this.arrow]).each(function() {
        $(this).toggle("fast");
      });
    }
}

$(document).ready(function() {

  var form = new RegistryForm();

  $(".menu-btn").on("click", function(e) {
    e.preventDefault();

    let id = $(this).attr("href");

    form.toggleMenus(id);
  });

  $(".prev").on("click", function() {
    let id = $('.menu-input-form[style="display: block;"]').attr("id");
    form.toggleMenus(id);
  });

});
