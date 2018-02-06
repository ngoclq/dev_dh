<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_contacts_delete = "<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'actionDelete', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
	/* ]]> */
</script>
<?php $this->assign('script', $this->Html->script(['AdminManager.contacts.js'])); ?>

<div id="tbl-mail-info" class="page">
	<div class="row">
		<div class="col-sm-3">
			<section class="panel panel-default mail-categories">
				<div class="panel-heading">
					<a href="#/mail/compose" class="btn btn-block btn-lg btn-primary">Compose</a>
				</div>
				<ul class="list-group">
					<li class="list-group-item active"><a href="javascript:;">
						<i class="fa fa-inbox"></i>Inbox
						<span class="badge badge-info pull-right">6</span>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						<i class="fa fa-envelope-o"></i>Send mail
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						<i class="fa fa-star"></i>Starred
						<span class="badge badge-danger pull-right">3</span>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						<i class="fa fa-comment-o"></i>Chat
						<span class="badge badge-success pull-right">9</span>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						<i class="fa fa-pencil"></i>Draft
						<span class="badge badge-warning pull-right">1</span>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						<i class="fa fa-trash-o"></i>Spam
					</a></li>
				</ul>
			</section>

			<section class="panel panel-default mail-categories">
				<div class="panel-heading">Label</div>
				<ul class="list-group">
					<li class="list-group-item"><a href="javascript:;">
						Work <i class="fa fa-circle color-danger pull-right"></i>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						Friends <i class="fa fa-circle color-info pull-right"></i>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						Family <i class="fa fa-circle color-primary pull-right"></i>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						Private <i class="fa fa-circle color-warning pull-right"></i>
					</a></li>
					<li class="list-group-item"><a href="javascript:;">
						Classmates <i class="fa fa-circle color-success pull-right"></i>
					</a></li>
				</ul>
			</section>
		</div>
		<div class="col-sm-9">
		<?php
			$contactsResultTmp = clone $contactsResult;
			$info = $contactsResultTmp->first();
		
		?>
			<section class="panel panel-default mail-container">
				<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> View Mail</strong></div>
				<div class="panel-body">
					<div class="mail-header row">
						<div class="col-md-8">
							<h3><?= $info->title?></h3>
						</div>
						<div class="col-md-4 items_hiden">
							<div class="pull-right">
								<a href="#/mail/compose" class="btn btn-sm btn-primary">Reply <i class="fa fa-mail-reply"></i></a>
								<a href="javascript:;" class="btn btn-sm btn-default"><i class="fa fa-star"></i></a>
								<a href="#" class="btn btn-sm btn-default btn_delete"><i class="fa fa-trash-o"></i></a>
							</div>
						</div>
					</div>
					<?php foreach ($contactsResult as $contacts):
						$redFlagClass = '';
						$readFlagClass = '';
						$hightLightClass = '';
						$redFlagActionClass = '';
						if ($contacts->red_flag) {
							$redFlagClass = 'active';
							$hightLightClass = 'mail-hightlight';
							$redFlagActionClass = 'unred';
						}
					?>
					<div id="row-<?= $contacts->id?>" class="contact-info" _id="<?= $contacts->id?>" >
					<div class="mail-info">
						<div class="row">
							<div class="col-md-7">
								<strong><?= $contacts->full_name ?></strong> (<?= $contacts->email ?>) to
								<strong>me</strong>
							</div>
							<div class="col-md-2">
								<div class="pull-right">
									<?= $contacts->created->i18nFormat(__('TIMES_MINUTES')) ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="pull-right">
									<a href="<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $contacts->id]); ?>" class="btn btn-sm btn-primary">Reply <i class="fa fa-mail-reply"></i></a>
									<a href="javascript:;" class="btn btn-sm btn-default "><i class="fa fa-star <?= $redFlagClass ?>"></i></a>
									<a href="javascript:;" class="btn btn-sm btn-default btn_delete"><i class="fa fa-trash-o"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="mail-content">
						<?= $contacts->body ?>
					</div>
					<div class="mail-attachments">
						<p><i class="fa fa-paperclip"></i> 2 attachements | <a href="javascript:;">Save all attachements</a></p>
						<ul class="list-unstyled list-inline list-attachs">
							<li><a href="javascript:;"><img src="images/assets/600_400-1.jpg" alt=""></a></li>
							<li><a href="javascript:;"><img src="images/assets/600_400-2.jpg" alt=""></a></li>
						</ul>
					</div>
					</div>
					<?php endforeach; ?>
					<div class="mail-actions">
						<a href="<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $contacts->id]); ?>" class="btn btn-sm btn-primary">Reply <i class="fa fa-mail-reply"></i></a>
						<a href="#/mail/compose" class="btn btn-sm btn-default">Forward <i class="fa fa-mail-forward"></i></a>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>