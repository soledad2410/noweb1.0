$(function() {
	/** Add new */
	$('#add').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/product-properties/create',
            form.serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        var str = '<tr>';
                            str += '<td class="center">'+rs.pp.id+'</td>';
                            str += '<td>'+rs.pp.name+'</td>';
                            str += '<td>'+rs.pp.title+'</td>';
                            str += '<td class="center">';
                            str += '<a class="btn btn-xs btn-primary edit" href="javascript:;" data-rel="'+rs.pp.id+'"><i class="icon-pencil"></i></a>';
                            str += '<a href="javascript:;" data-rel="'+rs.pp.id+'" class="btn btn-xs btn-danger delete"><i class="icon-remove"></i></a></td>';
                            str += '</tr>';
                        $('#list-table tbody').prepend(str);
                        form.clearForm();
                    }
                }
            }
        )
    });
	/** Delete */
    $('tbody').on('click','.delete', function()
    {
        var id = $(this).attr('data-rel');
        var el = $(this);
        BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
        {
            if(confirm){
                $.post(
                    '/cp/product-properties/delete',
                    {id:id},
                    function(rs)
                    {
                        if(typeof rs.code != 'undefined')
                        {
                            if(rs.code == 'success')
                            {
                                $(el).parent().parent().remove();
                            } else {
                                showDialog(rs);
                            }
                        }
                    },'json'
                )
            }
            else
            {
                return;
            }
        });
    });
    /** Show edit form */
    $('tbody').on('click','.edit', function()
    {
        var id = $(this).attr('data-rel');
        var el = $(this);
        $.post('/cp/product-properties/get',
            {id:id},
            function(rs)
            {
                if(typeof rs != 'undefined')
                {
                    $('#edit').show();
                    bindFormData('#edit',rs);
                    BootstrapDialog.show({
                        'title' : 'Sửa thuộc tính sản phẩm',
                        'message' : $('#edit'),
                         onhide: function(){
                          // location.reload();
                        }
                    });
                }
            }
        );
    });
    /** Edit submit */
    $('#edit').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/product-properties/edit',
            form.serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        showDialog(rs);
                    }
                }
            },'json'
        )
    });
});

function change_status(id, status) {
    if(!isNaN(id))
    {
        $.post('/cp/product-properties/edit', {id:id,status:status}, function(data) {
            if (data.code == 'error') {
                showDialog(data);
            } else {
                location.reload();
            };
        }, 'json');
    }
}