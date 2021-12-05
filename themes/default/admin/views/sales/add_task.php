<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script>
jQuery(document).ready( function($){

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude=position.coords.latitude;
            var longitude=position.coords.longitude;

            $("#latitude").val(position.coords.latitude);
            $("#longitude").val(position.coords.longitude);

            var html='<a href="https://www.google.com/maps/search/?api=1&query='+latitude+','+longitude+'" target="_blank">Open Map</a><br/><img src="https://maps.googleapis.com/maps/api/staticmap?center='+latitude+','+longitude+'&zoom=12&size=600x400&maptype=roadmap&markers=color:green|label:Sigtel|'+latitude+','+longitude+'&key=AIzaSyCCFYvBWkrZ6yayE16UNXUFWzV8rGU3nWo" />';
            //markers=color:blue%7Clabel:S%7C40.702147,-74.015794
            //AIzaSyDDHabhDRIKLLmlbTB2caS3SRlticw3WIc

            $(".mapImage").html(html);
            // Success goes here
        }.bind(this),
        function(error) {
            alert("Please turn on location for this feature")
            setTimeout(function() {
                window.location.href = window.location;
            }, 5000)
        },
        );
    } else { 
        alert("Geolocation is not supported by this browser.");
    }

});
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-heart"></i>Add Task
        </h2>

        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Please fill in the information below.</p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('sales/add_task', $attrib);
                if ($id) {
                    echo form_hidden('sale_id', $id);
                }
                ?>
                <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <?= lang('Latitude'); ?>
                                    <?php echo form_input('latitude', ($_POST['latitude'] ?? ''), 'class="form-control input-tip" id="latitude" readonly'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('Longitude'); ?>
                                    <?php echo form_input('longitude', ($_POST['longitude'] ?? ''), 'class="form-control input-tip" id="longitude" readonly'); ?>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-12">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?= lang('Images'); ?>
                                    <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="attachments[]" multiple data-show-upload="false" data-show-preview="false" accept="image/*" class="form-control file">
                                </div>
                            </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div
                                class="fprom-group"><?php echo form_submit('add_sale', lang('submit'), 'id="add_sale" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
                                <button type="button" class="btn btn-danger" id="reset"><?= lang('reset') ?></div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 mapImage">
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
