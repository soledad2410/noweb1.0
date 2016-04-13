/**
 * Created by hung_it on 01/12/2014.
 */
$(function()
{
    $('#login-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
            /** Submit fom via ajax **/
            var defaultTxt = $(form).find('button[type="submit"]').html();
            $(form).find('button[type="submit"]').html('System logging...');
            $.post('/cp/login',$(this).serialize(),function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if(rs.code == 'false')
                    {
                        var errors = rs.errors;
                       $(form).find('input').each(function()
                       {
                           if(typeof  errors[$(this).attr('name')] != 'undefined')
                           {
                                $(this).parent().removeClass('success').addClass('has-error');
                                $(form).find('.help-block').html(errors[$(this).attr('name')]);
                           }
                       });
                    }
                    if(rs.code == 'success')
                    {
                        location.reload();
                    }
                    else{
                        $(form).find('button[type="submit"]').html(defaultTxt);
                    }
                }

            },'json');

    });
});