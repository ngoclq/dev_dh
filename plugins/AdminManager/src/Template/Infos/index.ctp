<div class="page page-table" data-ng-controller="tableCtrl">

	<section class="panel panel-default table-dynamic">
		<div class="panel-heading">
			<strong><span class="glyphicon glyphicon-th"></span> Bordered table</strong>
		</div>

		<div class="table-filters">
			<div class="row">
				<div class="col-sm-4 col-xs-6">
					<form>
						<input type="text" placeholder="search" class="form-control"
							data-ng-model="searchKeywords" data-ng-keyup="search()">
					</form>
				</div>
			</div>
		</div>

		<table class="table table-striped table-bordered">
			<thead class="">
				<tr class="thead-header bg-success">
					<th class="th col-sm-1"><div class="th">
							<?= __('ID') ?>
						</div></th>
					<th class="th col-sm-4"><div class="th">
							<?= __('TITLE') . ' (' . __('VIETNAMESE') . ')' ?>
						</div></th>
					<th class="th col-sm-4"><div class="th">
							<?= __('TITLE') . ' (' . __('JAPANESE') . ')' ?>
						</div></th>
					<th class="th col-sm-2"><div class="th">
							<?= __('CREATED') ?>
						</div></th>
					<th class="th col-sm-2"><div><?= __('') ?></div></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($newsResult as $news):?>
				<tr id="id-<?= $news->id ?>">
					<td >
						<?= $news->id ?>
					</td>
					<td>
						<?= $news->title_vi ?>
					</td>
					<td>
						<?= $news->title_jp ?>
					</td>
					<td>
						<?= $news->created->i18nFormat(__('TIMES_MINUTES')) ?>
					</td>
					<td>
						<?= $this->Html->link(
								__('BTN_DETAIL'),
								['controller' => 'Infos', 'action' => 'form', '_method' => 'GET', $news->id],
								['escape' => false, 'class' => ['btnAction btn btn-w-xs btn-primary']]
							) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</section>

</div>

