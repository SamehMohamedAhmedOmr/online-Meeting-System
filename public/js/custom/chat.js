

  $(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");

	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};

	$("#status-options").removeClass("active");
});

function newMessage() {
    var currentDate = new Date();
    var date = currentDate.getDate();
    var month = currentDate.getMonth(); //Be careful! January is 0 not 1
    var year = currentDate.getFullYear();
    var hour = currentDate.getHours();
    var mintues = currentDate.getMinutes(); //Be careful! January is 0 not 1
    var seconds = currentDate.getSeconds();
    $value = $('#message').val();

    $user = $('#toPush').data('id');
    $dateString = year + "-" + (month + 1) + "-" + date + " " + hour + ":" + mintues + ":" + seconds;
    $def = $('#toPush').data('def');
    $i = $('#toPush').data('i');

    if ($value!=null) {
        $.ajax({
            type: 'get',
            url: '/firebase/' + $def,
            data: {
                'message': $value,
                'user_id': $user,
                'date': $dateString,
                'id': $i

            },

            success: function (data) {

                    $('<li class="sent"><p>' + $value + '</p></li>').appendTo($('.messages ul'));
                    $('.message-input input').val(null);

                    $('.contact.active .preview').html('<span>You: </span>' + message);
                    $(".messages").scrollTop($('.messages').prop("scrollHeight"));
                },
                 function (error) {
                    console.log("Error: " + error.code);
                }});


        }
    };






