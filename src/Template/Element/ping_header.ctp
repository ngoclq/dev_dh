
<nav class="navbar navbar-expand-md navbar-dark bg-danger">
    <div class="container">
        <?= $this->Html->link(
            $this->Html->image('/asset/default_template/img/logo.png', ["alt" => __('HOME_PAGE')]),
            ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],
            ['escape' => false, 'class' => 'navbar-brand']
        );?>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
            <ul class="navbar-nav">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn dropdown-toggle"><?= __('ABOUT')?></a>
                    <ul class="dropdown-content">
                        <li class="nav-item"><?= $this->Html->link(__('ABOUT'), [ 'controller' => 'Infos', 'action' => 'about', '_method' => 'GET'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link(__('VISION'), [ 'controller' => 'Infos', 'action' => 'vision', '_method' => 'GET'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link(__('PRIVACY'), [ 'controller' => 'Infos', 'action' => 'privacy', '_method' => 'GET'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link(__('GROUP'), [ 'controller' => 'Infos', 'action' => 'groups', '_method' => 'GET'], ['class' => 'nav-link']) ?></li>
                    </ul>
                </li>
                <?php $maxShow = 5;?>
            <?php foreach($categories as $cateId => $aryNews): ?>
                <?php if(isset($aryNews['children']) ) {?>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn dropdown-toggle"><?= $aryNews['title']?></a>
                    <ul class="dropdown-content">
                    <?php foreach($aryNews['children'] as $cateId => $info):?>
                    <li class="nav-item">
                        <?= $this->Html->link($info['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $info['id']],['tabindex' => '-1'], ['class' => 'nav-link']) ?>
                    </li>
                    <?php endforeach; ?>
                    </ul>
                </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($aryNews['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryNews['id']], ['class' => 'nav-link']) ?>
                    </li>
                <?php } ?>
            <?php endforeach; ?>
            </ul>
            <!--<a class="btn navbar-btn ml-2 btn-warning text-dark btn_login">
                <i class="fa d-inline fa-lg fa-user-circle-o"></i>
            </a>-->
        </div>
    </div>
</nav>
<div class="p-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb" style="margin-bottom:0px;margin-top:0px">
                    <?php if (isset($menuPath) && is_array($menuPath) && count($menuPath)) {?>
                    <li class="breadcrumb-item">
                        <?= $this->Html->link('<i class="fa fa-home fa-lg" aria-hidden="true"></i>' . __('HOME_PAGE') , ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'], ['escape' => false] ) ?>
                    </li>
                        <?php
                            $total = count($menuPath);
                            $count = 0;
                            foreach($menuPath as $cateId => $cateName):
                                $count++;
                        ?>
                        <li class="breadcrumb-item">
                            <?php if ($total < $count) {?>
                                <?= $this->Html->link($cateName, ['controller' => 'News', 'action' => 'index', '_method' => 'GET', $cateId]) ?>
                            <?php } else { ?>
                                <?= $cateName ?>
                            <?php } ?>
                        </li>
                        <?php endforeach; ?>
                    <?php } else { ?>
                    <li class="breadcrumb-item active">
                        <i class="fa fa-home fa-lg" aria-hidden="true"></i><?= __('HOME_PAGE') ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
