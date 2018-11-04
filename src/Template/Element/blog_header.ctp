<header class="bg">
    <div class="container">
        <div class="row row-logo-search">
            <div class="col-md-6 col-md-offset-3 hidden-xs logo">
            <?= $this->Html->link(
                $this->Html->image('/asset/theme_blog/images/logo.png', ["alt" => __('HOME_PAGE')]),
                ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],
                ['escape' => false, 'class' => 'smooth']
            );?>
            </div>
            <div class="col-md-3">
                <form class="search-form">
                    <input type="text" placeholder="Tìm kiếm ...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</header>
<nav class="main-bar">
    <div class="container">
        <div class="main-nav hidden-xs hidden-sm">
            <ul>
                <li><?= $this->Html->link(__('HOME_PAGE'), ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],['class' => 'smooth']);?></li>
                <li>
                    <a href="javascript:void(0)" class="smooth"><?= __('ABOUT')?></a>
                    <div class="sub clearfix">
                        <div class="list">
                            <!--<h3 class="title"><?= __('ABOUT')?></h3>-->
                            <ul>
                                <li><?= $this->Html->link(__('ABOUT'), [ 'controller' => 'Infos', 'action' => 'about', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                                <li><?= $this->Html->link(__('VISION'), [ 'controller' => 'Infos', 'action' => 'vision', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                                <li><?= $this->Html->link(__('PRIVACY'), [ 'controller' => 'Infos', 'action' => 'privacy', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                                <li><?= $this->Html->link(__('GROUP'), [ 'controller' => 'Infos', 'action' => 'groups', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php $maxShow = 5;?>
                <?php foreach($categories as $cateId => $aryNews): ?>
                <?php if(isset($aryNews['children']) ) {?>
                <li>
                    <a class="smooth" href="javascript:void(0)" title=""><?= $aryNews['title']?></a>
                    <div class="sub clearfix">
                        <div class="list">
                            <!--<h3 class="title"><?= $aryNews['title']?></h3>-->
                            <ul>
                                <?php foreach($aryNews['children'] as $cateId => $info):?>
                                <li class="nav-item">
                                    <?= $this->Html->link($info['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $info['id']],['tabindex' => '-1'], ['class' => 'smooth']) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php } else { ?>
                <li>
                    <?= $this->Html->link($aryNews['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryNews['id']], ['class' => 'smooth']) ?>
                </li>
                <?php } ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<nav class="mobile-menu hidden-md hidden-lg">
    <a class="mobile-logo" href="index.html" title="">
        <img class="img-responsive" src="/asset/theme_blog/images/logo.png" alt="">
    </a>
    <button class="menu-btn"><i class="menu-btn-bar"></i></button>
    <ul>
        <li><?= $this->Html->link(__('HOME_PAGE'), ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],['class' => 'smooth']);?></li>
        <li>
            <a href="javascript:void(0)" class="smooth"><?= __('ABOUT')?></a>
            <ul>
                <li><?= $this->Html->link(__('ABOUT'), [ 'controller' => 'Infos', 'action' => 'about', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                <li><?= $this->Html->link(__('VISION'), [ 'controller' => 'Infos', 'action' => 'vision', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                <li><?= $this->Html->link(__('PRIVACY'), [ 'controller' => 'Infos', 'action' => 'privacy', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                <li><?= $this->Html->link(__('GROUP'), [ 'controller' => 'Infos', 'action' => 'groups', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
            </ul>
        </li>

        <?php $maxShow = 5;?>
        <?php foreach($categories as $cateId => $aryNews): ?>
        <?php if(isset($aryNews['children']) ) {?>
        <li>
            <a class="smooth" href="javascript:void(0)" title=""><?= $aryNews['title']?></a>
            <ul>
                <?php foreach($aryNews['children'] as $cateId => $info):?>
                <li>
                    <?= $this->Html->link($info['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $info['id']],['tabindex' => '-1'], ['class' => 'smooth']) ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php } else { ?>
        <li>
            <?= $this->Html->link($aryNews['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryNews['id']], ['class' => 'smooth']) ?>
        </li>
        <?php } ?>
        <?php endforeach; ?>
    </ul>
</nav>

<?php if (isset($menuPath) && is_array($menuPath) && count($menuPath)) {?>
<div class="container">
    <ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">

        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?= $this->Html->link('<span itemprop="name">' . __('HOME_PAGE') . '</span>', ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'], ['escape' => false, 'itemprop' => 'item'] ) ?>
            <meta itemprop="position" content="1">
        </li>
<?php
    $total = count($menuPath);
    $count = 0;
    foreach($menuPath as $cateId => $cateName):
    $count++;
?>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php if ($total > $count) {?>
            <?= $this->Html->link('<span itemprop="name">' . $cateName . '</span>', ['controller' => 'News', 'action' => 'index', '_method' => 'GET', $cateId], ['escape' => false, 'itemprop' => 'item']) ?>
            <?php } else { ?>
            <?= $cateName ?>
            <?php } ?>
            <meta itemprop="position" content="<?= $count ?>">

        </li>
<?php endforeach; ?>

</div>
<?php } ?>

