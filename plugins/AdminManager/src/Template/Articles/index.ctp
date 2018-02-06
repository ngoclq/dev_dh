
<div class="row">
    <div class="columns large-12">
        <h3>Getting Started</h3>
        <ul>
            <li class="bullet book"><?= $this->Html->link(__('REGISTER'), [ 'controller' => 'Articles', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager']) ?></li>
            <?php foreach ($articlesCategory as $info): ?>
                <?php if($info->display_flag) {?>
                <li class="bullet book"><?= $this->Html->link($info->title_vi, [ 'controller' => 'Articles', 'action' => 'list', '_method' => 'GET', 'plugin' => 'AdminManager', $info->id]) ?> </li>
                <?php }?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>



