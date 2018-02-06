
<div class="row">
	<div class="columns large-12">
		<h1>Blog articles</h1>
		<?= $this->Form->create($articleCategory) ?>
		<?=  $this->Form->control('title_vi', ['label' => __('NAME') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('description_vi', ['label' => __('DESCRIPTION') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('title_jp', ['label' => __('NAME') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Form->control('description_jp', ['label' => __('DESCRIPTION') . '(' . __('JAPANESE') . ')']) ?>
		<div>
			<?=  $this->Form->button(__('BTN_SAVE')) ?>
			&nbsp;
			<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button']) ?>
		</div>
		<?=  $this->Form->end() ?>
	</div>
</div>
