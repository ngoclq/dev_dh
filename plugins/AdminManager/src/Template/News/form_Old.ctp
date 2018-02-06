<?= $this->Froala->plugin();?>
<div class="row">
	<div class="columns large-12">
		<h1>Blog articles</h1>
		<?= $this->Form->create($news) ?>
		<div class="input checkbox">
			<label for="top_flag"> <?=  $this->Form->checkbox('top_flag', ['value' => '1', 'hiddenField' => true]) ?><?=  __('ANNOTATIONS_FOR_TOP_FLAG')?>
			</label>
		</div>
		<?=  $this->Form->control('news_category_id', ['label' => __('CATEGORY'), 'options' => $news_category_id, 'empty' => true]) ?>
		<?=  $this->Form->control('title_vi', ['label' => __('TITLE') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('body_vi', ['label' => __('BODY_CONTENT') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('keyword_vi', ['label' => __('KEY_WORD') . '(' . __('VIETNAMESE') . ')']) ?>
		<?=  $this->Form->control('title_jp', ['label' => __('TITLE') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Form->control('body_jp', ['label' => __('BODY_CONTENT') . '(' . __('JAPANESE') . ')']) ?>
		<?=  $this->Form->control('keyword_jp', ['label' =>  __('KEY_WORD') . '(' . __('JAPANESE') . ')']) ?>
		<div class="input checkbox">
			<label for="top_flag"> <?=  $this->Form->checkbox('date_active', ['value' => '1', 'hiddenField' => true]) ?><?=  __('ACTIVE_DATE') . " " . __('ANNOTATIONS_ACTIVE_DATE')?>
			</label>
		</div>
		<?=  $this->Form->control('date_active', ['label' => '', 'class' => 'items_disable' ]) ?>
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
