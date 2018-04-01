$(document).ready(function() {

  $(".pass-recov-form").on("submit", function(e) {
    e.preventDefault();

    var data = new FormData(),
        pass1 = $(this).find("input[name=password1]").val(),
        pass2 = $(this).find("input[name=password2]").val(),
        userID = $(this).find("input[name=password1]").attr("data-id");

    if(pass1 == pass2) {

      data.append("newPass", pass1);
      data.append("userID", userID);

      $.ajax({
        type: 'POST',
        url: 'http://localhost/projetoy/Monitoramento/ajax/pass_recovery',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {
          $("#pass-recov-content").html(json.confirmation);
        }
      });
    }

  });

});
