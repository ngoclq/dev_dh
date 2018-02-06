<script
	src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<link rel='stylesheet'
	href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<?php $this->assign('css', $this->Html->css(['/asset/my_template/css/reset.css', '/asset/my_template/css/style_login.css'])); ?>
<?php $this->assign('script', $this->Html->script(['/asset/my_template/js/login.js'])); ?>

<?= $this->element('header'); ?>
<div class="pen-title">
	<h1>&nbsp;</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
	<div class="toggle">
		<i class="fa fa-times fa-pencil"></i>
		<div class="tooltip">Click Me</div>
	</div>
	<div class="form"
		<?php if($form_register) {?> style="display: none;" <?php } ?>>

		<?= $this->Flash->render() ?>
		<h2>Login to your account</h2>

		<?= $this->Form->create() ?>
		<!-- <input type="text" placeholder="Username" /> <input type="password" placeholder="Password" /> -->
		<?= $this->Form->control('username', ['label' => __('EMAIL')]) ?>
		<?= $this->Form->control('password', ['label' => __('PASSWORD')]) ?>
		<?= $this->Form->button(__('Login')); ?>
		<?= $this->Form->end() ?>
	</div>
	<div class="form"
		<?php if($form_register) {?> style="display: block;" <?php } else {?>style="display: none;"<?php } ?>>
		
			<?= $this->Form->create($user) ?>
			<fieldset>
				<legend>
					<h2><?= __('Add User') ?></h2>
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
	<div class="cta">
		<a href="">Forgot your password?</a>
	</div>
</div>

<?= $this->element('footer'); ?>

