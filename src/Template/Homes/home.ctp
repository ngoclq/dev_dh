<?php if(isset($newsTop) && is_array($newsTop) && count($newsTop)) {?>
<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?= __('LABEL_NEWS_TOP') ?>
                    <br>
                </h1>
            </div>
        </div>
    </div>
</div>

<?php foreach($newsTop as $key => $news):?>
<?php if(!($key % 4)) {?>
<div class="py-2">
    <div class="container">
        <div class="row">
            <?php }?>
            <div class="col-md-3">
                <div class="card">
                    <?php if(!empty($news->image )) {?>
                    <?= $this->Html->link(
                        $this->Html->image($news->image, ["alt" => "", "class" => "", 'style' => "width:100%;"]),
                        ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                        ['escape' => false]
                    ); ?>
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $news->title ?></h5>
                        <p class="card-text">
                            <?= mb_substr(strip_tags($news->body), 0, 100) ?>
                        </p>
                        <?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method'
                        => 'GET', $news->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
            <?php if(($key && !($key % 3)) || (1 + $key) == count($newsTop)) { ?>
        </div>
    </div>
</div>
<?php } ?>
<?php endforeach; ?>
<?php } ?>

<?php foreach($aryNews as $keyCate => $aryCate):?>
<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?= $this->Html->link($aryCate['title'], [ 'controller' => 'News', 'action' => 'index', '_method' =>
                    'GET', $aryCate['id']]) ?>
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
                <p class=""><?= $aryCate['description']?></p>
            </div>
        </div>
    </div>
</div>

<?php foreach($aryCate['list'] as $key => $aryNews):?>
<?php if(!($key % 4)) {?>
<div class="py-2">
    <div class="container">
        <div class="row">
            <?php }?>
            <div class="col-md-3">
                <div class="card">
                    <?= $this->Html->image($aryNews->image, ["alt" => "", "class" => "card-img-top", 'style' => ""]) ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $aryNews->title ?></h5>
                        <p class="card-text">
                            <?= mb_substr(strip_tags($aryNews->body), 0, 100) ?>
                        </p>
                        <?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method'
                        => 'GET', $aryNews->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
            <?php if(($key && !($key % 3)) || (1 + $key) == count($aryCate['list'])) { ?>
        </div>
    </div>
</div>
<?php } ?>
<?php endforeach; ?>
<?php endforeach; ?>
