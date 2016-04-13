$(function(){
	// Get slug form name
	$('form input[name="name"]').change(function() {
        $('form input[name="slug"]').val(toAnsi($(this).val()));
    });
    $('select[name=parent_id] option').each(function(index, el) {
    	if($(el).attr('type') != 'album') {
    		$(el).attr('disabled', '');
    		$(el).css('cursor', 'not-allowed');
    		$(el).css('opacity', '0.5');
    	};
    });
    // Style categories trees
    $('ul.prod-cat li').each(function(){
        var level = (countParent($(this).find('a'))-1);
        var width = parseInt(level) * 10;
        $(this).find('span.tree-separator').css('width',width +'px');
    });
    $('select[name=parent_id] option').each(function(){
        var level = (countParentSelectBox(this)-1);
        var width = parseInt(level) * 20;
        $(this).css('padding-left',width +'px');
    });
    /** Sort album **/
    $("#galleries-list-table").rowSorter({
        handler: "td.sorter",
        // disabledRowClass: "child",
        onDrop: function(tbody, row, new_index, old_index) {
            var position = {};
            $('#galleries-list-table tbody tr').each(function(index, el) {
                position[$(el).attr('rel')] = index+1;
            });
            $.post('/cp/gallery/save-order', { position: position }, function(rs) {
                showDialog(rs);
            });
        }
    });
    /** Create new catalogue **/
    $('#add-catalogue-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/category/create',
            $(this).serialize(),
            function(rs)
            {
                if( rs.code == 'error')
                {
                    $(form).bindErrors(rs.errors);
                }
                if(rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
        )
    });
    /** Show cateluge edit form **/
    $('a.edit-catalogue').click(function(event) {
        var id = $(this).attr('data-value');
        $.post('/cp/category/get/'+id,{},function(rs) {
            if(typeof rs != 'undefined') {
                $('#edit-catalogue').show();

                bindFormData('#edit-catalogue',rs);

                BootstrapDialog.show({
                    'title' : 'Sửa chi tiết album',
                    'message' : $('#edit-catalogue'),
                    onhide: function() {
                        location.reload();
                    },
                });
            }
        });
    });
    /** Edit category form submit **/
    $('#edit-catalogue').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var id = form.find('input[name=id]').val();
        $.post('/cp/category/edit/'+id,
            $(this).serialize(),
            function(rs)
            {
                if( rs.code == 'error')
                {
                    $(form).bindErrors(rs.errors);
                }
                if(rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
            )
    });
    /** Delete catalogue **/
    $('button.delete-catalogue').click(function(){
        var id = $(this).closest('form').find('input[name="id"]').val();
        if(!isNaN(id)) {
            BootstrapDialog.confirm('Xóa thông tin ', function(confirm) {
                if(confirm){
                    $.post('/cp/category/delete',{id:id},function(rs) {
                            if(typeof rs.code != 'undefined') {
                                if(rs.code == 'success') {
                                  location.reload();
                                } else {
                                    showDialog(rs);
                                }
                            }
                        },'json');
                } else {
                    return;
                }
            });
        }
    });
    /** Show add form **/
    $('.add-gallery').click(function(event) {
        $('#add-gallery').show();
        BootstrapDialog.show({
            'title' : 'Thêm album mới',
            'message' : $('#add-gallery'),
            onhide: function() {
                location.reload();
            },
        });
    });
    // Add
	$('#add-gallery').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/gallery/create',
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
                    	location.reload();
                    }
                }
            }
        )
    });
    /** Delete **/
    $('a.delete').click(function(){
    	var id = $(this).attr('data-rel');
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog){
                    dialog.close();
                    $.post('/cp/gallery/delete',
                        {id:id},
                        function(rs) {
                            location.reload();
                        },'json'
                    )
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
    });
	/** Delete many **/
    $('button.remove').click(function(){
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog){
                    dialog.close();
                    $.post('/cp/gallery/delete',
                        $('#galleries-table-list').serialize(),
                        function(rs) {
                            location.reload();
                        },'json'
                    )
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
    });
    /** Show edit form **/
    $('tbody').on('click','.edit', function()
    {
        var id = $(this).attr('data-rel');
        var el = $(this);
        $.post('/cp/gallery/get',
            {id:id},
            function(rs)
            {
                if(typeof rs != 'undefined')
                {
                    $('#edit-form').show();
                    bindFormData('#edit-form',rs);
                    $('#image-thumb img').attr('src', rs.image);
                    BootstrapDialog.show({
                        'title' : 'Sửa album',
                        'message' : $('#edit-form'),
                         onhide: function(){
                          location.reload();
                        }
                    });
                }
            }
        );
    });
    // edit submit
    $('#edit-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        var id = form.find('input[name=id]').val();
        $.post(
            '/cp/gallery/edit/'+id,
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
function change_status (id, status) {
    if(!isNaN(parseInt(id)) && !isNaN(parseInt(status)))
    {
       $.post('/cp/gallery/edit/'+id,
           {id:id,status:status},
           function(rs){
               if(typeof rs != 'undefined'  && rs.code == 'success')
               {
                   location.reload();
               }
           },'json'
           );
   }
}
function countParent(el)
{
    var count = 1;
    var parent = $(el).attr('parent');
    if(typeof parent != 'undefined' && parent != 0)
    {
        count += countParent($('ul.prod-cat a[rel="'+parent+'"]'));
    }
    return count;
}
function countParentSelectBox(el) {
    var count = 1;
    if($(el).attr('parent')){

        var parent = $(el).attr('parent');
        if(parent != 0) {
            count += countParentSelectBox($('option[value="'+parent+'"]'));
        }
    }
    return count;
}
function showAddCateForm () {
	$('#add-catalogue-form').show();
    BootstrapDialog.show({
    	'title' : 'Thêm chuyên mục mới',
    	'message' : $('#add-catalogue-form'),
    	onhide: function() {
    		location.reload();
    	},
    });
}