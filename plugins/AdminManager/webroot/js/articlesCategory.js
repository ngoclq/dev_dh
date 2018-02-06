$(document).ready(function() {
	$(document).on("click", ".btnAction", function() {
		var rel = $(this).attr('rel');
		var handle = $(this).attr('_handle');
		var val = $(this).attr('val');
		var targeturl = window[rel];

		if (typeof targeturl === 'undefined'
				|| typeof handle === 'undefined'
				|| typeof val === 'undefined') {
			return true;
		}
		var d = new Date();
		var n = d.getTime();
		var formData = {
			'handle' : handle,
			'id' : val,
			'_n' : n
		};

		$.ajax({
			type : 'post',
			url : targeturl,
			data : formData,
			dataType : 'json',
			encode : true,
			beforeSend : function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success : function(response) {
				if (response.result) {
					var handle = response.handle;
					var id = response.id;
					if('del' == handle) {
						$('tr#id-' + id).remove();
					} else {
						$('.items-id-' + id).toggleClass( "items_hiden", 1000, "easeOutSine" );
					}
				} else {
					if (response.message) {
						alert(response.message);
					}
				}
			},
			error : function(e) {
				alert("An error occurred: "
						+ e.responseText.message);
				console.log(e);
			}
		});
	});
	
	
	
	
	
}); // close of $(document).ready(function() {
