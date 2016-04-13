$(function() {
	// Send users status
    send_users_status(10000);
    // Set visitors info
    set_visitors_info();
});

function send_users_status (time) {
    $.get('/api/users-online', function(data) {});
    setTimeout(function() {
        send_users_status(time);
    }, time);
}
function set_visitors_info () {
	$.get('/api/visitors?action=set', function(data) {});
}