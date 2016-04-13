
function panda_show_loading()
{
	$('.panda-loading').show();
}

function panda_hide_loading()
{
	$('.panda-loading').hide();
}



function unsetFullScreen()
{
	// var thisHeight=$(window).height();

	$('.maximize-chat-panel').show();
	$('.minimize-chat-panel').hide();

  $('.panda-container').removeClass('panda-wrapper-row-fly');
  $('.panda-container').css('height','600px');

}


function setFullScreen()
{
	var thisHeight=$(window).height();

	$('.maximize-chat-panel').hide();
	$('.minimize-chat-panel').show();

  $('.panda-container').addClass('panda-wrapper-row-fly');
  $('.panda-container').css('height',thisHeight+'px');

}






$( document ).on( "click", "span.minimize-chat-panel", function() {

	unsetFullScreen();

});	

$( document ).on( "click", "span.maximize-chat-panel", function() {

	setFullScreen();

});	



    $(document).ready(function(){

        $('#btnGoto').click(function(){

        });

    });
