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
<body id="app" class="ng-scope body-special" data-custom-background data-off-canvas-nav>
<div data-ng-controller="AppCtrl">

    <div class="view-container">
        <section id="content" class="animate-fade-up ng-scope">

            <div class="page-signin">

                <div class="signin-header">
                    <div class="container text-center">
                        <section class="logo">
                            <a href="#/">Login</a>
                        </section>
                    </div>
                </div>

                <div class="main-body">
                    <div class="container">
                        <div class="form-container">
                            <?= $this->Form->create($user, ['url' => ['plugin' => 'AdminManager', 'controller' => 'Home', 'action' => 'login'], "class" => "form-horizontal"]) ?>
                                <fieldset>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>

                                            <?= $this->Form->control('username', ["class" => "form-control", "placeholder" => __('EMAIL'),
                                            "type" => "email", "aria-invalid" => "false", "aria-required" => "true", 'error' => false,
                                            'id' => 'user-email', 'maxlength' => '255', 'size' => '50', 'label' => false,"autocomplete" => "on",
                                            'templates' => [
                                                'inputContainer' => '{{content}}'
                                            ]
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                            <?= $this->Form->control('password', ["class" => "form-control", "placeholder" => __('PASSWORD'),
                                            "type" => "password", "aria-invalid" => "false", "aria-required" => "true", 'error' => false,
                                            'id' => 'user-pw', 'maxlength' => '50', 'size' => '50', 'label' => false,"autocomplete" => "on",
                                            'templates' => [
                                                'inputContainer' => '{{content}}'
                                            ]
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                                                data-ng-disabled="!canSubmit()">Log in</button>
                                    </div>
                                </fieldset>
                            <?=  $this->Form->end() ?>

                            <section>
                                <p class="text-center"><a href="#/pages/forgot">Forgot your password?</a></p>
                                <p class="text-center text-muted text-small">Don't have an account yet? <a href="#/pages/signup">Sign up</a></p>
                            </section>

                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>
</div>

<?= $this->Html->script('AdminManager.vendor.js') ?>
<?= $this->Html->script('AdminManager.ui.js') ?>
<?= $this->Html->script('AdminManager.app.js') ?>
</body>
</html>
