<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_contacts_detail = "<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'detail', '_method' => 'GET', 'plugin' => 'AdminManager', '_xxxx_xx_xxxx_']); ?>";
	var _action_contacts_edit = "<?= $this->Url->build([ 'controller' => 'Contacts', 'action' => 'actionEditRedFlag', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
	/* ]]> */
</script>
<?php $this->assign('script', $this->Html->script(['AdminManager.contacts.js'])); ?>

<div class="page">
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
			<section class="panel panel-default mail-container">
				<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Inbox</strong></div>
				<div class="mail-options">
					<label class="ui-checkbox"><input name="checkbox1" type="checkbox" value="option1" ><span>Toggle All</span></label>
				</div>
				<table id="tbl-mail" class="table table-hover">
				<?php foreach ($contactsResult as $contacts):
					$strCount = '';
					$redFlagClass = '';
					$readFlagClass = '';
					$hightLightClass = '';
					$redFlagActionClass = '';
					if ($contacts->red_flag) {
						$redFlagClass = 'active';
						$hightLightClass = 'mail-hightlight';
						$redFlagActionClass = 'unred';
					}
					if (!$contacts->read_flag) {
						$readFlagClass = 'mail-unread';
					}
					if ($contacts->count_sub_id > 1) {
						$strCount = ' (' . $contacts->count_sub_id . ')';
					}
				?>
					<tr class="<?= $readFlagClass ?> <?= $hightLightClass?>" _id="<?= $contacts->id ?>">
						<td><label class="ui-checkbox"><input name="checkbox1" type="checkbox" value="option1" ><span></span></label>
							<i class="fa fa-star btn_red_action <?= $redFlagClass ?> <?= $redFlagActionClass?>"></i>
						</td>
						<td><?= $contacts->full_name?> <i class="fa fa-circle color-info"></i></td>
						<td><?= $this->Html->link($contacts->title . $strCount, [ 'controller' => 'Contacts', 'action' => 'detail', '_method' => 'GET', 'plugin' => 'AdminManager', $contacts->id]) ?></td>
						<td><i class="fa fa-paperclip"></i></td>
						<td><?= $contacts->created->i18nFormat(__('FULL_TIMES'))?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</section>
		</div>
	</div>
</div>