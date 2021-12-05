<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Customer Site</h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open('customers/edit_customer_site/' . $customer_site->id, $attrib); ?>
        <div class="modal-body">
            <!--p><?= lang('enter_info'); ?></p-->

            <div class="form-group">
            <label for="customer_site">Customer Site</label>
                <?= form_input('customer_site', $customer_site->customer_site, 'class="form-control" id="customer_site" required="required"'); ?>
            </div>
            <?php /*<div class="form-group">
                <?= lang('line2', 'line2'); ?>
                <?= form_input('line2', $address->line2, 'class="form-control" id="line2"'); ?>
            </div>
            <div class="form-group">
                <?= lang('city', 'city'); ?>
                <?= form_input('city', $address->city, 'class="form-control" id="city" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('postal_code', 'postal_code'); ?>
                <?= form_input('postal_code', $address->postal_code, 'class="form-control" id="postal_code"'); ?>
            </div>
            <div class="form-group">
                <?= lang('state', 'state'); ?>
                <?= form_input('state', $address->state, 'class="form-control" id="state" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('country', 'country'); ?>
                <?= form_input('country', $address->country, 'class="form-control" id="country" required="required"'); ?>
            </div>

            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', $address->phone, 'class="form-control" id="phone"'); ?>
            </div> */ ?>

        </div>
        <div class="modal-footer">
            <?= form_submit('edit_customer_site', 'Edit customer site', 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $modal_js ?>

