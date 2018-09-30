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
                <h1 class=""><?= @$newsResult[0]->category_title ?></br></h1>
            </div>
        </div>
    </div>
</div>
<div class="py-0">
    <div class="container">
        <div class="row mb-5">
            <?php
            $column = 12;
            $flagShowImage = false;
             if(isset($newsResult[0]->image) && $newsResult[0]->image) {
                $column = 7;
                $flagShowImage = true;
            }?>
            <div class="col-md-<?= $column ?>">
                <h2 class="text-primary">
                    <?= $this->Html->link(@$newsResult[0]->title, ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', @$newsResult[0]->id], ['class' => ''] ) ?>
                    <br>
                </h2>
                <p class=""><?= mb_substr(strip_tags(@$newsResult[0]->body), 0, 100) ?></p>
            </div>
            <?php if($flagShowImage) {?>
            <div class="col-md-5 align-self-center">
                <?= $this->Html->image(@$newsResult[0]->image, ["alt" => "", "class" => "img-fluid d-block w-100 img-thumbnail", 'style' => ""]) ?>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php
unset($newsResult[0]);
$newsResult = array_values($newsResult);
foreach ($newsResult as $key => $news):?>
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
