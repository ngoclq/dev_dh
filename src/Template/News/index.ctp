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

<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?= @$newsResult[0]->category_title ?>
                    <br>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class=""><?= @$newsResult[0]->category_description ?></p>
            </div>
        </div>
    </div>
</div>
<?php foreach ($newsResult as $key => $news):?>
<?php if(!($key % 4)) {?>
<div class="py-2">
    <div class="container">
        <div class="row">
<?php }?>
            <div class="col-md-3">
                <div class="card">
                    <?= $this->Html->image($news->image, ["alt" => "", "class" => "card-img-top", 'style' => ""]) ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $news->title ?>
                            <?= $this->Html->tag('span', 'NEW!', ['class' => 'c_notice_new']) ?>
                        </h5>
                        <p class="card-text">
                            <?= mb_substr(strip_tags($news->body), 0, 100) ?>
                        </p>
                        <?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id], ['class' => 'btn btn-danger'] ) ?>
                    </div>
                </div>
            </div>
<?php if(($key && !($key % 3)) || (1 + $key) == count($newsResult)) { ?>
        </div>
    </div>
</div>
<?php } ?>
<?php endforeach; ?>

<div id="contents" class="cf">

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
