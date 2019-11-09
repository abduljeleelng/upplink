$(document).ready(function () {
   showStaff();
});
$(document).on('click','.read-button',function () {
    showStaff();
});

function showStaff() {
    $.getJSON('http://localhost/lara/staffA/api/staff/read', function (data) {
        var read_html = '' +
            '<div id="create-product" class="btn btn-success pull-right create-button">' +
            '<span class="glyphicon glyphicon-plus"></span> Create Staff' +
            '</div>' +
            '<table class="table table-bordered table-hover">' +
            '<tr>' +
            '<th>Names</th><th>Department</th><th>email</th><th>Phone Number</th> <th>Address</th><th>Salary</th>' +
            '<th>Action</th>' +
            '</tr>';
        $.each(data.record, function (key, val) {
            read_html += '' +
                '<tr>' +
                "<td>" + val.names + "</td>" +
                "<td>" + val.Department + "</td>" +
                '<td>' + val.email + '</td>' +
                '<td>' + val.phone + '</td>' +
                '<td>' + val.address + '</td>' +
                '<td>' + val.Salary + '</td>' +
                '<td>' +
                '<button class="btn btn-success read-one-button" data-id='+ val.id +'> Read </button>' +
                '<button class="btn btn-primary update-button" data-id='+val.id+'>Update</button>' +
                '<button class="btn btn-danger delete-button" data-id='+val.id +'>Delete</button> ' +
                '</td>' +
                '</tr>';
        });
       read_html +='</table>';
       $("#page-content").html(read_html);
       changePageTitle(" Read Staff ");
    });
}
