/**
 * Created by hung_it on 25/12/2014.
 */
$(function()
{


    $('#add-tag').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/tags/create',
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
                        var str = '<tr class="gradeA">';
                            str += '<td class="center open-detail"><span data-value="'+rs.tag.id+'"></span></td>';
                            str += '<td class="">'+rs.tag.name+'</td>';
                            str += '<td class=" ">'+rs.tag.slug+'</td>';
                            str += '<td class="hidden-phone "></td>';
                            str += '<td class="center"><a class="edit-tag" data-value="'+rs.tag.id+'" href="javascript:void(0)">Sửa</a></td>';
                            str += '<td class="center"><a class="del-tag" data-value="'+rs.tag.id+'" href="javascript:void(0)">Xóa</a></td>';
                            str += '</tr>';
                        $('.tags-list-table tbody').prepend(str);
                    }
                }
            }
        )
    });
    $('form input[name="name"]').change(function()
    {
       $('form input[name="slug"]').val(toAnsi($(this).val()));
    });
    $('tbody').on('click','span',function()
    {
        var parent = $(this).parent();

        if($(parent).hasClass('close-detail'))
        {
            $(parent).removeClass('close-detail');
            $(parent).parent().next('tr.description').hide();
        }
        else
        {
            $(parent).addClass('close-detail');
            if($(parent).parent().next('tr.description').length > 0)
            {
                $(parent).parent().next('tr.description').show();
            } else {
                var id = $(this).attr('data-value');
                $.post('/cp/tags/get',{id: id},function(rs){
                    if(typeof rs != 'undefined')
                    {
                        var content ='<tr class="description"><td class="details" colspan="6"><table cellspacing="0" cellpadding="5" border="0" style="padding-left:50px;"><tbody><tr><td></td><td>'+rs.description+'</td></tr></tbody></table></td></tr>';
                        $(parent).parent().after(content);
                    }
                },'json')
            }
        }
    });
    /** Delete tag **/
    $('tbody').on('click','.del-tag', function()
    {
        var id = $(this).attr('data-value');
        var el = $(this);
        BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
        {
            if(confirm){
                $.post(
                    '/cp/tags/delete',
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

    /** Edit tag **/
    $('tbody').on('click','.edit-tag', function()
    {
        var id = $(this).attr('data-value');
        var el = $(this);
        $.post('/cp/tags/get',
            {id:id},
            function(rs)
            {
                if(typeof rs != 'undefined')
                {
                    $('#edit-tag').show();
                    bindFormData('#edit-tag',rs);
                    BootstrapDialog.show({
                        'title' : 'Sửa tag',
                        'message' : $('#edit-tag'),
                         onhide: function(){
                          location.reload();
                        }
                    });
                }
            }
        );
    });
    $('#edit-tag').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/tags/edit',
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


