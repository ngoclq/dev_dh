<!DOCTYPE html>
<html lang="<?= __('LANGUAGE') ?>">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?= $this->fetch('title') ?>｜<?= __('WEBSITE_TITLE') ?></title>
<?= $this->Html->meta('author', __('WEBSITE_AUTHOR') ); ?>
<?= $this->Html->meta('viewport', 'width=device-width,initial-scale=1'); ?>
<?= $this->Html->meta('format-detection', 'telephone=no'); ?>
<?= $this->Html->meta('description', __('WEBSITE_DESCRIPTION') . ',' . $this->fetch('description')); ?>

<?= $this->Html->meta('og:locale', __('LOCALE')); ?>
<?= $this->Html->meta('og:site_name', __('WEBSITE_TITLE')); ?>
<?= $this->Html->meta('og:url', BASE_URL); ?>
<?= $this->Html->meta('og:type', 'article'); ?>
<?= $this->Html->meta('og:title',  $this->fetch('title') . '｜' . __('WEBSITE_TITLE')); ?>
<?= $this->Html->meta('og:image', 'article'); ?>
<?= $this->Html->meta('og:description', $this->fetch('description') . ',' . __('WEBSITE_DESCRIPTION')); ?>

<?= $this->Html->css(['common.css','/asset/my_template/css/common.css', '/asset/my_template/css/layout.css']) ?>
<?= $this->fetch('css') ?>
<?= $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'shortcut icon']); ?>
<?= $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']); ?>

<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('/asset/my_template/js/bbs.js') ?>
<?= $this->Html->script('/asset/my_template/js/rollover.js') ?>
<!--[if lt IE 9]><?= $this->Html->script('/asset/my_template/js/html5shiv.js') ?><![endif]-->
<!--[if lt IE 9]><?= $this->Html->script('/asset/my_template/js/css3-mediaqueries.js') ?><![endif]-->
<!--[if lte IE 8]><?= $this->Html->script('/asset/my_template/js/ie8_css.js') ?><![endif]-->
<script type="text/javascript" language="javascript">
/* <![CDATA[ */
	var lang = "<?= $language ?>";
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host;
	if ("<?= $language ?>" == getUrl.pathname.split('/')[1]) {
		baseUrl +=  "/<?= $language ?>";
	}
/* ]]> */
</script>
<?= $this->Html->script('ckeditor/ckeditor.js') ?>
<?= $this->fetch('script') ?>
</head>
<body>
	<?= $this->element('header'); ?>
	<?= $this->Flash->render() ?>
	<?= $this->fetch('content') ?>
	<?= $this->element('footer'); ?>
</body>
</html>