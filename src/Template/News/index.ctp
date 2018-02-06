<?php $this->assign('title', __('')); ?>
<?php $this->assign('description', 'AAAAAAAa') ?>
<?php $this->assign('script', $this->Html->script(['news.js'])); ?>
<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _url_action_relate = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getRelated', '_method' => 'GET']); ?>";
	var _url_action_top = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getTop', '_method' => 'GET']); ?>";
	var _url_action_latest = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getLatestNews', '_method' => 'GET']); ?>";
	var _url_action_category = "<?= $this->Url->build(['controller' => 'News', 'action' => 'getNewsCategory', '_method' => 'GET']); ?>";
	var _category_id = "";
	var _id = "";
	/* ]]> */
</script>
<!-- ============================== contents Area ============================== -->
<div id="contents" class="cf">
	<div id="main">
		<section class="c_section_contents">
			<div class="cf">
				<h1 class="e_tit_newblog">新着ニュース</h1>
			</div>
			<div class="c_section_box cf">
				<ul class="news_topic">
					<?php foreach ($newsResult as $news):?>
					<li class="article">
						<div class="list_photo">
							<?= $this->Html->link(
								$this->Html->image("phpThumb_005.jpg", ["alt" => "Brownies", "class" => "pic_set"]),
								['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
								['escape' => false]
							);?>
						</div>
						<div class="list_title">
							<h2 id="h2-id6">
							<?= $this->Html->link(
								$news->title . $this->Html->tag('span', 'NEW!', ['class' => 'c_notice_new']),
								['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
								['escape' => false]
							) ?>
							</h2>
						</div>
						<div class="list_read">
							<p class="c_lead">
								<span style="font-size: 0.7em; color: #47885e;"> <?= $news->created->i18nFormat(__('TIMES_MINUTES')) ?>
								</span> <br>
								<?= $news->body ?>
							</p>
							<?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id] ) ?>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="cb"></div>
			</div>
			<!-- /.c_section_box -->
		</section>
		<!-- /section.c_section_contents -->
		<div class="cf">
			<div class="e_pagination cf">
				<ul class="cf">
					<li><a class="current_page">前へ</a></li>
					<li><a id="current_page" class="current_page">1</a></li>
					<li><a href="/carenews/?page=2" class="number">2</a></li>
					<li><a href="/carenews/?page=3" class="number">3</a></li>
					<li><a href="/carenews/?page=4" class="number">4</a></li>
					<li><a href="/carenews/?page=5" class="number lastChild">5</a></li>
					<li>...</li>
					<li><a href="/carenews/?page=253">253</a></li>
					<li><a href="/carenews/?page=2">次へ</a></li>
				</ul>
			</div>
			<!-- /.e_pagination-->
		</div>
		<div style="text-align: center; margin: 30px 0;">
			<div style="float: left;"></div>
			<div style="float: right;"></div>
			<div style="clear: both;"></div>
		</div>
	</div>
	<!-- /div#main -->
	<!-- ============================== side Area ============================== -->
	<div id="sidebar">
		<?= $this->Html->script('/asset/my_template/js/rollover.js') ?>
		<div class="mt10 center">
			<p style="text-align: center;">== オススメ介護求人 ==</p>
		</div>
		<?= $this->element('News/_side_right_news_suggest'); ?>
		<?= $this->element('News/_side_right_news_latest'); ?>
		<?= $this->element('News/_side_right_menu_other'); ?>
		<div style="margin-top: 20px; text-align: center;"></div>
	</div>
	<!-- /div#sidebar -->
</div>
<!-- /contents -->
<!-- ============================== /contents Area ============================== -->
