$(document).ready(function() {
	getListComment();
	getNewsSuggest();
	getLatest();
	getRelated();
	getTop();
	getListCategory();
	$(document).on('click', 'form#form_comment #btn_submit', function() {
		getSendComment();
	});
	/*$(document).on('click', '.btn_signup', function() {
		alert('A');
		return false;
	});*/
});

function getRelated() {
	if (typeof _url_action_relate === 'undefined'
			|| typeof _category_id === 'undefined'
			|| typeof _id === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'categoryId' : _category_id,
		'id' : _id,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_relate,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			if (response.result) {
				for(var info in response.data) {
					var object = $(".e_news_relate_list_templatte.items_hiden").clone();
					object.removeClass("e_news_relate_list_templatte items_hiden");
					object.find('a.title').html(response.data[info].title);

					var href = object.find('a').attr('href');
					href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
					object.find('a').attr('href', href);
					//object.find('p.content').html(response.data[info].body);
					object.appendTo("ul.box-newslist.box-news-related");
				}
			} else {
				$(".box-news-related").addClass("items_hiden");
			}
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function getTop() {
	if (typeof _url_action_top === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_top,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			if (response.result) {
				for(var info in response.data) {
					var object = $("li.top_news_list_templatte.items_hiden").clone();
					object.removeClass("top_news_list_templatte items_hiden");
					if (parseInt(info) <= 2) {
						object.find('span.sub_ranking_icon').addClass("sub_ranking_icon_1").html(parseInt(info) + 1);
					} else {
						object.find('span.sub_ranking_icon').addClass("sub_ranking_icon_2").html(parseInt(info) + 1);
					}
					var href = object.find('.c_list_inner a').attr('href');
					href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
					object.find('.c_list_inner a').html(response.data[info].title).attr('href', href);
					object.appendTo(".box-news-ranking ol.c_list_article");
				}
			} else {
				$(".box-news-ranking").addClass("items_hiden");
			}
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function getNewsSuggest() {
	if (typeof _url_action_latest === 'undefined'
			|| typeof _id === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'id' : _id,
		'topFlag' : 1,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_latest,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			if (response.result) {
				for(var info in response.data) {
					var object = $("section.box-news-suggest .c_list_article li.items_hiden").clone();
					object.removeClass("items_hiden");
					var href = object.find('a').attr('href');
					href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
					object.find('a').html(response.data[info].title).attr('href', href);
					object.appendTo("section.box-news-suggest .c_list_article");
					$("section.box-news-suggest .view-more").removeClass("items_hiden");
				}
			} else {
				$(".box-news-suggest").addClass("items_hiden");
			}
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function getLatest() {
	if (typeof _url_action_latest === 'undefined'
			|| typeof _id === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'id' : _id,
		'topFlag' : 0,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_latest,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			if (response.result) {
				for(var info in response.data) {
					var object = $("section.box-news-latest .c_list_article li.items_hiden").clone();
					object.removeClass("items_hiden");
					var href = object.find('a').attr('href');
					href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
					object.find('a').html(response.data[info].title).attr('href', href);
					object.appendTo("section.box-news-latest .c_list_article");
					$("section.box-news-latest .view-more").removeClass("items_hiden");
				}
			} else {
				$(".box-news-latest").addClass("items_hiden");
			}
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function getListCategory() {
	if (typeof _url_action_category === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'topFlag' : 0,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_category,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			if (response.result) {
				for(var info in response.data) {
					var object = $("section.box-news-menu-other .c_list_article li.items_hiden").clone();
					object.removeClass("items_hiden");

					var href = object.find('a').attr('href');
					href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
					object.find('a').html(response.data[info].title).attr('href', href);

					//object.find('a').attr('href', '/news/index/' + response.data[info].id).html(response.data[info].title);
					object.appendTo("section.box-news-menu-other .c_list_article");
				}
			} else {
				$("section.box-news-menu-other").addClass("items_hiden");
			}
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function getListComment() {
	if (typeof _url_action_get_comment === 'undefined') {
		return true;
	}

	var d = new Date();
	var n = d.getTime();
	var formData = {
		'news_id' : _id,
		'locale': _locale,
		'_n' : n
	};

	$.ajax({
		type : 'post',
		url : _url_action_get_comment,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			cloneComment(response);
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

function cloneComment(response) {
	if (response.result) {
		for(var info in response.data) {
			var object = $(".article-comment.items_hiden").clone();
			object.removeClass("items_hiden");
			object.find('h2').attr('name', response.data[info].id).html(response.data[info].title);
			object.find('.e_article_inner_respons p').html(response.data[info].body);
			object.find('time').html(response.data[info].created);
			object.find('a.user_name').html(response.data[info]['Users'].first_name);

			/*var href = object.find('a').attr('href');
			href = href.replace("_xxxx_xx_xxxx_", response.data[info].id);
			object.find('a').html(response.data[info].title).attr('href', href);*/

			//object.find('a').attr('href', '/news/index/' + response.data[info].id).html(response.data[info].title);
			object.appendTo(".box-news-comment");
		}
	} else {
		$("section.box-news-menu-other").addClass("items_hiden");
	}
}


function getSendComment() {
	if (typeof _url_action_comment === 'undefined'
			|| typeof _id === 'undefined') {
		return true;
	}

	for ( instance in CKEDITOR.instances ) {
		CKEDITOR.instances[instance].updateElement();
	}

	var formData = $('form#form_comment').serialize();

	$.ajax({
		type : 'post',
		url : _url_action_comment,
		data : formData,
		dataType : 'json',
		encode : true,
		beforeSend : function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success : function(response) {
			cloneComment(response);
		},
		error : function(e) {
			alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});
}

