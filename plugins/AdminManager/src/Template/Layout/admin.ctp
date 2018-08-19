<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?= $this->Html->charset() ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $this->fetch('title') ?></title>
<meta name="description" content="">
<meta name="viewport"
	content="width=device-width,initial-scale=1,maximum-scale=1">
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link
	href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic"
	rel="stylesheet" type="text/css">
<!-- needs images, font... therefore can not be part of ui.css -->
<?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
<!-- end needs images -->

<?= $this->Html->css('common.css') ?>
<?= $this->Html->css('AdminManager.main.css') ?>
<?= $this->fetch('css') ?>
<?= $this->Html->script('jquery.min.js', ['inline' => 'false']) ?>
<?= $this->Html->script('ckeditor5/ckeditor.js') ?>
<?= $this->fetch('script') ?>

</head>
<body data-ng-app="app" id="app" data-custom-background
	data-off-canvas-nav>
	<div data-ng-controller="AppCtrl">
		<div data-ng-hide="isSpecificPage()" data-ng-cloak class="no-print">
			<section id="header" class="top-header">
				<?= $this->element('AdminManager.header'); ?>
			</section>

			<aside id="nav-container">
				<?= $this->element('AdminManager.nav'); ?>
			</aside>
		</div>

		<div class="view-container">
			<section id="content" class="animate-fade-up">
				<?= $this->fetch('content') ?>
			</section>

		</div>
	</div>

    <?= $this->Html->script('AdminManager.vendor.js') ?>
    <?= $this->Html->script('AdminManager.ui.js') ?>
    <?= $this->Html->script('AdminManager.app.js') ?>
</body>
</html>
