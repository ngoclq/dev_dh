window.onload = function() {
    $('.list_read').css({
    'clear' : 'both','padding-top' : '2px'
    });
    $('.c_section_contents li.article:nth-child(1) .list_title').css({
    'float' : 'left','width' : '560px'
    });
    $('.c_section_contents li.article:nth-child(1) .list_photo').css({
    'background' : '#FFFFFF','border' : '1px solid #CCCCCC','float' : 'left','margin' : ' 0 10px 5px 5px','max-height' : '70px','overflow' : 'hidden','max-height' : '160px','padding' : '2px'
    });
    $('.c_section_contents li.article:nth-child(1) .list_photo img.pic_set').css({
    'width' : '76px','height' : 'auto'
    });
    $('.c_section_contents li.article:nth-child(n+2)').css({
    'height' : '250px','width' : '47%'
    });
    $('.c_section_contents li.article:nth-child(n+2) .list_read').css({
    'display' : 'block'
    });
    $('.c_section_contents li.article:nth-child(n+2) .carenew_title').css({
    'font-size' : '100%','font-weight' : 'bold','float' : 'left','width' : '190px'
    });
    $('.c_section_contents li.article:nth-child(n+2) .list_photo').css({
    'background' : '#FFFFFF','border' : '1px solid #CCCCCC','float' : 'left','margin' : '0 10px 5px 5px','padding' : '2px','max-heigh' : '45px','overflow' : 'hidden'
    });      
    $('.c_section_contents li.article:nth-child(n+2) .list_photo img.pic_set').css({
    'height' : 'auto','width' : '76px'
    });
}