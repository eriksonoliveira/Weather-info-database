$(document).ready(function() {

  //Get users and show table
  getUsers();

});

function getUsers() {
  //DOM elements
  let tableWraper = $(".users-table");

  let data = {};
  let path = "admin/users";

  function callBack(json) {
    let tableHtml = "";

    tableHtml+="<table class='table table-hover'>";
      tableHtml+="<thead class=''>";
        tableHtml+="<tr>";
          tableHtml+="<th scope='col-5' width='40%'>Nome</th>";
          tableHtml+="<th scope='col-4' width='40%'>Função</th>";
          tableHtml+="<th scope='col-3' width='20%'>Permissões</th>";
        tableHtml+="</tr>";
      tableHtml+="</thead>";
      tableHtml+="<tbody>";
      //Create rows for each user
      for(i in json.users) {
        tableHtml+="<tr>";
          tableHtml+="<td><a href='http://localhost/projetoy/Monitoramento/user/?usr="+json.users[i].id+"'>"+json.users[i].nome+"</a></td>";
          tableHtml+="<td>"+json.users[i].funcao+"</td>";
          tableHtml+="<td>"+json.users[i].permissoes+"</td>";
        tableHtml+="</tr>";

        console.log(json.users[i].nome);

      }
      tableHtml+="</tbody>";
    tableHtml+="</table>";
    tableHtml+="";









    $(tableWraper).append(tableHtml);
  }

  let users = new AjaxRequest(data);
  users.call(path, callBack);
}










