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
<div id="contents" class="cf">
	<div id="main">
		<section class="c_section_contents">
			<div class="cf  title">
				<h1 class="site_center_headline_title mag-b10">
					<?= $newsInfo['title']; ?>
				</h1>
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
				<?= $newsInfo['body']; ?>
				<br>
				<p class="mt10">
					<?= __('KEY_WORD') ?>
					： <a class="" href="">イベント・リリース</a>
				</p>
			</div>
			<!-- /.box-news_contents -->
		</section>
		
		<?= $this->element('News/_comment'); ?>
		<!-- /section.c_section_contents -->
		<section class="box-newslist box-news-related">
			<h1>
				<?= __('NEWS_RELATED') ?>
			</h1>
			<div class="e_news_relate_list_templatte items_hiden e_carenews_list_article">
				<h3>
					<a class="title" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', '_xxxx_xx_xxxx_']); ?>"></a>
				</h3>
				<p class="content"></p>
				<a class="continue" href="">
					<?= __('VIEW_MORE') ?>
				</a>
			</div>
		</section>
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
	<!-- ============================== side Area ============================== -->
	<div id="sidebar">
		<div class="mt10 center">
			<p style="text-align: center;">&nbsp;</p>
		</div>
		<?= $this->element('News/_side_right_news_suggest'); ?>
		<?= $this->element('News/_side_right_news_latest'); ?>
		<?= $this->element('News/_side_right_menu_other'); ?>
	</div>
	<!-- /div#sidebar -->
</div>
<!-- /contents -->
