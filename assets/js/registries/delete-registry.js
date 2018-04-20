$(document).ready(function() {

  //GET AND FORMAT DATE
  var separator = "dash";
  var date;

  //Check if GET date variable was passed
  date = getQueryVariable();

  if(date === false) {
    //If not, use the date of the current day
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
    url: 'http://localhost/projetoy/Monitoramento/ajax',
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
function deleteSystem(checkbox, date) {
  let id = $(checkbox).attr("data-id");
  let path = "ajax/deleteSystem";

  function callback(json) {
//    return true;
    console.log(json);
  }

  let data = {
    systemId: id,
    date: date
  };

  let Delete = new AjaxRequest();
  Delete.setData(data);
  Delete.call(path);
}
