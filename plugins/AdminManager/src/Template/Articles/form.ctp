<div class="row">
	<div class="columns large-12">
		<h1>Blog articles</h1>
		<?= $this->Form->create($articles) ?>
		<?=  $this->Form->control('article_category_id', ['label' => __('CATEGORY'), 'options' => $article_category_id, 'empty' => true]) ?>
		<?=  $this->Form->control('title_vi', ['label' => __('TITLE') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('body_vi', ['label' => __('BODY_CONTENT') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('keyword_vi', ['label' => __('KEY_WORD') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('title_jp', ['label' => __('TITLE') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Form->control('body_jp', ['label' => __('BODY_CONTENT') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Form->control('keyword_jp', ['label' => __('KEY_WORD') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Froala->editor('#body-vi', ['minHeight' => '200px', 'maxHeight' => '400px']) ?>
		<?=  $this->Froala->editor('#body-jp', ['minHeight' => '200px', 'maxHeight' => '400px']) ?>
		<div>
			<?=  $this->Form->button(__('BTN_SAVE')) ?>
			&nbsp;
			<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button']) ?>
		</div>
		<?=  $this->Form->end() ?>
	</div>
</div>
