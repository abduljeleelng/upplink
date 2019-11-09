$(document).ready(function () {
    $(document).on('click','.delete-button',function () {
        var id = $(this).attr('data-id');
        bootbox.confirm({
            message : "<h1> Are you Sure ?</h1>",
            buttons :{
                confirm :{
                    label : "<span class='glyphicon glyphicon-ok'></span> Yes",
                    className : "btn-danger"
                },
                cancel :{
                    label : "<span class='glyphicon glyphicon-erase'></span>No",
                    className: 'btn-primary'
                }
            },
            callback : function(result){
                if (result==true){
                    $.ajax({
                        url:"delete_endpoint",
                        type:"POST",
                        contentType:"json",
                        data :JSON.stringify({id:product_id}),
                        success:function (result) {
                            showProduct();
                        },
                        error:function (xhr,resp,text) {
                          //  console.log(xhr,resp,text);
                        }
                    });
                }
            }
        });
    });
});