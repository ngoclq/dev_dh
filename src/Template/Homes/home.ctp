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
<?php foreach($aryNews as $key => $aryCate):?>
<div class="session01">
  <div class="services-ls container-fluid bg-3">
    <h3 class="title-session">
        <?= $this->Html->link($aryCate['title'], [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', $aryCate['id']]) ?>
    </h3>
    <div class="row">
      <div id="myCarousel02" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">

            <?php foreach($aryCate['list'] as $key => $aryNews):?>
            <?php if(!($key % 5)) {?>
          <div class="item <?php if(!$key) {?>active <?php } ?>">
            <div class="col-sm-1"></div>
          <?php }?>
            <div class="col-sm-2">
              <p><?= $key + 1 ?></p>
                <?= $this->Html->link(
                    $this->Html->image($aryNews->image, ["alt" => "", "class" => "img-responsive", 'style' => "width:100%;"]),
                    ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryNews->id],
                    ['escape' => false]
                );
                ?>
              <div class="ser-name">
                  <?= $this->Html->link($aryNews->title, [ 'controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryNews->id]) ?>
              </div>
                <div class="ser-name">
                    <?php $body = mb_substr(strip_tags($aryNews->body), 0, 100); ?>
                <?= $this->Html->link($body, [ 'controller' => 'News', 'action' => 'detail', '_method' => 'GET', $aryNews->id]) ?>
            </div>
            </div>
              <?php if(!($key % 4) || $key == count($aryNews)) { ?>
          </div>
            <?php } ?>
        <?php endforeach; ?>

        </div>

        <a class="left carousel-control" href="#myCarousel02" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"><i class="fa fa-chevron-circle-left fa-3" aria-hidden="true"></i></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel02" data-slide="next">
          <span class="glyphicon glyphicon-chevron-left"><i class="fa fa-chevron-circle-right fa-3" aria-hidden="true"></i></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </div>
</div>
<div class="session02 text-center heightVmax">
  <img src="/asset/default_template/img/bgqc.png" class="img-responsive"/>
</div>
</div>
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
