/* お気に入り掲示板に登録 */
function favorites(bbs_id){

    if(!confirm('お気に入り掲示板に登録します。\nよろしいですか？')){
        return;
    }

    var date = new Date();
    var timestamp = date.getTime();

    var params = { 'action_bbs_ajax' : true,
                   'mode' : 'favorites',
                   'bbs_id' : bbs_id,
                   'time' : timestamp
                 }

    return send_request(params);
}

/* 拍手を送る*/
function clap(bbs_id, bbs_comment_id, uniqid){

    if(!confirm('投票します。\nよろしいですか？')){
        return;
    }

    var date = new Date();
    var timestamp = date.getTime();

    var params = { 'action_bbs_ajax' : true,
                   'mode' : 'clap',
                   'bbs_id' : bbs_id,
                   'bbs_comment_id' : bbs_comment_id,
                   'uniqid' : uniqid,
                   'time' : timestamp
                }

    return send_request(params);
}

/* 不適切*/
function poor(bbs_id, bbs_comment_id, uniqid){

/*
    if(!confirm('投票します。\nよろしいですか？')){
        return;
    }
*/
    var date = new Date();
    var timestamp = date.getTime();

    var params = { 'action_bbs_ajax' : true,
                   'mode' : 'poor',
                   'bbs_id' : bbs_id,
                   'bbs_comment_id' : bbs_comment_id,
                   'uniqid' : uniqid,
                   'time' : timestamp
                }
    /* #7 Start Luvina Modify */
    var url = location.href; 
    url = url.split("/bbs/");
    url = url[0] + "/bbs/";
    location.href= url + '?action_bbs_violations_form=true&bbs_id='+params['bbs_id']+'&bbs_comment_id='+params['bbs_comment_id']+'&time='+params['time'];
    /* #7 End Luvina Modify */

    return;

/*
    return send_request(params);
*/

}

/* Ajax */
function send_request(params){

    // callback
    var processResponse = function(response){

        if(response==2){
            alert('すでに登録済みです。');
            return;
        }
        if(response==1){
            alert('登録しました。');

            // 不適切の場合は違反報告を行うかの確認を行う
            if(params['mode']=='poor'){
                if(confirm('「不適切」として登録しました。\nこの不適切な投稿内容に関して、\n管理者に違反報告を行いますか？')){
                    location.href='?action_bbs_violations_form=true&bbs_id='+params['bbs_id']+'&bbs_comment_id='+params['bbs_comment_id']+'&time='+params['time'];
                    return;
                }
            }

        }
        location.reload();
        return;
    }
    var notifyFailure = function(){
        alert("An error occurred.");
        return;
    }

    // Ajax
    $.ajax({
        'type' : "POST",
        'cache' : false,
        'data' : params,
        'success' : processResponse,
        'error' : notifyFailure
    });
}

/* #11 Start Luvina Modify */
function bbs_rate(bbs_id, bbs_comment_id, rate_flg) {
    var params = { 'action_ajax_bbsThanks' : true,
                   'bbs_id' : bbs_id,
                   'bbs_comment_id' : bbs_comment_id,
                   'rate_flg' : rate_flg,
                   'mode' : 'RATE'
                }

    // callback
    var processResponse = function(response){
        var result = response.content;
        _setdisplay(result);
    }

    var notifyFailure = function(){
        alert("An error occurred.");
        return;
    }

    // Ajax
    $.ajax({
        'type' : "POST",
        'url' : "/?action_ajax_bbsThanks=true",
        'cache' : false,
        'dataType' : 'json',
        'data' : params,
        'success' : processResponse,
        'error' : notifyFailure
    });
}

function bbs_thanks(bbs_id, bbs_comment_id) {
    if(!confirm('「ありがとう」を送ります。\nよろしいですか？\n※取り消せませんのでご注意ください。')){
        return;
    }

    var params = { 'action_ajax_bbsThanks' : true,
                   'bbs_id' : bbs_id,
                   'bbs_comment_id' : bbs_comment_id,
                   'mode' : 'THANKED'
                }

    // callback
    var processResponse = function(response){
        var result = response.content;
        _setdisplay(result);
    }

    var notifyFailure = function(){
        alert("An error occurred.");
        return;
    }

    // Ajax
    $.ajax({
        'type' : "POST",
        'url' : "/?action_ajax_bbsThanks=true",
        'cache' : false,
        'dataType' : 'json',
        'data' : params,
        'success' : processResponse,
        'error' : notifyFailure
    });
}

function _setdisplay(result) {
    if(result.list_thanked) {
        for(comment_id in result.list_thanked){
            $('#img_thanks_' + comment_id).css("display", "none");
            $('#img_thanked_' + comment_id).css("display", "block");
        }
    }

    if(result.limit_user_thanked) {
        for(entry_user in result.limit_user_thanked){
            $('.btn_thanks_' + entry_user).css("display", "none");
            $('.btn_thanked_' + entry_user).css("display", "block");
        }
    }

    if(result.list_rate) {
        for(comment_id in result.list_rate){
            $('#rate_flg_1_' + comment_id).text(result.list_rate[comment_id]);
        }
    }

    if(result.list_comment_post) {
        for(comment_id in result.list_comment_post){
            if(comment_id > 0) {
                $('#btn_rate_' + comment_id).html('<a class="e_btn_like2"> <img src="/img/bbs/btn_like2_hover.gif" alt="なるほど！" /> </a>');
                $('#link_rate_' + comment_id).css("display", "none");
            } else {
                $('#btn_rate_0').html(' <a class="e_btn_like"> <img src="/img/bbs/btn_like_hover.gif" alt="なるほど！" /> </a>');
                $('#link_rate_0').css("display", "none");
            }
        }
    }

    if(result.limit_max) {
        $('.btn_thanks').css("display", "none");
        $('.btn_thanked').css("display", "block");
    }
}
/* #11 End Luvina Modify */

/* #32 Start Luvina Modify */
function show_owner(bbs_id, bbs_comment_id, type_flg, uniqid) {
    if(!confirm('「本人のみ表示」をON/OFFします。\nよろしいですか？')){
        return;
    }

    var params = { 'action_ajax_bbs_bbsShowOwner' : true,
                   'bbs_id' : bbs_id,
                   'bbs_comment_id' : bbs_comment_id,
                   'type_flg' : type_flg,
                   'uniqid' : uniqid
                }

    // callback
    var processResponse = function(response){
        location.reload();
        return;
    }

    var notifyFailure = function(){
        alert("処理時に1つのエラーが発生してしまいました。");
        return;
    }

    // Ajax
    $.ajax({
        'type' : "POST",
        'url' : "/?action_ajax_bbs_bbsShowOwner=true",
        'cache' : false,
        'dataType' : 'json',
        'data' : params,
        'success' : processResponse,
        'error' : notifyFailure
    });
}

/* #32 End Luvina Modify */