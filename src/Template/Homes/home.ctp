<div class="jumbotron">
  <div class="text-center">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
		<?php foreach($newsTop as $key => $news):?>
        <div class="item <?php if(!$key) {?>active <?php }?>">
			<?php if(!empty($news->image )) {?>
			<?= $this->Html->link(
					$this->Html->image($news->image, ["alt" => "", "class" => "", 'style' => "width:100%;"]),
					['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
					['escape' => false]
				);
			?>
			<?php } ?>
          <div class="carousel-caption">
            <h3><?= $news->title ?></h3>
            <p><?= $news->body ?></p>
          </div>
        </div>
		<?php endforeach; ?>
      </div>

      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"><i class="fa fa-chevron-circle-left fa-3" aria-hidden="true"></i></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-left"><i class="fa fa-chevron-circle-right fa-3" aria-hidden="true"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
<?php foreach($aryNews as $keyCate => $aryCate):?>

<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?= $this->Html->link($aryCate['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryCate['id']]) ?>
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
                        <?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryNews->id], ['class' => 'btn btn-danger']) ?>
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
<div class="session03">
  <div class="container-fluid bg-3">
    <h3 class="title-session">Vì sao nên chọn DHH Vietnam ?</h3>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-3">
        <p>01. Chất lượng dịch vụ luôn đảm bảo</p>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor. Aenean vel dui ultricies, rutrum tortor id, maximus erat</span>
      </div>
      <div class="col-sm-3">
        <p>02. Các khóa học tiếng Nhật với đội ngũ giảng viên nhiều kinh nghiệm</p>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor.</span>
      </div>
      <div class="col-sm-4">
        <p>03. Hỗ trợ học viên tìm viêc làm phù hợp</p>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor. Aenean vel dui ultricies, rutrum tortor id, maximus erat</span>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</div>
<div class="session04">
  <div class="container-fluid bg-3">
    <div class="row">
      <div class="col-sm-6"></div>
      <div class="col-sm-6 ">
        <h3 class="title-session">Học viên nói gì về DHH Vietnam ?</h3>
        <div class="full-height">
          <div class="well" id="well2">
            <div class="list-group">
              <a href="#" class="list-group-item">
                <p>Nguyễn Hoàng Long :</p>
                <span><i>“ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor ”</i></span>
              </a>
              <a href="#" class="list-group-item">
                <p>Nguyễn Hoàng Long :</p>
                <span><i>“ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor ”</i></span>
              </a>
              <a href="#" class="list-group-item">
                <p>Nguyễn Hoàng Long :</p>
                <span><i>“ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor ”</i></span>
              </a>
              <a href="#" class="list-group-item">
                <p>Nguyễn Hoàng Long :</p>
                <span><i>“ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lorem purus, maximus eu quam eget, mollis laoreet tellus. Nunc tellus dolor, dictum vel elit aliquam, egestas aliquam dolor ”</i></span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</div>
