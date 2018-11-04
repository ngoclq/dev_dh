<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="vi">
<head>
    <meta name="viewport" content="width=device-width">

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
    '/asset/font/fonts/roboto.css',
    '/asset/theme_blog/css/bootstrap.min.css',
    '/asset/font/css/font-awesome.css',
    '/asset/theme_blog/css/animate.css',
    '/asset/theme_blog/css/nivo-slider.css',
    '/asset/theme_blog/css/slick.css',
    '/asset/theme_blog/zoom/cloudzoom.css',
    '/asset/theme_blog/fancybox/jquery.fancybox.css',
    '/asset/theme_blog/fancybox/helpers/jquery.fancybox-thumbs.css',
    '/asset/theme_blog/css/reset.css',
    '/asset/theme_blog/css/style.css',
    ]) ?>
    <?= $this->fetch('css') ?>

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
<?= $this->element('blog_header'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<?= $this->element('blog_footer'); ?>


<?= $this->Html->script([
    '/asset/theme_blog/js/jquery-2.2.1.min.js',
    '/asset/theme_blog/js/bootstrap.min.js',
    '/asset/theme_blog/js/wow.js',
    '/asset/theme_blog/js/jquery.nivo.slider.pack.js',
    '/asset/theme_blog/js/slick.min.js',
    '/asset/theme_blog/js/jquery-smoothscroll.min.js',
    '/asset/theme_blog/zoom/cloudzoom.js',
    '/asset/theme_blog/fancybox/jquery.fancybox.pack.js',
    '/asset/theme_blog/fancybox/helpers/jquery.fancybox-thumbs.js',
    '/asset/theme_blog/js/script.js',
    '/js/common.js'
]
) ?>
</body>
</html>
