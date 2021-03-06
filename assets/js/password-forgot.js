"use strict";

$(document).ready(function () {

  $(".pass-forg-form").on("submit", function (e) {
    e.preventDefault();

    var data = new FormData();
    var email = $(this).find("input[type=email]").val();

    data.append("email", email);

    $.ajax({
      type: 'POST',
      url: baseUrl + 'ajax/pass_forgot',
      data: data,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function success(json) {
        $("#pass-forg-content").html(json.confirmation);
      }
    });
  });
});
