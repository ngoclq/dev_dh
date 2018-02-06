$(document).ready(function() {
	$("#tbl-mail").on("click", "td:not(:first-child)", function() {
		if (typeof _action_contacts_detail === 'undefined') {
			return true;
		}
		window.location = _action_contacts_detail.replace("_xxxx_xx_xxxx_", $(this).parent('tr').attr('_id'));
	});

	$("#tbl-mail").on("click", ".btn_red_action", function() {
		updateRed($(this));
	});

	$("#tbl-mail-info").on("click", ".btn_delete", function() {
		var _type = 1;
		var _id = $(this).parents('div.contact-info').attr('_id');
		alert(_id);
		if (typeof _action_contacts_delete === 'undefined' || _id === 'undefined') {
			return true;
		}
		if ($(this).hasClass('unred')) {
			_type = 0;
		}

		var d = new Date();
		var n = d.getTime();
		var formData = {
			'id' : _id,
			'type' : _type,
			'_n' : n
		};

		$.ajax({
			type : 'post',
			url : _action_contacts_delete,
			data : formData,
			dataType : 'json',
			encode : false,
			context: this,
			success : function(response) {
				if (response.result) {
					if ($(this).hasClass('unred')) {
						$(this).removeClass('active unred');
						$(this).parents('tr').removeClass('mail-hightlight');
					} else {
						$(this).addClass('active unred');
						$(this).parents('tr').addClass('mail-hightlight');
					}
				}
				
			},
			error : function(e) {
				alert("An error occurred: " + e.responseText.message);
			}
		});
	});
	
});

function updateRed($this) {
	var _type = 1;
	var _id = $($this).parents('tr').attr('_id');
	if (typeof _action_contacts_edit === 'undefined' || _id === 'undefined') {
		return true;
	}
	if ($($this).hasClass('unred')) {
		_type = 0;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'id' : _id,
		'type' : _type,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _action_contacts_edit,
		data : formData,
		dataType : 'json',
		encode : false,
		context: $this,
		success : function(response) {
			if (response.result) {
				if ($($this).hasClass('unred')) {
					$($this).removeClass('active unred');
					$($this).parents('tr').removeClass('mail-hightlight');
				} else {
					$($this).addClass('active unred');
					$($this).parents('tr').addClass('mail-hightlight');
				}
			}
			
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
		}
	});
}
