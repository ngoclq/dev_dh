
<link rel='stylesheet'
	href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<?php $this->assign('css', $this->Html->css(['/asset/my_template/css/normalize2.css', '/asset/my_template/css/style2.css'])); ?>
<?php $this->assign('script', $this->Html->script(['/asset/my_template/js/login2.js'])); ?>
        <div class="logmod <?= $class_name ?>">
            <div class="logmod__wrapper">
                <span class="logmod__close">Close</span>
                <div class="logmod__container">
                    <ul class="logmod__tabs">
                        <li <?php if(!$form_register) {?> class="current" <?php } ?> data-tabtar="lgm-2"><a href="#"><?= __('LABEL_LOGIN') ?></a></li>
                        <li <?php if($form_register) {?> class="current" <?php } ?>data-tabtar="lgm-1"><a href="#"><?= __('LABEL_REGISTER') ?></a></li>
                    </ul>
                    <div class="logmod__tab-wrapper">
                        <div class="logmod__tab lgm-1 <?php if($form_register) {?> show <?php } ?>">
                            <div class="logmod__heading">
                                <span class="logmod__heading-subtitle"><?= __('ANNOTATIONS_REGISTER')?></span>
                            </div>
                            <div class="logmod__form">
                                <?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'register']]) ?>
                                    <div class="sminputs">
                                        <div class="input string optional">
                                            <label class="string optional" for="user-first-name"><?= __('FIRST_NAME')?>*</label>
                                            <input name="first_name" class="string optional" maxlength="255" id="user-pw" placeholder="<?= __('FIRST_NAME')?>" type="text" size="50" />
                                        </div>
                                        <div class="input string optional">
                                            <label class="string optional" for="user-last-name"><?= __('LAST_NAME')?>*</label>
                                            <input name="last_name" class="string optional" maxlength="255" id="user-pw-repeat" placeholder="<?= __('LAST_NAME')?>" type="text" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full">
                                            <label class="string optional" for="user-name"><?= __('EMAIL')?>*</label>
                                            <input name="username" class="string optional" maxlength="255" id="user-email" placeholder="Email" type="email" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input string optional">
                                            <label class="string optional" for="user-pw"><?= __('PASSWORD')?>*</label>
                                            <input name="password" class="string optional" maxlength="255" id="user-pw" placeholder="<?= __('PASSWORD')?>" type="password" size="50" />
                                        </div>
                                        <div class="input string optional">
                                            <label class="string optional" for="user-pw-repeat"><?= __('PASSWORD_RAW')?>*</label>
                                            <input name="password_raw" class="string optional" maxlength="255" id="user-pw-repeat" placeholder="<?= __('PASSWORD_RAW')?>" type="password" size="50" />
                                        </div>
                                    </div>
                                    <div class="simform__actions">
                                        <?= $this->Form->button(__('BTN_REGISTER'), [ 'class' => 'sumbit']); ?>
                                        <span class="simform__actions-sidetext">By creating an account you agree to our <a class="special" href="#" target="_blank" role="link">Terms & Privacy</a></span>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                            <div class="logmod__alter">
                                <div class="logmod__alter-container">
                                    <a href="#" class="connect facebook">
                                        <div class="connect__icon">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="connect__context">
                                            <span><?= __('LABEL_REGISTER_OTHER')?><strong>Facebook</strong></span>
                                        </div>
                                    </a>
                                    <a href="#" class="connect googleplus">
                                        <div class="connect__icon">
                                            <i class="fa fa-google-plus"></i>
                                        </div>
                                        <div class="connect__context">
                                            <span><?= __('LABEL_REGISTER_OTHER')?><strong>Google+</strong></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="logmod__tab lgm-2 <?php if(!$form_register) {?> show <?php } ?>">
                            <div class="logmod__heading">
                                <span class="logmod__heading-subtitle"><?= __('ANNOTATIONS_LOGIN')?></span>
                            </div>
                            <div class="logmod__form">
                                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
                                    <div class="sminputs">
                                        <div class="input full">
                                            <label class="string optional" for="user-name"><?= __('EMAIL')?>*</label>
                                            <input name="username" class="string optional" maxlength="255" id="user-email" placeholder="<?= __('EMAIL')?>" type="email" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full">
                                            <label class="string optional" for="user-pw"><?= __('PASSWORD')?>*</label>
                                            <input name="password" class="string optional" maxlength="255" id="user-pw" placeholder="<?= __('PASSWORD')?>" type="password" size="50" />
                                            <span class="hide-password" _text_show="<?= __('LABEL_SHOW')?>" _text_hide="<?= __('LABEL_HIDE')?>"><?= __('LABEL_SHOW')?></span>
                                        </div>
                                    </div>
                                    <div class="simform__actions">
                                        <?= $this->Form->button(__('BTN_LOGIN'), [ 'class' => 'sumbit']); ?>
                                        <span class="simform__actions-sidetext"><a class="special" role="link" href="#"><?= __('REMINDER')?><br><?= __('CLICK_HERE')?></a></span>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                            <div class="logmod__alter">
                                <div class="logmod__alter-container">
                                    <a href="#" class="connect facebook">
                                        <div class="connect__icon">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="connect__context">
                                            <span><?= __('LABEL_LOGIN_OTHER')?><strong>Facebook</strong></span>
                                        </div>
                                    </a>
                                    <a href="#" class="connect googleplus">
                                        <div class="connect__icon">
                                            <i class="fa fa-google-plus"></i>
                                        </div>
                                        <div class="connect__context">
                                            <span><?= __('LABEL_LOGIN_OTHER')?><strong>Google+</strong></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

