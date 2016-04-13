/**
 * Created by hung_it on 14/12/2014.
 */
$(function(){
    $('.profile-form').each(function(){
        $(this).submit(function(e)
        {
            var form = $(this);
            e.preventDefault();
            $.post(
                '/cp/profile/post-edit',
                form.serialize(),
                function(response)
                {
                    if(typeof response.code != undefined && response.code == 'success')
                    {
                        var msg = response.msg;
                        showSuccessDialog(form, 'Thông báo', msg);
                        $(form).find('label.error').remove();
                    }
                    if(typeof response.code != undefined && response.code == 'error')
                    {
                        var errors = response.errors;
                        $(form).find('input').each(function()
                        {
                            if(typeof  errors[$(this).attr('name')] != 'undefined')
                            {
                               $(this).addClass('error').after('<label for="'+$(this).attr('name')+'" class="error">'+errors[$(this).attr('name')]+'</label>')
                            }
                        });
                    }
                },'json'
            )
        })
    });
    /** Change avatar **/
    $('.submit-avatar').click(function()
        {
            var avatar = $('#user-avatar').val();
            if(avatar.trim() != '')
            {
                $.post(
                    '/cp/profile/post-edit',
                    {'avatar' : avatar},
                    function(response)
                    {
                    },
                    'json'
                );
            }
        }
    );
    $('button.get-avatar').click(function()
    {
        browserImageFile('user-avatar');
    });

    /** Create new user **/
    $('#create-user').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
          '/cp/admin/create-user',
            form.serialize(),
            function(response)
            {
                if(typeof response.code != undefined && response.code == 'error')
                {
                    var errors = response.errors;
                    $(form).bindErrors(errors);
                }
                if(typeof response.code != undefined && response.code == 'success')
                {
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_SUCCESS,
                        title: 'Thông báo',
                        message: 'Thêm mới thành viên thành công',
                        buttons: [ {
                            label: 'OK',
                            cssClass: 'btn-primary',
                            action: function(dialog){
                                dialog.close();
                                location.reload();
                            }
                        }]
                    });
                }

            },'json'
        );
    });
    /** Edit user **/
    $('.edit-user').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/admin/edit-user',
            form.serialize(),
            function(response)
            {
                if(typeof response.code != undefined && response.code == 'error')
                {
                    var errors = response.errors;
                    $(form).bindErrors(errors);
                }
                showDialog(response);
            },'json'
        );
    });
    /** Create group **/
    $('#create-group').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/admin/group',
            form.serialize(),
            function(response)
            {
                if(typeof response.code != 'undefined' && response.code == 'error')
                {
                    var errors = response.errors;
                    $(form).bindErrors(errors);
                }
                showDialog(response);
            },'json'
        );
    });
    /** Edit group **/
$('#edit-group').submit(function(e)
{
    e.preventDefault();
    var form = $(this);
    $.post(
        '/cp/admin/edit-group',
        form.serialize(),
        function(response)
        {
            if( typeof response.errors != 'undefined')
            {
                var errors = response.errors;
                $(form).bindErrors(errors);
            }
            showDialog(response);
        },'json'
    );
});

    /** Check all group privileges **/
$('input[type="checkbox"].parent').click(function(){
        var data =$(this).attr('rel');
        var el = $(this);
        if(typeof data != 'undefined')
        {
            $('input[type="checkbox"].children').each(function()
            {
                if(typeof $(this).attr('rel') != 'undefined' && $(this).attr('rel') == data)
                {
                    if($(el).is(':checked'))
                    {
                        $(this).attr('checked',true);
                    }
                    else
                    {
                        $(this).removeAttr('checked');
                    }

                }
            });
        }
    });

});


function confirmDeleteUser(id)
{
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Cảnh báo',
        message: 'Xóa thông tin thành viên sẽ không thể khôi phục lại',
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
              deleteUser(id);
            }
            },
            {
                label: 'CANCEL',
                cssClass: 'btn-warning',
                action: function(dialog){
                    dialog.close();
                }
            }
        ]
    });
}
function deleteUser(id)
{
    BootstrapDialog.confirm('Xóa thông tin thành viên sẽ không thể khôi phục lại', function(confirm)
    {
        if(confirm){
            $.post(
                '/cp/admin/delete-user',
                {id:id},
                function(rs)
                {
                    showDialog(rs);
                },'json'
            )
        }
        else
        {
            return;
        }
    });
}
function editUser(id)
{
    document.location.href = '/cp/admin/edit-user/' + id;
}

function deleteGroup(id)
{
    BootstrapDialog.confirm('Xóa thông tin nhóm thành viên sẽ không thể khôi phục lại', function(confirm)
    {
        if(confirm){
            $.post(
                '/cp/admin/delete-group',
                {id:id},
                function(rs)
                {
                    showDialog(rs);
                },'json'
            )
        }
        else
        {
            return;
        }
    });
}

function editGroup(id)
{
    if(!isNaN(id))
    {
        document.location.href = '/cp/admin/edit-group/' + id;
    }
}