<?= $this->element('header'); ?>
<!-- ============================== contents Area ============================== -->
<div id="contents" class="cf">
	<div id="main">
		<div class="users form">
			<?= $this->Form->create($user) ?>
			<fieldset>
				<legend>
					<?= __('Add User') ?>
				</legend>
				<?= $this->Form->control('first_name', ['label' => __('FIRST_NAME'), 'type' => 'text']) ?>
				<?= $this->Form->control('last_name', ['label' => __('LAST_NAME'), 'type' => 'text']) ?>
				<?= $this->Form->control('username', ['label' => __('EMAIL'), 'type' => 'text']) ?>
				<?= $this->Form->control('password', ['label' => __('PASSWORD')]) ?>
				<?= $this->Form->control('password_raw', ['label' => __('PASSWORD_RAW'), 'type' => 'password']) ?>
			</fieldset>
			<?= $this->Form->button(__('Submit')); ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
<!-- /contents -->

<?= $this->element('footer'); ?>