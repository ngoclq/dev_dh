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

<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $newsInfo['title']; ?>
                    <br>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid d-block" src="https://pingendo.com/assets/photos/wireframe/photo-1.jpg">
            </div>
            <div class="col-md-9">
                <p class="text-justify"><?= $newsInfo['body']; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="lead"><?= __('NEWS_RELATED') ?></p>
            </div>
        </div>
    </div>
</div>
<div class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="box-newslist box-news-related">
                    <li class="e_news_relate_list_templatte items_hiden">
                        <a class="title" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', '_xxxx_xx_xxxx_']); ?>"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="contents" class="cf">
	<div id="main">
		<section class="c_section_contents">
			<div class="cf  title">
				<p
					style="font-size: 0.85em; color: #47885e; margin: -20px 0 10px 10px;">
					<?= $newsInfo['created']->i18nFormat(__('TIMES_MINUTES')); ?>
				</p>
			</div>
			<div class="box-news_contents cf">
				<div>
					<div style="float: left; margin-top: -4px;">
					<div class="fb-like" data-href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $newsInfo['id']]); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
					</div>
					<div style="float: left; margin-left: 10px;"></div>
					<div style="clear: both;"></div>
				</div>

				<p class="mt10">
					<?= __('KEY_WORD') ?>
					： <a class="" href="">イベント・リリース</a>
				</p>
			</div>
			<!-- /.box-news_contents -->
		</section>

		<?= $this->element('News/_comment'); ?>
		<!-- /section.c_section_contents -->

		<div style="clear: both;"></div>
		<section class="box-newslist box-news-ranking">
			<h1>
				<?= __('NEWS_TOP') ?>
				<span>
					<?= __('NEWS_ANNOTATIONS_FOR_TOP') ?>
				</span>
			</h1>
			<ol class="c_list_article">
				<li class="top_news_list_templatte items_hiden cf">
					<span class="sub_ranking_icon"> </span>
					<div class="c_list_inner">
						<h2>
							<a class="" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', '_xxxx_xx_xxxx_']); ?>"></a>
						</h2>
					</div></li>
			</ol>
		</section>
		<div class="cb"></div>
	</div>
	<!-- /div#main -->

</div>
<!-- /contents -->
