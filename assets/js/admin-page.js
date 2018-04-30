$(document).ready(function() {

  //Get users' names and render table
  getUsers();

});

function getUsers() {
  //DOM elements
  let tableWraper = $(".users-table");

  let path = "admin/users";
  let data = new FormData();
  let page = 1;

  data.append("page", page);

  function getData(json) {
    let table = renderTable(json);
    $(tableWraper).append(table);

    //Create paginantion
    pageNumbers(json);
  }

  //Get users' names
  let users = new AjaxRequest(data);
  users.call(path, getData);
}

//Pagination
function pageNumbers(json) {
  let $pagination = $(".users-table-pagination ul");

  let totalPages = Math.ceil(json.users.num_pages),
      defaultOpts = {
        totalPages: totalPages,
        visiblePages: 5,
        first: 'Primeira',
        prev: 'Anterior',
        next: 'Próxima',
        last: 'Última',
        onPageClick: function(event, page) {
          getNewData(page);
      }
      };

  $pagination.twbsPagination('destroy');
  $pagination.twbsPagination($.extend({}, defaultOpts));

}

//Get New Data
function getNewData(page) {
  //DOM elements
  let tableWraper = $(".users-table");

  let data = new FormData();
  let path = 'admin/users';

  data.append('page', page);

  function newData(json) {
    let table = renderTable(json);
    $(tableWraper).html(table);
  }

  let users = new AjaxRequest(data);
  users.call(path, newData);
}

function renderTable(json) {
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
    for(let i in json.users.data) {
      tableHtml+="<tr>";
        tableHtml+="<td><a href='"+baseUrl+"user/?usr="+json.users.data[i].id+"'>"+json.users.data[i].nome+"</a></td>";
        tableHtml+="<td>"+json.users.data[i].funcao+"</td>";
        tableHtml+="<td>"+json.users.data[i].permissoes+"</td>";
      tableHtml+="</tr>";
    }
    tableHtml+="</tbody>";
  tableHtml+="</table>";

  return tableHtml;
}





