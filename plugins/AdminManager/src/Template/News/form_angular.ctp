
<div class="page page-form">
	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong><span class="glyphicon glyphicon-th"></span> Dang
						ky category</strong>
				</div>
				<div class="panel-body" data-ng-controller="addNewsCtrl">
					<?= $this->Form->create($news, ['name' => "form_news", 'class' => "form-horizontal form-validation", 'data-ng-submit' => "submitForm()"]) ?>
					<fieldset>
						<div class="form-group">
							<div class="col-sm-4">
								<label for=""> <?=  __('ANNOTATIONS_FOR_TOP_FLAG')?>
								</label>
							</div>
							<div class="col-sm-8">
								<div class="checkbox">
									<label class="switch"> <?=  $this->Form->checkbox('top_flag', ['value' => '1', 'hiddenField' => true, 'data-ng-model' => "news_info.top_flag"]) ?>
										<i></i>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('CATEGORY') ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('news_category_id', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.news_category_id", 'options' => $news_category_id, 'empty' => true,
									'templates' => [
										'inputContainer' => '<span class="ui-select">{{content}}</span>'
									]]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('TITLE') . '(' . __('VIETNAMESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('title_vi', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.title_vi"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('BODY_CONTENT') . '(' . __('VIETNAMESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('body_vi', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.body_vi"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for=""> <?= __('KEY_WORD') . '(' . __('VIETNAMESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('keyword_vi', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.keyword_vi"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('TITLE') . '(' . __('JAPANESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('title_jp', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.title_jp"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('BODY_CONTENT') . '(' . __('JAPANESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('body_jp', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.body_jp"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for=""> <?= __('KEY_WORD') . '(' . __('JAPANESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('keyword_jp', ['label' => false, 'class' => "form-control", 'data-ng-model' => "news_info.keyword_jp"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for=""> <?= __('ACTIVE_DATE') ?>
								</label>
							</div>
							<div class="col-sm-8">
								<div class="col-sm-4" data-ng-controller="DatepickerDemoCtrl">
									<?=  $this->Form->control('date_active', ['name' => "date_active[day]",'label' => false, 'type' => "text", 'class' => "form-control", 'datepicker-popup' => "{{format}}", 'data-ng-model' => "news_info.date_active", 'is-open' => "opened", 'min' => "minDate", 'max' => "", 'datepicker-options' => "dateOptions", 'ng-required' => "true", 'close-text' => "Close", 
									'templates' => [
										'inputContainer' => '<div class="input-group ui-datepicker">{{content}}<span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span></div>'
									]]) ?>
								</div>
								<div class="col-sm-2">
									<?= $this->Form->input('date_active[hour]', 
										['label' => false, 'type' => 'select', 'options' => $aryHour, 'empty' => __('LABEL_HOUR'), 'class' => 'form-control', 'required' => true, 'default' => date('H') ]
										)
									?>
								</div>
								<div class="col-sm-2">
									<?= $this->Form->input('date_active[minute]', 
										['type' => 'select', 'options' => $aryMinute, 'empty' => __('LABEL_MINUTE'), 'class' => 'form-control', 'required' => true, 'label' => false, 'default' => date('i') ]
										)
									?>
								</div>
							</div>
						</div>
						<?=  $this->Form->button(__('BTN_SAVE'), ['class'=> "btn btn-success", 'data-ng-disabled' => "!canSubmit()"]) ?>
						<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button', 'class' => "btn btn-default", 'data-ng-disabled' => "!canRevert()", 'data-ng-click' => "revert()"]) ?>
					</fieldset>
					<?=  $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>

