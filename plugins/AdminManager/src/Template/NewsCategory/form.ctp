<div class="page page-form">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong><span class="glyphicon glyphicon-th"></span> Dang ky category</strong>
				</div>
				<div class="panel-body" data-ng-controller="addNewsCategoryCtrl">
					<?= $this->Form->create($newsCategory, ['name' => "form_news_category", 'class' => "form-horizontal form-validation", 'data-ng-submit' => "submitForm()"]) ?>
						<fieldset>
							<div class="form-group">
								<div class="col-sm-3">
									<label for=""> <?= __('CATEGORY') ?></label>
								</div>
								<div class="col-sm-9">
									<?=  $this->Form->control('parent_id', ['label' => false, 'class' => "form-control", 'options' => $news_category_id, 'empty' => true,
									'templates' => [
									'inputContainer' => '<span class="ui-select">{{content}}</span>'
									]]) ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for=""><?= __('NAME') . '(' . __('VIETNAMESE') . ')' ?></label>
								</div>
								<div class="col-sm-9">
									<?=  $this->Form->control('title_vi', ['label' => false, 'class' => "form-control",'ng-init'=>"category.title_vi ='$newsCategory->title_vi'",'data-ng-model' => "category.title_vi"]) ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for=""><?= __('DESCRIPTION') . '(' . __('VIETNAMESE') . ')' ?></label>
								</div>
								<div class="col-sm-9">
									<?=  $this->Form->control('description_vi', ['label' => false, 'class' => "form-control",'ng-init'=>"category.description_vi ='$newsCategory->description_vi'", 'data-ng-model' => "category.description_vi"]) ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for=""><?= __('NAME') . '(' . __('JAPANESE') . ')' ?></label>
								</div>
								<div class="col-sm-9">
									<?=  $this->Form->control('title_jp', ['label' => false, 'class' => "form-control",'ng-init'=>"category.title_jp ='$newsCategory->title_jp'", 'data-ng-model' => "category.title_jp"]) ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for=""><?= __('DESCRIPTION') . '(' . __('JAPANESE') . ')' ?></label>
								</div>
								<div class="col-sm-9">
									<?=  $this->Form->control('description_jp', ['label' => false, 'class' => "form-control",'ng-init'=>"category.description_jp ='$newsCategory->description_jp'", 'data-ng-model' => "category.description_jp"]) ?>
								</div>
							</div>
							<?=  $this->Form->button(__('BTN_SAVE'), ['class'=> "btn btn-success", 'data-ng-disabled' => "!canSubmit()"]) ?>
							<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button', 'class' => "btn btn-default", 'data-ng-disabled' => "!canRevert()", 'data-ng-click' => "revert()"]) ?>
							<!-- <button type="submit" class="btn btn-success"
								data-ng-disabled="!canSubmit()">Submit</button>
							<button class="btn btn-default" data-ng-disabled="!canRevert()"
								data-ng-click="revert()">Revert Changes</button> -->
							<!-- <div class="callout callout-info">
								<p>Submit button will be active only when all fields are
									valid.</p>
								<p>Revert button will be active only when one or more fields
									is changed.</p>
							</div>
							<div class="divider"></div>
							<div class="alert alert-info" data-ng-show="showInfoOnSubmit">This
								is just for demo. In real project, you will submit form with
								AJAX :)</div> -->
						</fieldset>
					<?=  $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
