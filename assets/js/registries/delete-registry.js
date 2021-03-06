$(document).ready(function() {
  //date is passed as a global variable
  //If no date was passed, use the date of the current day
  if(date === false) {
    let separator = "dash";
    date = dateFormated(separator);
  }

  //DELETE IMAGE
  $(".img-del").on("click", function() {
    var imgDel = $(this);

    //Show confirmation alert
    modal(imgDel, 2);

    //Delete Image
    $(document).on("click", ".modal-del-confirm", function() {
        deleteImg(imgDel);
    });
  });

  //DELETE WEATHER SYSTEM
  $(".fenom input[type=checkbox]").change(function() {
    if(this.checked == false) {
      let checkbox = $(this);
      deleteSystem(checkbox, date);
    }
  });
});

//Select image ID and send AJAX request
function deleteImg(del) {
  var data = new FormData();

  var im = $(del).parent().siblings("a").find("img"),
      imgID = $(im).attr("id"),
      successMsg = $(del).parents(".img-wrap").next(".sucesso-msg"),
      inputWrap = $(del).parents(".img-wrap").prev(".reg-form").find(".input-btn-wrap");

  data.append("imgID", imgID);

  $.ajax({
    type: 'POST',
    url: baseUrl+'ajax',
    data: data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(json) {

      if(json.success = "yes") {

        //Show message and hide it after 3 seconds
        $(successMsg).html("Imagem removida com sucesso!");
        setTimeout(function() {
            $(successMsg).fadeOut();
        }, 3000);

        //remove image thumbnail
        $(im).remove();
        $(inputWrap).show();
        $(".bg-box, .modal-box").fadeOut("fast");

      }
    }
  });
}

//Delete Weather phenomena
function deleteSystem(checkbox, regDate) {
  let id = $(checkbox).attr("data-id");

  let path = "ajax/deleteSystem";
  let data = new FormData();
  let dataObj = {
    systemId: id,
    date: regDate
  };

  data.append("systemData", JSON.stringify(dataObj));

  //Make ajax request to delete system
  let Delete = new AjaxRequest(data);
  Delete.call(path);
}
