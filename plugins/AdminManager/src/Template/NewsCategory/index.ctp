<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_news_category = "<?= $this->Url->build([ 'controller' => 'NewsCategory', 'action' => 'actionAjax', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
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
					<span><?= $this->Html->link(__('ADD'), [ 'controller' => 'NewsCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager']) ?> </span>
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
					<!-- <th class="th col-sm-2"><div><?= __('FUNCTION') ?></div></th> -->
				</tr>
			</thead>
			<tbody>
				<?php
			unset($newsCategory['article_total'], $newsCategory['view_total']);
			foreach ($newsCategory as $newsInfo):
					$styleForHide = 'items-id-' . $newsInfo->id;
					$styleForShow = 'items-id-' . $newsInfo->id;
				if ($newsInfo->display_flag) {
					$styleForShow .= ' items_hiden';
				} else {
					$styleForHide .= ' items_hiden';
				}

			?>
				<tr id="id-<?= $newsInfo->id ?>">
					<td rowspan="2">
						<?= $this->Html->link($newsInfo->id, [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager', $newsInfo->id]) ?>
					</td>
					<td>
						<?= $this->Html->link($newsInfo->title_vi, [ 'controller' => 'NewsCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $newsInfo->id]) ?>
					</td>
					<td>
						<?= $this->Html->link($newsInfo->title_jp, [ 'controller' => 'NewsCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $newsInfo->id]) ?>
					</td>
					<td>
						<?= $newsInfo->created->i18nFormat('yyyy-MM-dd HH:mm:ss') ?>
					</td>
				</tr>
				<tr id="id-<?= $newsInfo->id ?>">
					<td>
						<ul>
							<li class="bullet book">
							<?= $this->Html->link('Có tổng ' . ((int)$newsInfo->article_number['0'] + (int)$newsInfo->article_number['1']) . ' bài viết', [ 'controller' => 'News', 'action' => 'index', '_method' => 'GET', 'plugin' => 'AdminManager', $newsInfo->id]) ?>
							</li>
							<li class="bullet book">Có <?= $newsInfo->article_number['0'] ?>
								bài viết không hiển thị
							</li>
							<li class="bullet book">Có <?= $newsInfo->article_number['1'] ?>
								bài viết hiển thị
							</li>
						</ul>
					</td>
					<td>
						<ul>
							<li class="bullet book">Có tổng <?= (int)$newsInfo->view_number['0'] + (int)$newsInfo->view_number['1'] ?>
								lượt xem
							</li>
							<li class="bullet book">Có <?= $newsInfo->view_number['0'] ?>
								lượt xem từ user vãng lai
							</li>
							<li class="bullet book">Có <?= $newsInfo->view_number['1'] ?>
								lượt xem từ user hệ thống
							</li>
						</ul>
					</td>
					<td>
						<?= $this->Form->button(__('BTN_HIDDEN'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-warning', $styleForHide], 'rel' => '_action_news_category', '_handle' => 'hide', 'val' => $newsInfo->id ] ) ?>
						<?= $this->Form->button(__('BTN_SHOW'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-primary', $styleForShow], 'rel' => '_action_news_category', '_handle' => 'show', 'val' => $newsInfo->id ] ) ?>
						<?= $this->Form->button(__('BTN_DELETE'), ['type'=>'button', 'class' => ['btnAction btn btn-w-xs btn-danger'], 'rel' => '_action_news_category', '_handle' => 'del', 'val' => $newsInfo->id ] ) ?>
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

</div>