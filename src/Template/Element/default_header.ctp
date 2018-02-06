<!-- ============================== Header Area ============================== -->

<nav class="navbar navbar-inverse">
	<div class="top-header">
		<div class="float-left">
			<i class="fa fa-phone-square fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;<b><?= __('COMPANY_HOTLINE')?></b>
		</div>
		<div class="float-right">
			<a href="https://www.facebook.com/NhatNguDHHVietnam/" target="_blank"><i
				class="fa fa-facebook-square fa-lg" aria-hidden="true">&nbsp;</i></a>
		</div>
	</div>
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#myNavbar">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<?= $this->Html->link(
				$this->Html->image('/asset/default_template/img/logo.png', ["alt" => "__('HOME_PAGE')"]),
				['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'],
				['escape' => false, 'class' => 'navbar-brand']
			);?>
		</div>
		<div class="collapse navbar-collapse swatch-200" id="myNavbar">
			<ul class="nav navbar-nav float-right">
				<li class="active">
					<?= $this->Html->link('<i class="fa fa-home fa-lg" aria-hidden="true"></i>', ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'], ['escape' => false] ) ?>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Giới thiệu &nbsp;<i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
				</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="aboutUs.html">Giới thiệu chung</a></li>
						<li><a tabindex="-1" href="#">Tầm nhìn sứ mệnh</a></li>
						<li><a tabindex="-1" href="#">Nguyên tắc hoạt động</a></li>
						<li><a tabindex="-1" href="#">Đội ngũ nhân sự</a></li>
					</ul></li>
				<li><a href="aboutUs.html">Tin tức Nhật</a></li>
				<li><a href="#">Du học Nhật</a></li>
				<li><a href="#">Lao động Nhật</a></li>
				<li><a href="#">Khóa học tiếng Nhật</a></li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Diễn đàn/ Tài Liệu &nbsp;<i class="fa fa-angle-down fa-lg"
						aria-hidden="true"></i>
				</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="">Diễn đàn</a></li>
						<li><a tabindex="-1" href="">Tài liệu</a></li>
					</ul></li>
			</ul>
		</div>
	</div>
</nav>
<!-- ============================== /Header Area ============================== -->