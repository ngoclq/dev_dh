<?php
if (isset($aryCate)) {
    $aryFirst = array_slice($aryCate['list'], 0, 1);
    $aryCate['list'] = array_slice($aryCate['list'], 1);
?>
<div class="col-md-8">
    <h2 class="h-title"><span><?= $this->Html->link($aryCate['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryCate['id']]) ?></span></h2>

    <div class="sp-post clearfix">
        <?php if(!empty($aryFirst[0]->image )) {?>
        <?= $this->Html->link(
            $this->Html->image($aryFirst[0]->image, ['alt' => '']),
            ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryFirst[0]->id],
            ['escape' => false, 'class' => 'img smooth']
        ); ?>
        <?php } ?>
        <div class="ct">
            <h3 class="title">
                <?= $this->Html->link(
                    $aryFirst[0]->title,
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryFirst[0]->id],
                    ['escape' => false, 'class' => 'smooth']
                ); ?>
            </h3>
            <div class="post-info">
                <i class="fa fa-calendar"></i><?= $aryFirst[0]->created->i18nFormat(__('TIMES_MINUTES')); ?>&nbsp;&nbsp;
                <!--<i class="fa fa-comments"></i> 20-->
            </div>
            <p><?= mb_substr(strip_tags($aryFirst[0]->body), 0, 100) ?></p>
        </div>
    </div>
    <?php if(isset($aryCate['list']) && !empty($aryCate['list'])) { ?>
    <div class="sp-list">
        <div class="row">
            <?php  foreach($aryCate['list'] as $key => $news) { ?>
            <div class="col-sm-6">
                <div class="sp-s-post clearfix">
                    <?php if(!empty($news->image )) {?>
                    <?= $this->Html->link(
                    $this->Html->image($news->image, ['alt' => '']),
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                    ['escape' => false, 'class' => 'img hv-over']
                    ); ?>
                    <?php } ?>
                    <div class="ct">
                        <h3 class="title">
                            <?= $this->Html->link(
                                $news->title,
                                ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                                ['class' => 'smooth']
                            ); ?>
                        </h3>
                        <div class="post-info">
                            <i class="fa fa-calendar"></i><?= @$news->created->i18nFormat(__('TIMES_MINUTES')); ?>&nbsp;&nbsp;
                            <!--<i class="fa fa-comments"></i> 20-->
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>
