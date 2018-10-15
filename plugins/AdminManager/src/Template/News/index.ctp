<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_news_handler = "<?= $this->Url->build([ 'controller' => 'News', 'action' => 'actionAjax', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
	/* ]]> */
</script>
<?php $this->assign('script', $this->Html->script(['AdminManager.articlesCategory.js'])); ?>


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
				<div class="col-sm-3 col-xs-6 filter-result-info">
					<span> Showing {{filteredStores.length}}/{{stores.length}}
						entries </span>
					<span><?= $this->Html->link(__('ADD'), [ 'controller' => 'News', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager']) ?> </span>
				</div>
			</div>
		</div>

		<table class="table table-striped table-bordered">
			<thead class="">
				<tr class="thead-header bg-success">
					<th class="th col-sm-1"><div class="th">
							<?= __('ID') ?>
						</div></th>
					<th class="th col-sm-3"><div class="th">
							<?= __('TITLE') . ' (' . __('VIETNAMESE') . ')' ?>
						</div></th>
					<th class="th col-sm-3"><div class="th">
							<?= __('TITLE') . ' (' . __('JAPANESE') . ')' ?>
						</div></th>
					<th class="th col-sm-2"><div class="th">
							<?= __('CREATED') ?>
						</div></th>
					<th class="th col-sm-2"><div><?= __('') ?></div></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($newsResult as $news):
					$styleForHide = 'items-id-' . $news->id;
					$styleForShow = 'items-id-' . $news->id;
					if ($news->display_flag) {
						$styleForShow .= ' items_hiden';
					} else {
						$styleForHide .= ' items_hiden';
					}
				?>
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
								['controller' => 'News', 'action' => 'form', '_method' => 'GET', $news->id],
								['escape' => false, 'class' => ['btnAction btn btn-w-xs btn-primary']]
							) ?>

						<?= $this->Form->button(__('BTN_HIDDEN'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-warning', $styleForHide], 'rel' => '_action_news_handler', '_handle' => 'hide', 'val' => $news->id ] ) ?>
						<?= $this->Form->button(__('BTN_SHOW'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-primary', $styleForShow], 'rel' => '_action_news_handler', '_handle' => 'show', 'val' => $news->id ] ) ?>
						<?= $this->Form->button(__('BTN_DELETE'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-danger'], 'rel' => '_action_news_handler', '_handle' => 'del', 'val' => $news->id ] ) ?>

					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<footer class="table-footer">
			<div class="row">
				<div class="col-md-6 page-num-info">
					<span> Show <select data-ng-model="numPerPage"
						data-ng-options="num for num in numPerPageOpt"
						data-ng-change="onNumPerPageChange()">
					</select> entries per page
					</span>
				</div>
				<div class="col-md-6 text-right pagination-container">
					<pagination class="pagination-sm" ng-model="currentPage"
						total-items="filteredStores.length" max-size="4"
						ng-change="select(currentPage)" items-per-page="numPerPage"
						rotate="false" boundary-links="true"></pagination>
				</div>
			</div>
		</footer>
	</section>
	<?php /*
// Shows the page numbers
<?= $this->Paginator->numbers() ?>

// Shows the next and previous links
<?= $this->Paginator->prev('« Previous') ?>
<?= $this->Paginator->next('Next »') ?>
*/?>
</div>

