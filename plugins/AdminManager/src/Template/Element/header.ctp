<header class="clearfix">

	<!-- Logo -->
	<div class="logo">
		<a href="#/">
			<!-- <span class="logo-icon glyphicon glyphicon-fire"></span> -->
			<span>{{main.brand}}</span>
		</a>
	</div>

	<!-- needs to be put after logo to make it working-->
	<div class="menu-button" toggle-off-canvas>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</div>

	<div class="top-nav">
		<ul class="nav-left list-unstyled">
			<li>
				<a href="#/" data-toggle-min-nav
							 class="toggle-min"
							 ><i class="fa fa-bars"></i></a>
			</li>
			<li class="dropdown text-normal nav-profile" dropdown >
				<a href="javascript:;" dropdown-toggle class="dropdown-toggle" >
					<img src="/img/noavatar.png" alt="" class="img-circle img30_30">
					<span class="hidden-xs">
						<span data-i18n="Lisa Doe"></span>
					</span>
				</a>
				<ul class="dropdown-menu dropdown-dark with-arrow">
					<li>
						<a href="#/pages/profile">
							<i class="fa fa-user"></i>
							<span data-i18n="My Profile"></span>
						</a>
					</li>
					<li>
						<a href="#/tasks">
							<i class="fa fa-check"></i>
							<span data-i18n="My Tasks"></span>
						</a>
					</li>
					<li>
						<a href="#/pages/lock-screen">
							<i class="fa fa-lock"></i>
							<span data-i18n="Lock"></span>
						</a>
					</li>
					<li>
						<a href="#/pages/signin">
							<i class="fa fa-sign-out"></i>
							<span data-i18n="Log Out"></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="dropdown langs text-normal" data-ng-controller="LangCtrl"  dropdown is-open="status.isopenLang" >
				<a href="javascript:;" class="dropdown-toggle active-flag" dropdown-toggle ng-disabled="disabled">
					<div class="flag {{ getFlag() }}"></div>
				</a>
				<ul class="dropdown-menu dropdown-dark with-arrow list-langs" role="menu">
					<li data-ng-show="lang !== 'Vietnamese' ">
						<a href="javascript:;" data-ng-click="setLang('Vietnamese')"><div class="flag flags-vietnamese"></div> Tiếng Việt</a></li>
					<li data-ng-show="lang !== '日本語' ">
						<a href="javascript:;" data-ng-click="setLang('日本語')"><div class="flag flags-japan"></div> 日本語</a></li>
				</ul>
			</li>
		</ul> 

		<ul class="nav-right pull-right list-unstyled">
			<li class="dropdown" dropdown is-open="status.isopenComment">
				<a href="javascript:;" class="dropdown-toggle bg-orange" dropdown-toggle ng-disabled="disabled">
					<i class="fa fa-comment-o"></i>
					<span class="badge badge-info">2</span>
				</a>
				<div class="dropdown-menu pull-right with-arrow panel panel-default">
					<div class="panel-heading">
						You have 2 messages.
					</div>
					<ul class="list-group">
						<li class="list-group-item">
							<a href="javascript:;" class="media">
								<span class="media-left media-icon">
									<span class="square-icon sm bg-info"><i class="fa fa-comment-o"></i></span>
								</span>
								<div class="media-body">
									<span class="block">Jane sent you a message</span>
									<span class="text-muted">3 hours ago</span>
								</div>
							</a>
						</li>
						<li class="list-group-item">
							<a href="javascript:;" class="media">
								<span class="media-left media-icon">
									<span class="square-icon sm bg-danger"><i class="fa fa-comment-o"></i></span>
								</span>
								<div class="media-body">
									<span class="block">Lynda sent you a mail</span>
									<span class="text-muted">9 hours ago</span>
								</div>
							</a>
						</li>					   
					</ul>
					<div class="panel-footer">
						<a href="javascript:;">Show all messages.</a>
					</div>
				</div>
			</li>
			<li class="dropdown" dropdown is-open="status.isopenEmail">
				<a href="javascript:;" class="dropdown-toggle bg-warning" dropdown-toggle ng-disabled="disabled">
					<i class="fa fa-envelope-o"></i>
					<span class="badge badge-info"><?= $new_contact_unread?></span>
				</a>
				<div class="dropdown-menu pull-right with-arrow panel panel-default">
					<div class="panel-heading">
						You have 3 mails.
					</div>
					<ul class="list-group">
					<?php foreach ($new_contact_header as $contacts): ?>
						<li class="list-group-item">
							<a href="<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'detail', '_method' => 'GET', 'plugin' => 'AdminManager', $contacts->id]); ?>" class="media">
								<span class="media-left media-icon">
									<span class="square-icon sm bg-warning"><i class="fa fa-envelope-o"></i></span>
								</span>
								<div class="media-body">
									<span class="block"><?= __('NEW_CONTACT_NOTICLES', $contacts->full_name) ?></span>
									<span class="text-muted block">2min ago</span>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
					</ul>
					<div class="panel-footer">
						<a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>"><?= __('LABEL_SHOW_ALL_CONTACT')?></a>
					</div>
				</div>
			</li>
		</ul>
	</div>

</header>
