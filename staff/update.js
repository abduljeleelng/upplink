$(document).ready(function () {
    $(document).on('click','.update-button',function () {
        var id = $(this).attr('data-id');

        $.getJSON('http://localhost/lara/staffA/api/staff/read_one?id='+id,function (data) {
            var id = data.id;
            var name = data.names;
            var phone= data.phone;
            var address = data.address;
            var update_html ='' +
                '<div id="read-product" class="btn btn-primary read-button pull-right">' +
                '<span class="glyphicon glyphicon-plus"></span> Read Staff' +
                '</div>';
               update_html +='<form id="update-form" action="#" method="POST" >' +
                   '<table class="table table-bordered">' +
                   '<tr><td><input type="hidden" name="id" value='+id+'></td></tr>' +
                   '<tr><td>Name</td><td><input type="text" class="form-control" name="names" value='+name+'></td></tr>' +
                   '<tr><td>Phone</td><td><input type="text" class="form-control" name="phone" value='+phone+'></td></tr>' +
                   '<tr><td>Address</td><td><input type="text" class="form-control" name="address" value='+address+'></td></tr>' +
                   '<tr><td></td><td><input type="submit" class="btn btn-primary" value="Update"></td></tr>' +
                   '</table>' +
                   '</form>';
                $("#page-content").html(update_html);
                changePageTitle("Update Staff Record");
                $(document).on('submit',"#update-form",function () {
                    var form_data = JSON.stringify($(this).serializeObject());
                    //console.log(form_data);
                   // var data = JSON.stringify($("#update-form").serializeArray());
                   //console.log( data );
                    $.ajax({
                        url:"http://localhost/lara/staffA/api/staff/update",
                        type:"POST",
                        contentType :"application/json",
                        //contentType:'text',
                        data:form_data,
                        //data:{"id":"3","names":"Testing Updating", "phone":"0900000000000","address":"4th Assib house"},
                        success:function (result) {
                            console.log(result);
                            if (result){
                                alert("Staff successful updated");
                            }
                            showStaff();
                        },
                        error:function (xhr,resp,text) {
                            alert("unable to update Staff");
                            console.log(xhr,resp,text);
                           showStaff();
                        }
                    });
                    return false;
                });
            });
        });

    });