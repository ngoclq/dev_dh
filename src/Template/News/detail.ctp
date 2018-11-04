<?php $this->assign('title', __($newsInfo['title'])); ?>
<?php $this->assign('css', $this->Html->css(['/asset/my_template/css/style.css'])); ?>
<?php $this->assign('script', $this->Html->script(['news.js', '/js/bootbox.min.js'])); ?>
<?php $this->assign('description', $newsInfo['keyword']) ?>
<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _url_action_relate = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getRelated', '_method' => 'GET']); ?>";
	var _url_action_top = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getTop', '_method' => 'GET']); ?>";
	var _url_action_latest = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getLatestNews', '_method' => 'GET']); ?>";
	var _url_action_category = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getNewsCategory', '_method' => 'GET']); ?>";
	var _url_action_comment = "<?= $this->Url->build(['controller' => 'News', 'action' => 'sendComment', '_method' => 'GET']); ?>";
	var _url_action_get_comment = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getComment', '_method' => 'GET']); ?>";
	var _category_id = "<?= $newsInfo['news_category_id']; ?>";
	var _id = "<?= $newsInfo['id']; ?>";
	var _locale = "<?= $language; ?>";
	/* ]]> */
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- ============================== contents Area ============================== -->

<div class="container">
    <div class="row col-mar-10">
        <div class="col-md-9">
            <div class="single">
                <img class="avatar img-responsive" src="theme/frontend/images/img15.jpg" alt="">
                <h1 class="title"><?= $newsInfo['title']; ?></h1>
                <div class="post-info">
                    <i class="fa fa-calendar"></i> <?= $newsInfo['created']->i18nFormat(__('TIMES_MINUTES')); ?> &nbsp;&nbsp;
                    <!--<i class="fa fa-comments"></i> 20-->
                </div>
                <div class="des"> <?= mb_substr(strip_tags($newsInfo['body']), 0, 200) ?>... </div>
                <!-- Đặt thẻ này vào phần đầu hoặc ngay trước thẻ đóng phần nội dung của bạn. -->
                <script src="https://apis.google.com/js/platform.js" async defer>
                    {lang: 'vi'}
                </script>
                <div class="s-content"><?= $newsInfo['body']; ?></div>
                <!--<div class="s-author text-right"><i class="fa fa-pencil"></i> Author </div>-->
            </div>

            <?php if(!empty($aryKeyword)) { ?>
            <div class="s-tag">
                <?php foreach ($aryKeyword as $key => $keyword) { ?>
                <a class="smooth" href="#" title="<?= $keyword ?>"><?= $keyword ?></a>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="s-social">
                <!--<a class="butn like smooth" href="#" title=""><i class="fa fa-heart"></i>Quan tâm <span>14</span></a>-->
                <a class="butn facebook smooth" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $newsInfo['id']], true); ?>" title=""
                   onclick="popUp=window.open(
				            'http://www.facebook.com/sharer.php?u='+ this.href,
				            'popupwindow',
				            'scrollbars=yes,width=400,height=500');
				            popUp.focus();
				            return false">
                    <i class="fa fa-facebook"></i>Chia sẻ Facebook
                </a>
                <a class="butn google smooth" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $newsInfo['id']], true); ?>" title=""  onclick="popUp=window.open(
			                'https://plus.google.com/share?url='+ this.href,
			                'popupwindow',
			                'scrollbars=yes,width=500,height=400');
			                popUp.focus();
			                return false" >
                    <i class="fa fa-google-plus"></i>Chia sẻ Google
                </a>

                <!--<div class="fb-like" data-href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $newsInfo['id']]); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>-->
                <!-- Đặt thẻ này vào nơi bạn muốn nút chia sẻ kết xuất. -->
                <!--<div class="g-plus" data-action="share"></div>-->
                &nbsp;&nbsp;&nbsp;
                <a class="smooth" href="mailto:<?= __('COMPANY_EMAIL')?>" title=""><i class="fa fa-envelope"></i></a>&nbsp;&nbsp;&nbsp;
                <a class="smooth" href="javascript:window.print();" title=""><i class="fa fa-print"></i></a>
            </div>
            <div class="s-comment">
                <div class="fb-comments" data-href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $newsInfo['id']], true); ?>" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
        <div class="col-md-3">
            <!--<div class="sidebar">
                <h3 class="h-title"><span>Bài viết mới</span></h3>
                <div class="sb-ct">
                    <div class="sd-post clearfix">
                        <a class="img" href="#" title="">
                            <img src="theme/frontend/images/img16.jpg" alt="" title=""/>
                        </a>
                        <div class="ct">
                            <a class="cate smooth" href="#" title="">Hạnh phúc</a>
                            <p class="title"><a class="smooth" href="#" title="">Giáo sư Ngô Bảo Châu: “ Đừng băn khoăn về vật chất khi chọn nghề giáo"</a></p>
                        </div>
                    </div>
                    <div class="sd-post clearfix">
                        <a class="img" href="#" title="">
                            <img src="theme/frontend/images/img16.jpg" alt="" title=""/>
                        </a>
                        <div class="ct">
                            <a class="cate smooth" href="#" title="">Hạnh phúc</a>
                            <p class="title"><a class="smooth" href="#" title="">Giáo sư Ngô Bảo Châu: “ Đừng băn khoăn về vật chất khi chọn nghề giáo"</a></p>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>
    </div>
<!--
    <h2 class="h-title"><span>Bạn nên đọc</span></h2>
    <br>
    <div class="row row-ibl">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="sm-post v3">
                <a class="c-img smooth" href="#" title="">
                    <img src="theme/frontend/images/img4.jpg" alt="" title=""/>
                </a>
                <h3 class="title"><a class="smooth" href="#" title="">Đừng nói về cuộc chiến hãy nói về con người trên đây</a></h3>
                <div class="post-info">
                    <i class="fa fa-calendar"></i> 16/06/2017 &nbsp;&nbsp;
                    <i class="fa fa-comments"></i> 20
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="sm-post v3">
                <a class="c-img smooth" href="#" title="">
                    <img src="theme/frontend/images/img5.jpg" alt="" title=""/>
                </a>
                <h3 class="title"><a class="smooth" href="#" title="">Đừng nói về cuộc chiến hãy nói về con người trên đây</a></h3>
                <div class="post-info">
                    <i class="fa fa-calendar"></i> 16/06/2017 &nbsp;&nbsp;
                    <i class="fa fa-comments"></i> 20
                </div>
            </div>
        </div>
    </div>-->
</div>
