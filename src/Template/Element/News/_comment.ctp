
<!-- /section.c_section_contents -->
<section class="box-newslist">
	<h1>&nbsp;</h1>
	<div class="box-news-comment e_news_relate_list_templatte e_carenews_list_article">
		<article class="article-comment items_hiden">
			<h2 name=""></h2>
			<div class="cf mt10">
				<ul class="e_article_data cf">
					<li><a class="user_name" href=""></a>さん</li>
					<li><time></time></li>
				</ul>
				<p class="e_report">&nbsp;</p>
			</div>
			<div class="e_article_txt_top"></div>
			<div class="e_article_inner_respons">
				<p></p>
			</div>
			<div class="mt10 cf">
				<ul class="e_snsbox cf">
				</ul>
			</div>
			<div class="mt10 cf">
				<div class="e_like_box cf">
					<!-- <a href="/login/?ref=%2Fbbs%2F10414%3Ffr%3DIndList"
						class="e_btn_like2"><img src="/img/bbs/btn_like2.gif?20140210"
						alt="なるほど"></a> <span class="e_like_count" id="rate_flg_1_51556">0</span> -->
				</div>
				<a href="/login/?ref=%2Fbbs%2F10414%3Ffr%3DIndList"
					class="e_btn_comment2"><img
					src="/img/bbs/btn_bbs_comment2.gif?20140210" alt="コメントする"></a>
			</div>
		</article>

	</div>
</section>

<section class="box-newslist">
	<div class="popup_comment row">
		<div class="columns ">
			<h1>Gửi bình luận</h1>
			<?= $this->Form->create($newsThreads, ['id' => 'form_comment', 'type' => 'get']) ?>
			<?=  $this->Form->control('news_id', ['type' => 'hidden', 'value' => $newsInfo['id'] ]) ?>
			<?=  $this->Form->control('locale', ['type' => 'hidden', 'value' => $language ]) ?>
			<?=  $this->Form->control('title', ['label' => __('TITLE') ]) ?>
			<?=  $this->Form->control('body', ['label' => __('BODY_CONTENT'), 'class' => 'ckeditor' ]) ?>
			<div>
				<?=  $this->Form->button(__('BTN_SAVE'), ['type' => 'button', 'id' => 'btn_submit']) ?>
				&nbsp;
				<?=  $this->Form->button(__('BTN_CANCEL'), ['type' => 'button']) ?>
			</div>
			<?=  $this->Form->end() ?>
		</div>
	</div>
</section>
