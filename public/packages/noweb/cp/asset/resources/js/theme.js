$(function(){
	$('#position').change(function(){
		var val = $(this).val();
		$.post('/cp/template/widgetconfig',{'type' : val},function(rs){
			$('#widget-config').html(rs);
		},'json');
	});
});

function addWidget()
{
	 $('#add-widget').show();
    BootstrapDialog.show({
        'title' : 'Thêm mới khối nội dung',
        'message' : $('#add-widget'),
         onhide: function(){
          location.reload();
        }
    });
}