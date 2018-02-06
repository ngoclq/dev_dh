<section class="box-news-suggest c_side_keywordsrank">
	<h1 style="margin: 0;"><?= __('NEWS_SUGGEST') ?></h1>
	<ol class="c_list_article">
		<li class="items_hiden"><a class="" href="<?= $this->Url->build(['controller' => 'News', 'action' => 'detail', '_method' => 'GET', '_xxxx_xx_xxxx_']); ?>"></a></li>
	</ol>
	<p class="view-more items_hiden" style="text-align: right; padding: 5px 5px 0 0;">
		<?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'index', '_method' => 'GET'] ) ?>
	</p>
</section>
