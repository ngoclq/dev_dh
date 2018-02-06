<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_news_category = "<?= $this->Url->build([ 'controller' => 'NewsCategory', 'action' => 'actionAjax', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
	/* ]]> */
</script>
<?php $this->assign('script', $this->Html->script(['AdminManager.articlesCategory.js'])); ?>

<div class="row">
	<div class="columns large-12">
		<h1>Blog articles</h1>
		<table>
			<tr>
				<th width="40px"><?= __('NO_NUMBER') ?></th>
				<th width="300px"><?= __('NAME') . '(' . __('VIETNAMESE') . ')' ?></th>
				<th width="300px"><?= __('NAME') . '(' . __('JAPANESE') . ')' ?></th>
				<th width="130px"><?= __('CREATED') ?></th>
				<th width="200px"></th>
			</tr>

			<?php foreach ($news as $newsInfo):
					$styleForHide = 'items-id-' . $newsInfo->id;
					$styleForShow = 'items-id-' . $newsInfo->id;
				if ($newsInfo->display_flag) {
					$styleForShow .= ' items_hiden';
				} else {
					$styleForHide .= ' items_hiden';
				}

			?>
			<tr id="id-<?= $newsInfo->id ?>">
				<td>
					<?= $this->Html->link($newsInfo->id, [ 'controller' => 'NewsCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $newsInfo->id]) ?>
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
				<td>
					<?= $this->Form->button(__('BTN_HIDDEN'), ['type'=>'button', 'class' => ['btnAction', $styleForHide], 'rel' => '_action_news_category', '_handle' => 'hide', 'val' => $newsInfo->id ] ) ?>
					<?= $this->Form->button(__('BTN_SHOW'), ['type'=>'button', 'class' => ['btnAction', $styleForShow], 'rel' => '_action_news_category', '_handle' => 'show', 'val' => $newsInfo->id ] ) ?>
					<?= $this->Form->button(__('BTN_DELETE'), ['type'=>'button', 'class' => ['btnAction'], 'rel' => '_action_news_category', '_handle' => 'del', 'val' => $newsInfo->id ] ) ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>

