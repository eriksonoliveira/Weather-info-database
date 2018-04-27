$(document).ready(function() {

  $(".user-edit-form").on("submit", function(e) {
    let form = $(this);
    saveUserInfo(e, form);
  });

});

function saveUserInfo(event, form) {
  event.preventDefault();
  //DOM elements
  let successMsg = $(".user-success-msg");
  let usrName = $(form).find("input[name=name]").val(),
      usrEmail = $(form).find("input[name=email]").val(),
      usrId = $(form).find("input[name=name]").attr("data-id"),
      usrPermissions;

  if($(form).find(".form-check").length > 0) {
    usrPermissions = $(form).find(".form-check").find("input:checked");
  }

  let data = new FormData();
  let path = "user/saveUserInfo";

  if(usrPermissions.length > 0) {
    let permission = "admin";
    data.append("permission", permission);
  } else {
    let permission = "user";
    data.append("permission", permission);
  }

  data.append("usrName", usrName);
  data.append("usrId", usrId);
  data.append("usrEmail", usrEmail);

  function callback(json) {
    console.log(json);
    $(successMsg).fadeIn();
  }


  let Update = new AjaxRequest(data);
  Update.call(path, callback);



}
