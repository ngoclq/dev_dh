<?php
if (isset($aryCate)) {
    $aryFirst = array_slice($aryCate['list'], 0, 1);
    $aryCate['list'] = array_slice($aryCate['list'], 1);
?>
<div class="col-md-4">
    <h2 class="h-title"><span><?= $this->Html->link($aryCate['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryCate['id']]) ?> </span></h2>
    <div class="post-box">
        <div class="ct">
            <div class="f-post">
                <?php if(!empty($aryFirst[0]->image )) {?>
                <?= $this->Html->link(
                    $this->Html->image($aryFirst[0]->image, ['alt' => '', 'class' => 'smooth']) .
                    '<h3 class="title smooth">' . $aryFirst[0]->title . '</h3>',
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryFirst[0]->id],
                    ['escape' => false, 'class' => 'c-img']
                ); ?>
                <?php } ?>
                <div class="post-info">
                    <i class="fa fa-calendar"></i><?= @$aryFirst[0]->created->i18nFormat(__('TIMES_MINUTES')); ?>&nbsp;&nbsp;
                    <!--<i class="fa fa-user"></i> Author &nbsp;&nbsp;
                    <i class="fa fa-comments"></i> 20-->
                </div>
                <p><?= mb_substr(strip_tags($aryFirst[0]->body), 0, 100) ?></p>
            </div>

        <?php  foreach($aryCate['list'] as $key => $news) { ?>
            <div class="item">
                <h3 class="title">
                <?= $this->Html->link(
                    $news->title,
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                    ['class' => 'smooth']
                ); ?>
                </h3>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
