<nav class="navbar navbar-expand-md navbar-dark bg-danger">
    <div class="container">
        <?= $this->Html->link(
            $this->Html->image('/asset/default_template/img/logo.png', ["alt" => "__('HOME_PAGE')"]),
            ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],
            ['escape' => false, 'class' => 'navbar-brand']
        );?>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
            <ul class="navbar-nav">
                <?php $maxShow = 5;?>
            <?php foreach($categories as $cateId => $aryNews): ?>
                <?php if(isset($aryNews['children']) ) {?>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $aryNews['title']?>
                        <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                    <?php foreach($aryNews['children'] as $cateId => $info):?>
                    <li class="nav-item">
                        <?= $this->Html->link($info['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $info['id']],['tabindex' => '-1']) ?>
                    </li>
                    <?php endforeach; ?>
                    </ul>
                </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($aryNews['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryNews['id']]) ?>
                    </li>
                <?php } ?>
            <?php endforeach; ?>
            </ul>
            <a class="btn navbar-btn ml-2 btn-warning text-dark">
                <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign in
            </a>
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
