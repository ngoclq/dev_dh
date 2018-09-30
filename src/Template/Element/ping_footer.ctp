
<div class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-secondary">DHH&nbsp;VIETNAM</h2>
                <p class="text-white"><?= __('COMPANY_DESCRIPTION_SUB') ?></p>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-secondary"><?= __('ABOUT')?></h2>
                <ul class="list-unstyled">
                    <li><?= $this->Html->link(__('ABOUT'), [ 'controller' => 'Infos', 'action' => 'about', '_method' => 'GET'], ['class' => 'text-white']) ?></li>
                    <li><?= $this->Html->link(__('VISION'), [ 'controller' => 'Infos', 'action' => 'vision', '_method' => 'GET'], ['class' => 'text-white']) ?></li>
                    <li><?= $this->Html->link(__('PRIVACY'), [ 'controller' => 'Infos', 'action' => 'privacy', '_method' => 'GET'], ['class' => 'text-white']) ?></li>
                    <li><?= $this->Html->link(__('GROUP'), [ 'controller' => 'Infos', 'action' => 'groups', '_method' => 'GET'], ['class' => 'text-white']) ?></li>
                </ul>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4"><?= __('LABEL_CONTACTS') ?></h2>
                <p>
                    <a href="tel:<?= __('COMPANY_MOBILE')?>" class="text-white">
                        <i class="fa d-inline mr-3 text-secondary fa-phone"></i><?= __('COMPANY_MOBILE')?><br></a>
                </p>
                <p>
                    <a href="mailto:<?= __('COMPANY_EMAIL')?>" class="text-white">
                        <i class="fa d-inline mr-3 text-secondary fa-envelope-o"></i><?= __('COMPANY_EMAIL')?><br></a>
                </p>
                <p>
                    <a href="#" class="text-white" target="_blank">
                        <i class="fa d-inline mr-3 fa-map-marker text-secondary"></i><?= __('COMPANY_ADDRESS')?><br></a>
                </p>
            </div>
            <div class="p-4 col-md-3">
                <h2 class="mb-4 text-light">Subscribe</h2>
                <form>
                    <fieldset class="form-group text-white">
                        <label for="exampleInputEmail1">Get our newsletter</label>
                        <input type="email" class="form-control" placeholder="Enter email"> </fieldset>
                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <p class="text-center text-white">© <?php echo date('Y');?>&nbsp;<?= __('COMPANY_NAME')?></p>
            </div>
        </div>
    </div>
</div>
