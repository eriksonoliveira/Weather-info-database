"use strict";

$(document).ready(function () {

  $(".user-edit-form").on("submit", function (e) {
    var form = $(this);
    saveUserInfo(e, form);
  });
});

function saveUserInfo(event, form) {
  event.preventDefault();
  //DOM elements
  var successMsg = $(".user-success-msg");
  var usrName = $(form).find("input[name=name]").val(),
      usrEmail = $(form).find("input[name=email]").val(),
      usrId = $(form).find("input[name=name]").attr("data-id"),
      usrPermissions = void 0;

  if ($(form).find(".form-check").length > 0) {
    usrPermissions = $(form).find(".form-check").find("input:checked");
  }

  var data = new FormData();
  var path = "user/saveUserInfo";

  if (usrPermissions.length > 0) {
    var permission = "admin";
    data.append("permission", permission);
  } else {
    var _permission = "user";
    data.append("permission", _permission);
  }

  data.append("usrName", usrName);
  data.append("usrId", usrId);
  data.append("usrEmail", usrEmail);

  function callback(json) {
    console.log(json);
    $(successMsg).fadeIn();
  }

  var Update = new AjaxRequest(data);
  Update.call(path, callback);
}
