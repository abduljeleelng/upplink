$(document).ready(function () {
    $(document).on('click', '.create-button', function () {

            var create_html = 'hello Nigeria' +
                '<div id="read-staff" class="btn btn-success pull-right read-product-button">' +
                '<span class="glyphicon glyphicon-plus"></span> Read Staff' +
                '</div>';

            create_html += '<form id="create" action="#" method="post">' +
                '<table class="table table-bordered">' +
                '<tr><td>Name </td><td><input type="text" name="names" class="form-control" required></td></tr>' +
                '<tr><td>Address</td><td><input type="text" name="address" class="form-control" required></td></tr>' +
                '<tr><td>Phone Number</td><td><input type="text" name="phone" class="form-control" required></td></tr>' +
                '<tr><td>Department </td><td><input type="text" name="department" class="form-control" required></td></tr>' +
                '<tr><td>Email</td><td><input type="text" name="email" class="form-control" required></td></tr>' +
                '<tr><td>Salary</td><td><input type="text" name="salary" class="form-control" required></td></tr>' +
                '<tr><td></td><td><input type="submit" value="Create" class="btn btn-success"> </td></tr>' +
                '</table>' +
                '</form>';
            $("#page-content").html(create_html);
            changePageTitle("Create Staff");
            $(document).on('submit','#create',function () {
                var form_data = JSON.stringify($(this).serializeObject());
                console.log(form_data);
                $.ajax({
                    url : "http://localhost/lara/staffA/api/staff/create",
                    type : "POST",
                    contentType :"application/json",
                    data :form_data,
                    success : function (result) {
                        if (result){
                            alert("staff Created")
                        }
                        showStaff();
                    },
                    error : function (xhr,resp,text) {
                        console.log(xhr,resp,text);
                    }
                });
                return false;
            });
        });
    });
