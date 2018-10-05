<!DOCTYPE html>
<html lang="<?= __('LANGUAGE') ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?>｜<?= __('WEBSITE_TITLE') ?></title>
    <?= $this->Html->meta('author', __('WEBSITE_AUTHOR') ); ?>
    <?= $this->Html->meta('viewport', 'width=device-width,initial-scale=1'); ?>
    <?= $this->Html->meta('description', __('WEBSITE_DESCRIPTION') . ',' . $this->fetch('description')); ?>

    <?= $this->Html->meta('og:locale', __('LOCALE')); ?>
    <?= $this->Html->meta('og:site_name', __('WEBSITE_TITLE')); ?>
    <?= $this->Html->meta('og:url', BASE_URL); ?>
    <?= $this->Html->meta('og:type', 'article'); ?>
    <?= $this->Html->meta('og:title',  $this->fetch('title') . '｜' . __('WEBSITE_TITLE')); ?>
    <?= $this->Html->meta('og:image', 'article'); ?>
    <?= $this->Html->meta('og:description', $this->fetch('description') . ',' . __('WEBSITE_DESCRIPTION')); ?>

    <?= $this->Html->css([
        '/asset/font/css/font-awesome.css',
        '/asset/font/fonts/roboto.css',
        '/asset/theme_ping/theme.css',
    ]) ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script(['/asset/default_template/js/jquery.min.js','/js/common.js']) ?>
    <?= $this->Html->script('ckeditor/ckeditor.js') ?>
    <?= $this->fetch('script') ?>

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
</head>
<body>
<?= $this->element('ping_header'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('ping_footer'); ?>
</body>
</html>
