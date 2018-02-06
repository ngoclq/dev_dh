
<div class="row">
    <div class="columns large-12">
        <h3>Getting Started</h3>
        <ul>
            <li class="bullet book"><?= $this->Html->link(__('CREATE'), [ 'controller' => 'News', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager']) ?></li>
            <li class="bullet book">Có tổng <?= (int)$newsCategory['article_total']['0'] + (int)$newsCategory['article_total']['1'] ?> bài viết </li>
            <li class="bullet book">Có <?= $newsCategory['article_total']['0'] ?> bài viết không hiển thị </li>
            <li class="bullet book">Có <?= $newsCategory['article_total']['1'] ?> bài viết hiển thị </li>
                        <li class="bullet book">=====================</li>
            <li class="bullet book">Có tổng <?= (int)$newsCategory['view_total']['0'] + (int)$newsCategory['view_total']['1'] ?> lượt xem </li>
            <li class="bullet book">Có <?= $newsCategory['view_total']['0'] ?> lượt xem từ user vãng lai </li>
            <li class="bullet book">Có <?= $newsCategory['view_total']['1'] ?> lượt xem từ user hệ thống </li>
            <?php
             unset($newsCategory['article_total'], $newsCategory['view_total']);
             foreach ($newsCategory as $info): 
            ?>
                <?php if($info->display_flag) {?>
                <li class="bullet book"><?= $this->Html->link($info->title_vi, [ 'controller' => 'News', 'action' => 'list', '_method' => 'GET', 'plugin' => 'AdminManager', $info->id]) ?>
                    <ul>
                        <li class="bullet book">Có tổng <?= (int)$info->article_number['0'] + (int)$info->article_number['1'] ?> bài viết </li>
                        <li class="bullet book">Có <?= $info->article_number['0'] ?> bài viết không hiển thị </li>
                        <li class="bullet book">Có <?= $info->article_number['1'] ?> bài viết hiển thị </li>
                        <li class="bullet book">=====================</li>
                        <li class="bullet book">Có tổng <?= (int)$info->view_number['0'] + (int)$info->view_number['1'] ?> lượt xem </li>
                        <li class="bullet book">Có <?= $info->view_number['0'] ?> lượt xem từ user vãng lai </li>
                        <li class="bullet book">Có <?= $info->view_number['1'] ?> lượt xem từ user hệ thống </li>
                    </ul>
                 </li>
                <?php }?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>



