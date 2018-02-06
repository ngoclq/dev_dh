
<!-- ============================== Header Area ============================== -->
<header>
	<div class="c_caretomo_link">
		<p>
			<a href=""><?= __('ABOUT_PAGE')?></a>｜
			<?= $this->Html->link(__('QA_PAGE'), ['controller' => 'Contacts', 'action' => 'form', '_method' => 'GET'] ) ?>｜
			<a href="/recreation/?fr=cn-head"><?= __('HELP_PAGE')?></a>
		</p>
	</div>
	<div class="c_box_inner">
		<p class="c_sitedescription">介護・福祉の最新ニュース</p>
		<div class="cf">
			<h1 id="top">
				<?= $this->Html->image('/asset/my_template/img/title_logo.gif', [
					"alt" => "__('HOME_PAGE')",
					'url' => ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET']
				]) ?>
			</h1>
			<div id="pickup">
				<div class="c_ticker" rel="slide" style="height: 21px;">
					<ul>
						<li
							style="top: 0px; left: -500px; position: absolute; display: block; opacity: 0; z-index: 98;"
							class=""><a href="/information/#5">お知らせ || けあとも公式アプリのご案内</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /#pickup -->
			<ul class="c_member_area">
				<li class="c_signup"><a  class="btn_signup" href="/users/register/"> <?= __('LABEL_REGISTER'); ?>
				</a></li>
				<li class="c_login"><a
					href="/users/login/"><i
						class="icon-lock"></i> <?= __('LABEL_LOGIN'); ?></a></li>
			</ul>
		</div>
		<!-- /cf -->
	</div>
	<!-- /box-inner -->
	<nav id="gnavi">
		<ul class="cf">
			<li class="c_tab_1">
				<?= $this->Html->link(__('HOME_PAGE'), ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'] ) ?>
			</li>
			<?php
				$i = 1;
				foreach ($categories as $cateInfo):
				$i++;
				?>
			<li class="c_tab_<?= $i ?>">
			<?= $this->Html->link($cateInfo->title, ['controller' => 'News', 'action' => 'index', '_method' => 'GET', 'class' => 'c_tab_7', $cateInfo->id]) ?>
			</li>
			<?php
				endforeach; 
				$i++;
			?>
			<li class="c_tab_<?= $i ?>">
				<?= $this->Html->link(__('TOPIC_PAGE'), ['controller' => 'Homes', 'action' => 'home', '_method' => 'GET'] ) ?>
			</li>
		</ul>
	</nav>
</header>
<!-- ============================== /Header Area ============================== -->