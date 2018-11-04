<footer>
    <div class="foot-nav bg">
        <div class="container">
            <div class="row col-mar-5 row-ibl">
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 class="title"><?= __('ABOUT')?></h4>
                    <ul>
                        <li><?= $this->Html->link(__('ABOUT'), [ 'controller' => 'Infos', 'action' => 'about', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                        <li><?= $this->Html->link(__('VISION'), [ 'controller' => 'Infos', 'action' => 'vision', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                        <li><?= $this->Html->link(__('PRIVACY'), [ 'controller' => 'Infos', 'action' => 'privacy', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                        <li><?= $this->Html->link(__('GROUP'), [ 'controller' => 'Infos', 'action' => 'groups', '_method' => 'GET'], ['class' => 'smooth']) ?></li>
                    </ul>
                </div>

                <?php foreach($categories as $cateId => $aryNews): ?>
                <?php if(isset($aryNews['children']) ) {?>

                <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 class="title"><?= $aryNews['title']?></h4>
                    <ul>
                        <?php foreach($aryNews['children'] as $cateId => $info):?>
                        <li>
                            <?= $this->Html->link($info['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $info['id']],['tabindex' => '-1'], ['class' => 'smooth']) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php } else { ?>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 class="title"><?= $aryNews['title']?></h4>
                    <ul>
                        <li><?= $this->Html->link($aryNews['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryNews['id']], ['class' => 'smooth']) ?></li>
                    </ul>
                </div>
                <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row row-ibl bot">
                <div class="col-md-2 col-sm-12 col-xs-12 xs-center">
                    <a class="logo" href="#" title="">
                        <img src="/asset/theme_blog/images/logo.png" alt="" title=""/>
                    </a>
                </div>
                <div class="col-md-7 col-sm-8 col-xs-12 xs-center">
                    <div class="s-content">
                        <h3><?= __('COMPANY_NAME')?></h3>
                        <p><?= __('LABEL_MOBILE')?><?= __('COMPANY_MOBILE')?></p>
                        <p><?= __('LABEL_TAX_CODE')?><?= __('TAX_CODE')?></p>
                        <p><?= __('LABEL_ADDRESS')?><?= __('COMPANY_ADDRESS')?></p>
                        <p><?= __('LABEL_SITE')?><?= __('SITE_DOMAIN')?> - <?= __('LABEL_EMAIL')?><?= __('COMPANY_EMAIL')?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 text-right xs-center">
                    <div class="social">
                        <a class="smooth f" href="#" title=""><i class="fa fa-facebook"></i></a>
                        <a class="smooth t" href="#" title=""><i class="fa fa-twitter"></i></a>
                        <a class="smooth l" href="#" title=""><i class="fa fa-linkedin"></i></a>
                        <a class="smooth y" href="#" title=""><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="foot bg">
        <?= __('LABEL_RESERVED')?><?= __('COMPANY_NAME')?>
    </div>

</footer>
<div class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
