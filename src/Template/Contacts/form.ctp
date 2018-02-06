<!-- ============================== contents Area ============================== -->
<div id="contents" class="cf">
	<div id="main">
		<section class="box-newslist">
			<div class="popup_comment row">
				<div class="columns ">
					<h1>Gửi bình luận</h1>
					<?= $this->Form->create($contacts) ?>
					<?=  $this->Form->control('id', ['type' => 'hidden', 'value' => $contactsInfo['hash'] ]) ?>
					<?=  $this->Form->control('locale', ['type' => 'hidden', 'value' => $language ]) ?>
					<?=  $this->Form->control('full_name', ['label' => __('FULL_NAME'), 'default' => $contactsInfo['full_name'] ]) ?>
					<?=  $this->Form->control('email', ['label' => __('EMAIL'), 'default' => $contactsInfo['email'] ]) ?>
					<?=  $this->Form->control('phone_number', ['label' => __('LABEL_PHONE_NUMBER'), 'default' => $contactsInfo['phone_number'] ]) ?>
					<?=  $this->Form->control('title', ['label' => __('LABEL_TITLE'), 'default' => $contactsInfo['title'] ]) ?>
					<?=  $this->Form->control('body', ['label' => __('LABEL_CONTENTS'), 'class' => 'ckeditor' ]) ?>
					<div>
						<?=  $this->Form->button(__('BTN_SEND'), ['type' => 'submit']) ?>
					</div>
					<?=  $this->Form->end() ?>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- /contents -->
<!-- ============================== /contents Area ============================== -->
