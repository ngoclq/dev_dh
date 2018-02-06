<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	var _action_article_category = "<?= $this->Url->build([ 'controller' => 'ArticlesCategory', 'action' => 'actionAjax', '_method' => 'GET', 'plugin' => 'AdminManager']); ?>";
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

			<?php foreach ($articles as $article):
					$styleForHide = 'items-id-' . $article->id;
					$styleForShow = 'items-id-' . $article->id;
				if ($article->display_flag) {
					$styleForShow .= ' items_hiden';
				} else {
					$styleForHide .= ' items_hiden';
				}

			?>
			<tr id="id-<?= $article->id ?>">
				<td>
					<?= $this->Html->link($article->id, [ 'controller' => 'ArticlesCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $article->id]) ?>
				</td>
				<td>
					<?= $this->Html->link($article->title_vi, [ 'controller' => 'ArticlesCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $article->id]) ?>
				</td>
				<td>
					<?= $this->Html->link($article->title_jp, [ 'controller' => 'ArticlesCategory', 'action' => 'form', '_method' => 'GET', 'plugin' => 'AdminManager', $article->id]) ?>
				</td>
				<td>
					<?= $article->created->i18nFormat('yyyy-MM-dd HH:mm:ss') ?>
				</td>
				<td>
					<?= $this->Form->button(__('BTN_HIDDEN'), ['type'=>'button', 'class' => ['btnAction', $styleForHide], 'rel' => '_action_article_category', '_handle' => 'hide', 'val' => $article->id ] ) ?>
					<?= $this->Form->button(__('BTN_SHOW'), ['type'=>'button', 'class' => ['btnAction', $styleForShow], 'rel' => '_action_article_category', '_handle' => 'show', 'val' => $article->id ] ) ?>
					<?= $this->Form->button(__('BTN_DELETE'), ['type'=>'button', 'class' => ['btnAction'], 'rel' => '_action_article_category', '_handle' => 'del', 'val' => $article->id ] ) ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>

