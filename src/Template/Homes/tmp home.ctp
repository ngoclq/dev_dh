
<?= $this->element('header'); ?>
<!-- ============================== contents Area ============================== -->
<div id="contents" class="cf">
	<div id="main">
		<section class="c_section_contents">
			<div class="cf">
				<h1 class="e_tit_newblog">新着ニュース</h1>
			</div>
			<div class="c_section_box cf">
				<ul class="news_topic">
					<?php foreach ($newsResult as $news):?>
					<li class="article">
						<?php if (isset($news->list_img[0])) {
							$alt = '';
							$src = $news->list_img[0]['src'];
							if (isset($news->list_img[0]['alt'])) {
								$alt = $news->list_img[0]['alt'];
							}
						?>
						<div class="list_photo">
							<?= $this->Html->link(
									$this->Html->image($src, ["alt" => $alt, "class" => "pic_set"]),
									['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
									['escape' => false]
								);
							?>
						</div>
							<?php } ?>
						<div class="list_title">
							<h2 id="h2-id6">
							<?= $this->Html->link(
								$news->title . $this->Html->tag('span', 'NEW!', ['class' => 'c_notice_new']),
								['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id],
								['escape' => false]
							) ?>
							</h2>
						</div>
						<div class="list_read">
							<p class="c_lead">
								<span style="font-size: 0.7em; color: #47885e;"> <?= $news->created->i18nFormat(__('TIMES_MINUTES')) ?>
								</span> <br>
								<?= $this->Text->truncate($news->body, 100) ?>
							</p>
							<?= $this->Html->link(__('VIEW_MORE'), ['controller' => 'News', 'action' => 'detail', '_method' => 'GET', $news->id] ) ?>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="cb"></div>
			</div>
			<!-- /.c_section_box -->
		</section>
		<!-- /section.c_section_contents -->
		<div class="cf">
			<div class="e_pagination cf">
				<ul class="cf">
					<li><a class="current_page">前へ</a></li>
					<li><a id="current_page" class="current_page">1</a></li>
					<li><a href="/carenews/?page=2" class="number">2</a></li>
					<li><a href="/carenews/?page=3" class="number">3</a></li>
					<li><a href="/carenews/?page=4" class="number">4</a></li>
					<li><a href="/carenews/?page=5" class="number lastChild">5</a></li>
					<li>...</li>
					<li><a href="/carenews/?page=253">253</a></li>
					<li><a href="/carenews/?page=2">次へ</a></li>
				</ul>
			</div>
			<!-- /.e_pagination-->
		</div>
		<div style="text-align: center; margin: 30px 0;">
			<div style="float: left;"></div>
			<div style="float: right;"></div>
			<div style="clear: both;"></div>
		</div>
	</div>
	<!-- /div#main -->
	<!-- ============================== side Area ============================== -->
	<div id="sidebar">
		<?= $this->Html->script('/asset/my_template/js/rollover.js') ?>
		<div class="mt10 center">
			<p style="text-align: center;">== オススメ介護求人 ==</p>
		</div>
		<section class="c_side_keywordsrank">
			<h1 style="margin: 0;">けあZine最新記事</h1>
			<ol class="c_list_article">
				<li><a class="" href="/carezine/article/56/628/?fr=CnRight">
						覚悟はしていたけれど</a></li>
				<li><a class="" href="/carezine/article/24/627/?fr=CnRight">
						地域のSW機能を高めるための道筋</a></li>
				<li><a class="" href="/carezine/article/65/626/?fr=CnRight">
						リハビリはセラピストだけではない、介護職でもできるリハビリとは</a></li>
				<li><a class="" href="/carezine/article/62/625/?fr=CnRight">
						ケアマネ間の上下関係とケアマネ不要論〜主任介護支援専門員更新研修を受講して〜</a></li>
				<li><a class="" href="/carezine/article/56/624/?fr=CnRight">
						ステキなインフォーマル</a></li>
			</ol>
			<p style="text-align: right; padding: 5px 5px 0 0;">
				<a href="/carezine/?fr=CnRight">もっと見る</a>
			</p>
		</section>
		<section class="c_side_keywordsrank">
			<h1 style="margin: 0;">けあGAKU最新記事</h1>
			<ol class="c_list_article">
				<li><a href="/caregaku/138?fr=CnRight">日本人の死因1位の「がん」
						予防するには？</a></li>
				<li><a href="/caregaku/139?fr=CnRight">健康寿命を伸ばすためには？</a></li>
				<li><a href="/caregaku/137?fr=CnRight">年をとったら医療費は年間どのくらいかかるの？</a></li>
				<li><a href="/caregaku/136?fr=CnRight">レクリエーションは介護において重要</a></li>
				<li><a href="/caregaku/135?fr=CnRight">フードサービスってなに？高齢社会におけるメリットは？</a></li>
			</ol>
			<p style="text-align: right; padding: 5px 5px 0 0;">
				<a href="/caregaku/?fr=CnRight">もっと見る</a>
			</p>
		</section>
		<section style="text-align: center; margin: 10px 0;"></section>
		<div style="padding: 8px 0 0 0; text-align: center;">
			<div class="c_bannar_area">
				<p>
					<a href="/mailmagazine/form?fr=carenews"> <?= $this->Html->image('/bnr_mm_n.gif', [
        "alt" => "/mailmagazine/form?fr=carenews",
        'url' => ['']
    ]) ?>
					</a>
				</p>
			</div>
		</div>
		<section class="c_side_keywordsrank">
			<h1>人気アクセスランキング</h1>
			<ol id="black" class="ranking">
				<li class="odd"><a href="/carenews/86352"> <span
						class="sub_ranking_icon sub_ranking_icon_1"> 1 </span> <!--<img alt="" src="/img/sys/carenews_image/74/06/cae27f784754a049d36361d3c04fd79b_s.png" />-->
						<dl>
							<dt>介護保険の不正請求で居宅介護支援事業所の指定取り消し 岡山県</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86350"> <span
						class="sub_ranking_icon sub_ranking_icon_1"> 2 </span>
						<dl>
							<dt>障がい者の人の就労継続支援事業所を支援する「カフェ」が登場 足立区</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86353"> <span
						class="sub_ranking_icon sub_ranking_icon_1"> 3 </span>
						<dl>
							<dt>認知症ケアパスできました 門真市</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86358"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 4 </span>
						<dl>
							<dt>78歳の現役女性介護士を起用 「介護職員初任者研修」を開講</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86351"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 5 </span>
						<dl>
							<dt>音楽健康福祉士養成研修・介護レクリエーションセミナー開催</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86359"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 6 </span>
						<dl>
							<dt>「ケアマネマイスター広島」の認定者を決定 広島県</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86355"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 7 </span>
						<dl>
							<dt>過去最大規模「高齢者食・介護食の専門展示会」を開催</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86345"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 8 </span>
						<dl>
							<dt>岡山県「介護記録怠り830万円不正受給」介護保険事業者の指定取消し</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86356"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 9 </span>
						<dl>
							<dt>「認知症を理解するセミナー」開催 九州</dt>
						</dl>
				</a></li>
				<li class="odd"><a href="/carenews/86150"> <span
						class="sub_ranking_icon sub_ranking_icon_2"> 10 </span>
						<dl>
							<dt>夫婦で虐待 居宅介護支援事業所「オネスト」を処分 神戸市</dt>
						</dl>
				</a></li>
			</ol>
		</section>
		<section class="c_side_keywordsrank">
			<h1>過去ニュース</h1>
			<ol class="c_list_article">
				<li><a href="/news/C8/">厚労省・介護保険</a></li>
				<li><a href="/news/C10/">事故・違反</a></li>
				<li><a href="/news/C7/">ニュース解説</a></li>
				<li><a href="/news/C3/">政府・行政の動き</a></li>
				<li><a href="/news/C5/">研修会・講演会</a></li>
				<li><a href="/news/C4/">業界情報</a></li>
				<li><a href="/news/C6/">ちょっと休憩</a></li>
			</ol>
		</section>
		<div class="mt10 center">
			<p style="text-align: center;">== PR ==</p>
		</div>
		<div style="margin-top: 20px; text-align: center;"></div>
	</div>
	<!-- /div#sidebar -->
</div>
<!-- /contents -->
<!-- ============================== /contents Area ============================== -->

<?= $this->element('footer'); ?>
