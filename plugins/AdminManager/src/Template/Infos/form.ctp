<div class="page page-form">
	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong><span class="glyphicon glyphicon-th"></span> Dang ky category</strong>
				</div>
				<div class="panel-body">
					<?= $this->Form->create($news, ['name' => "form_news", 'class' => "form-horizontal form-validation"]) ?>
					<fieldset>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('TITLE') . '(' . __('VIETNAMESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('title_vi', ['label' => false, 'class' => "form-control"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('BODY_CONTENT') . '(' . __('VIETNAMESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('body_vi', ['label' => false, 'id' => 'body_vi', 'class' => "form-control"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('TITLE') . '(' . __('JAPANESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('title_jp', ['label' => false, 'class' => "form-control"]) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 required">
								<label for=""> <?= __('BODY_CONTENT') . '(' . __('JAPANESE') . ')' ?>
								</label>
							</div>
							<div class="col-sm-8">
								<?=  $this->Form->control('body_jp', ['label' => false, 'id' => 'body_jp', 'class' => "form-control"]) ?>
							</div>
						</div>
						<?=  $this->Form->button(__('BTN_SAVE'), ['class'=> "btn btn-success"]) ?>
						<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button', 'class' => "btn btn-default"]) ?>
					</fieldset>
					<?=  $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var bodyVi = '';
    var bodyJp = '';
    ClassicEditor
        .create(
            document.querySelector('#body_vi'),
            {
                ckfinder: { uploadUrl: '/upload'}
            }
        ).then(
            editor => {
                bodyVi = editor.getData();
            }
        ).catch( error => {
        console.error( error );
    } );

    ClassicEditor
        .create(
            document.querySelector('#body_jp'),
            {
                ckfinder: {uploadUrl: '/upload'}
            }
        ).then(
        editor => {
            bodyJp = editor.getData();
        }
    ).catch( error => {
        console.error( error );
    } );
    $( document ).ready(function() {
        $(document).on("mousedown",".btn-success",function() {
            $('#body_vi').val(bodyVi);
            $('#body_jp').val(bodyVi);
        });
    });

</script>
