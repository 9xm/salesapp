<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Cutomer Site <?=  ' (' . $company->name . ')'; ?></h4>
        </div>
        <div class="modal-body">
            <!--p><?= lang('enter_info'); ?></p-->

            <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open('customers/add_customer_site/' . $company->id, $attrib); ?>
            <div class="form-group">
                <label for="customer_site">Customer Site</label>
                <?= form_input('customer_site', '', 'class="form-control" id="customer_site" required="required"'); ?>
            </div>
            <div class="form-group">
            <?= form_submit('add_customer_site', 'Add Customer Site', 'class="btn btn-primary"'); ?>
            </div>
            <?= form_close(); ?>

        <hr/>
        <h4 class="modal-title" id="myModalLabel">Import Cutomer Site <?=  ' (' . $company->name . ')'; ?></h4>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'enctype'=> 'multipart/form-data'];
        echo admin_form_open('customers/customer_site_import_csv', $attrib); ?>
            <div class="form-group">
                <input type="hidden" name="customer_id" value="<?=$company->id ?>" />
                <label for="customer_site">Customer Site</label>
                <input id="csv_file" type="file" data-browse-label="<?= lang('browse'); ?>" name="csv_file" data-bv-notempty="true" data-show-upload="false"
                       data-show-preview="false" class="form-control file">
            </div>
            <div class="form-group">
            <?php echo form_submit('customer_site_import', 'Customer Site CSV Import', 'class="btn btn-primary"'); ?>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<?= $modal_js ?>

