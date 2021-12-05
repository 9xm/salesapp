<?php
if ($attachments || (isset($inv) && $inv->attachment)) {
    ?>
    <ul class="list-group no-print">
        <?php
    if (isset($inv) && $inv->attachment && strlen($inv->attachment) > 1) {
        ?>
        <li class="list-group-item">
            <a href="<?= admin_url('welcome/download/' . $inv->attachment) ?>" class="tip" title="<?= lang('download') ?>">
                <i class="fa fa-chain"></i>
                <span class="hidden-sm hidden-xs"><?= lang('attachment') ?></span>
            </a>
        </li>
        <?php
    }
    foreach ($attachments as $key => $attachment) {
        ?>
        <li class="list-group-item">
            <a href="<?= admin_url('welcome/download/' . $attachment->file_name) ?>" class="tip" title="<?= lang('download') ?>">
                <i class="fa fa-chain"></i>
                <span class="hidden-sm hidden-xs"><?= $attachment->orig_name ?: lang('attachment') . ' ' . ($key + 1) ?></span>
            </a>
            <?php
            if ($Owner || $Admin) {
                ?>
            <a id="delete-attachment" class="badge btn btn-danger tip" style="background-color:#d9534f;" href="<?= admin_url('welcome/delete/' . $attachment->id . '/' . $attachment->file_name) ?>" title="<?= lang('delete') ?>">
                <i class="fa fa-times"></i>
            </a>
            <?php
            } ?>
        </li>
        <?php
    } ?>
    </ul>
    <?php
} ?>
<?php
if ($taskattachments || (isset($inv) && $inv->taskattachment)) {
    ?>
    <div class="row">
        <div class="col-md-6">
    <h2>Task List</h2>
    <ul class="list-group no-print">
        <?php
    foreach ($taskattachments as $key => $attachment) {
        ?>
        <li class="list-group-item">
            <a href="<?= admin_url('welcome/download/' . $attachment->file_name) ?>" class="tip" title="<?= lang('download') ?>">
                <img src="<?= admin_url('welcome/download/' . $attachment->file_name) ?>" class="float-left" width="100px"/>
                <i class="fa fa-chain"></i>
                <span class="hidden-sm hidden-xs"><?= $attachment->orig_name ?: lang('attachment') . ' ' . ($key + 1) ?></span>
            </a>
        </li>
        <?php
    } ?>
    </ul>
    </div>
    <div class="col-md-6">
        <a href="https://www.google.com/maps/search/?api=1&query=<?=$inv->latitude ?>,<?=$inv->longitude ?>" target="_blank">Open Map</a>
        <br/>
        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$inv->latitude ?>,<?=$inv->longitude ?>&zoom=12&size=400x400&maptype=roadmap&markers=color:green|label:Sigtel|<?=$inv->latitude ?>,<?=$inv->longitude ?>&key=AIzaSyCCFYvBWkrZ6yayE16UNXUFWzV8rGU3nWo" />
    </div>
    </div>
    <?php
} ?>
