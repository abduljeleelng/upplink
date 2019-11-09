$(document).ready(function () {
    $(document).on('click','.read-one-button',function () {
        var id = $(this).attr('data-id');
        $.getJSON('http://localhost/lara/staffA/api/staff/read_one?id='+id,function (data) {
            var read_one_html = '' +
                '<div id="read-product" class="btn btn-danger read-button pull-right">' +
                '<span class="glyphicon glyphicon-plus"></span> Read Staff' +
                '</div>';
            read_one_html += '<table class="table table-bordered">' +
                '<tr><td> Name</td><td>' + data.names +'</td></tr>' +
                '<tr><td>Department</td><td>'+ data.Department +'</td></tr>' +
                '<tr><td>Email</td><td>'+ data.email +'</td></tr>' +
                '<tr><td>Phone</td><td>'+ data.phone +'</td></tr>' +
                '<tr><td>Address</td><td>'+ data.Address +'</td></tr>' +
                '<tr><td>Salary </td><td>'+data.Salary +'</td></tr>' +
                '</table>';

            $("#page-content").html(read_one_html);
            changePageTitle("Read one Staff");
        });
    })
});