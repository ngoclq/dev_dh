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

<?php
$first = $newsResult[0];
$aryTop = array_slice($newsResult, 1, 4);
$newsResult = array_slice($newsResult, 5);
?>
<div class="container">
    <div class="first-post">
        <div class="row">
            <div class="col-md-8 col-md-push-4">
                <?php if(!empty($first->image )) {?>
                <?= $this->Html->link(
                    $this->Html->image($first->image, ["alt" => "", "class" => ""]),
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $first->id],
                    ['escape' => false, 'class' => 'img']
                ); ?>
                <?php } ?>
            </div>
            <div class="col-md-4 col-md-pull-8">
                <h2 class="title">
                    <?= $this->Html->link(@$first->title, ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', @$first->id], ['class' => 'smooth'] ) ?>
                </h2>
                <div class="post-info">
                    <i class="fa fa-calendar"></i> <?= $first->created->i18nFormat(__('TIMES_MINUTES')); ?>&nbsp;&nbsp;
                    <!--<i class="fa fa-comments"></i> 20-->
                </div>
                <!--<div class="des">
                    Description
                </div>-->
                <?= mb_substr(strip_tags(@$first->body), 0, 100) ?>
            </div>
        </div>
    </div>
    <div class="row row-ibl xs-pad-5">
        <?php foreach ($aryTop as $key => $news) { ?>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="sm-post v2">
                <?php if(!empty($news->image )) {?>
                <?= $this->Html->link(
                    $this->Html->image($news->image, ["alt" => "", "class" => ""]),
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                    ['escape' => false, 'class' => 'c-img smooth']
                ); ?>
                <?php } ?>
                <h3 class="title"><?= $this->Html->link(@$news->title, ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', @$news->id], ['class' => 'smooth'] ) ?></h3>
                <div class="post-info">
                    <i class="fa fa-calendar"></i> <?= $news->created->i18nFormat(__('TIMES_MINUTES')); ?> &nbsp;&nbsp;
                    <!--<i class="fa fa-comments"></i> 20-->
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="">
                <?php foreach ($newsResult as $key => $news) { ?>
                <div class="post clearfix">
                    <?php if(!empty($news->image )) {?>
                    <?= $this->Html->link(
                        $this->Html->image($news->image, ["alt" => "", "class" => ""]),
                        ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                        ['escape' => false, 'class' => 'img']
                    ); ?>
                    <?php } ?>
                    <div class="ct">
                        <h2 class="title"><?= $this->Html->link(@$news->title, ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', @$news->id], ['class' => 'smooth'] ) ?></h2>
                        <div class="post-info">
                            <i class="fa fa-calendar"></i><?= @$news->created->i18nFormat(__('TIMES_MINUTES')); ?>&nbsp;&nbsp;
                            <!--<i class="fa fa-comments"></i> 20-->
                        </div>
                        <div class="des">
                            <!--<?= $this->Html->link(
                                $news->category_title . ':',
                                ['controller' => 'News', 'action' => 'index', '_method' => 'GET', $news->id],
                                ['class' => 'cate']
                            ) ?>-->
                            <?= mb_substr(strip_tags(@$news->body), 0, 100) ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="cate-sb">
                <!--<h3 class="h-title"><span>Tin đọc nhiều</span></h3>
                <div class="post-box2 v2">
                    <div class="f2-post">
                        <a class="c-img" href="#" title="">
                            <img class="smooth" src="theme/frontend/images/img6.jpg" alt="" title=""/>
                            <div class="ct smooth">
                                <h3 class="title">Eunt in culpa qui officia deserunt mollit anim id est laborum.</h3>
                                <div class="post-info">
                                    <i class="fa fa-calendar"></i> 16/06/2017 &nbsp;&nbsp;
                                    <i class="fa fa-user"></i> Lê Minh &nbsp;&nbsp;
                                    <i class="fa fa-comments"></i> 20
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="list">
                        <div class="item">
                            <h3 class="title"><a class="smooth cate" href="#" title="">Chuyện đời sống:</a><a class="smooth" href="#" title="">TTO - Thượng tá Lê Đức Đoàn - nguyên chiến sĩ đội CSGT số 1 (Công an Hà Nội)</a></h3>
                        </div>
                        <div class="item">
                            <h3 class="title"><a class="smooth cate" href="#" title="">Chuyện đời sống:</a><a class="smooth" href="#" title="">TTO - Thượng tá Lê Đức Đoàn - nguyên chiến sĩ đội CSGT số 1 (Công an Hà Nội)</a></h3>
                        </div>
                        <div class="item">
                            <h3 class="title"><a class="smooth cate" href="#" title="">Chuyện đời sống:</a><a class="smooth" href="#" title="">TTO - Thượng tá Lê Đức Đoàn - nguyên chiến sĩ đội CSGT số 1 (Công an Hà Nội)</a></h3>
                        </div>
                        <div class="item">
                            <h3 class="title"><a class="smooth cate" href="#" title="">Chuyện đời sống:</a><a class="smooth" href="#" title="">TTO - Thượng tá Lê Đức Đoàn - nguyên chiến sĩ đội CSGT số 1 (Công an Hà Nội)</a></h3>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
    </div>
</div>


<!-- ============================== side Area ============================== -->
<!--
<div id="contents" class="cf">

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
</div>
-->
<!-- /contents -->
<!-- ============================== /contents Area ============================== -->
