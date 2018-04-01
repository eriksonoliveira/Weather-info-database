$(document).ready(function() {

  $(".pass-forg-form").on("submit", function(e) {
    e.preventDefault();

    var data = new FormData();
    var email = $(this).find("input[type=email]").val();

    data.append("email", email);

    $.ajax({
      type: 'POST',
      url: 'http://localhost/projetoy/Monitoramento/ajax/pass_forgot',
      data: data,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(json) {
        $("#pass-forg-content").html(json.confirmation);
      }
    });

  });

});
