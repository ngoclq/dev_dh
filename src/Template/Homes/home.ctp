<br/>
<div class="container">
    <div class="row col-mar-10">
        <?php if(isset($newsLasted) && is_array($newsLasted) && count($newsLasted)) {?>
        <div class="col-md-f60">
            <div class="big-cas">
                <?php
                    $newsLasted_1 = array_slice($newsLasted, 0, 5);
                    $newsLasted_2 = array_slice($newsLasted, 5, 4);
                    $newsLasted_3 = array_slice($newsLasted, 9, 2);
                    foreach($newsLasted as $key => $news):
                ?>
                <div class="item">
                    <div class="big-post">
                        <?php if(!empty($news->image )) {?>
                        <?= $this->Html->link(
                            $this->Html->image($news->image, ['alt' => '']),
                            ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                            ['escape' => false, 'class' => 'c-img smooth']
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
                            <p><?= mb_substr(strip_tags($news->body), 0, 100) ?></p>
                            <div class="post-info">
                                <i class="fa fa-calendar"></i><?= @$news->created->i18nFormat(__('TIMES_MINUTES')); ?> &nbsp;&nbsp;
                                <!--<i class="fa fa-comments"></i> 20-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-f40">
            <div class="row col-mar-10">
                <div class="col-md-6">
                    <div class="bn-posts">
                        <?php
                            $i = 0;
                            foreach($newsLasted_2 as $key => $news):
                        ?>
                        <div class="b-post <?php if(!$i && !empty($news->image )) { ?> img <?php }?>">
                            <?php if(!$i && !empty($news->image )) { ?>
                            <?= $this->Html->link(
                                $this->Html->image($news->image, ['alt' => '']),
                                ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                                ['escape' => false, 'class' => 'c-img']
                            ); ?>
                            <?php
                                }
                                $i++;
                            ?>
                            <div class="ct smooth">
                                <h3 class="title">
                                    <?= $this->Html->link(
                                        $news->title,
                                        ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                                        ['class' => 'smooth']
                                    ); ?>
                                </h3>
                                <div class="post-info">
                                    <i class="fa fa-calendar"></i><?= @$news->created->i18nFormat(__('TIMES_MINUTES')); ?> &nbsp;&nbsp;
                                    <!--<i class="fa fa-comments"></i> 20-->
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <?php foreach($newsLasted_3 as $key => $news): ?>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="s-post">
                                <?php if(!empty($news->image )) { ?>
                                    <?= $this->Html->link(
                                        $this->Html->image($news->image, ['alt' => '']),
                                        ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                                        ['escape' => false, 'class' => 'c-img smooth']
                                    ); ?>
                                <?php } ?>
                                <h3 class="title">
                                <?= $this->Html->link(
                                    $news->title,
                                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                                    ['class' => 'smooth']
                                ); ?>
                                </h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if(isset($newsTop) && is_array($newsTop) && count($newsTop)) {?>
    <div class="row row-ibl xs-pad-5">
        <?php foreach($newsTop as $key => $news):?>
        <div class="col-md-f20 col-sm-4 col-xs-6">
            <div class="sm-post">
                <?php if(!empty($news->image )) {?>
                <?= $this->Html->link(
                    $this->Html->image($news->image, ['alt' => '']),
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
                    ['escape' => false, 'class' => 'c-img smooth']
                ); ?>
                <?php } ?>
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
        <?php endforeach; ?>
    </div>
    <?php } ?>
</div>

<?php
$index = 0;
foreach($aryNews as $keyCate => $aryCate) {
$index++;
if ($index <= 3) {
?>
    <?php if ($index === 1) { ?>
    <div class="container">
        <div class="row">
    <?php } ?>
            <?= $this->element('homes/area_list_1', ['aryCate' => $aryCate]); ?>
    <?php if ($index === 3) { ?>
        </div>
    </div>
    <?php } ?>
<?php } elseif ($index == 4) { ?>
    <?= $this->element('homes/area_about_1', ['aryCate' => $aryCate]); ?>
<?php } elseif ($index === 5) { ?>
    <div class="container">
        <div class="row">
            <?= $this->element('homes/area_list_2', ['aryCate' => $aryCate]); ?>
<?php
    } elseif ($index === 6) {
        $index = 0;
?>
            <?= $this->element('homes/area_list_1', ['aryCate' => $aryCate]); ?>
        </div>
    </div>

<?php } ?>
<?php } // End foreach ?>
