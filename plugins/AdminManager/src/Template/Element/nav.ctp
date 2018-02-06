<div id="nav-wrapper">
	<ul id="nav"
		data-ng-controller="NavCtrl"
		data-slim-scroll
		data-collapse-nav
		data-highlight-active>
		<li class="active"><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'home', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"> <i class="glyphicon glyphicon-home"></i><span><?= __('HOME')?></span> </a></li>
		<li  class="<?php if (isset($menu_item) && $menu_item == 'NEWS') {?> open <?php }?>">
			<a><i class="fa fa-magic"></i><span><?= __('NEWS')?></span></a>
			<ul <?php if (isset($menu_item) && $menu_item == 'NEWS') {?> style="display: block;" <?php }?>>
				<li><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"><i class="fa fa-caret-right glyphicon glyphicon-plus"></i><span><?= __('NEWS_ADD')?></span></a></li>
				<li><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"><i class="fa fa-caret-right glyphicon glyphicon-list"></i><span><?= __('NEWS_LIST')?></span></a></li>
				<li><a href="<?= $this->Url->build(['controller' => 'NewsCategory', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"><i class="fa fa-caret-right glyphicon glyphicon-tasks"></i><span><?= __('NEWS_CATEGORY')?></span></a></li>
			</ul>
		</li>
		<li class="<?php if (isset($menu_item) && $menu_item == 'CONTACTS') {?> open <?php }?>">
			<a href="#/mail"><i class="fa fa-envelope-o"></i><span><?= __('LABEL_CONTACT')?></span></a>
			<ul <?php if (isset($menu_item) && $menu_item == 'CONTACTS') {?> style="display: block;" <?php }?>>
				<li><a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"><i class="fa fa-caret-right"></i><span data-i18n="Inbox"></span></a></li>
			</ul>
		</li>
	</ul>
</div>