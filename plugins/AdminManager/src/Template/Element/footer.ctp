<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?= $this->Html->charset() ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $this->fetch('title') ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet" type="text/css">
<!-- needs images, font... therefore can not be part of ui.css -->
<?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
<!-- end needs images -->

<?= $this->Html->css('AdminManager.main.css') ?>

</head>
<body data-ng-app="app" id="app" data-custom-background data-off-canvas-nav>
	<!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<div data-ng-controller="AppCtrl">
		<div data-ng-hide="isSpecificPage()" data-ng-cloak class="no-print">
			<section data-ng-include=" 'views/header.html' " id="header"
				class="top-header"></section>

			<aside data-ng-include=" 'views/nav.html' " id="nav-container"></aside>
		</div>

		<div class="view-container">
			<section data-ng-view id="content" class="animate-fade-up"></section>
		</div>
	</div>


	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <?= $this->Html->css('AdminManager.vendor.js') ?>
    <?= $this->Html->css('AdminManager.ui.js') ?>
    <?= $this->Html->css('AdminManager.app.js') ?>
</body>
</html>