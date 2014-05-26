<?php

use \Glial\Html\Form;

echo '<form method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">';
?>
<input type="hidden" name="MAX_FILE_SIZE" value="16000" />


<div class="form-group">
    <label for="ged_information-title" class="col-sm-2 control-label"><?= __('Title') ?></label>
    <div class="col-sm-10">
        <?php echo Form::input("ged_information", "title", array("class" => "form-control", "type" => "text", "placeholder" => __("Title"))); ?> 
    </div>
</div>

<div class="form-group">
    <label for="ged_information-date_event" class="col-sm-2 control-label"><?= __('Date') ?></label>
    <div class="col-sm-10">
        <div class="input-group date">
            <?php echo Form::input("ged_information", "date_event", array("class" => "form-control datepicker", "type" => "text", "placeholder" => __("Date"))); ?> 
        </div>

    </div>
</div>

<div class="form-group">
    <label for="ged_information-amount" class="col-sm-2 control-label"><?= __('Amount') ?></label>
    <div class="col-sm-10">
        <?php echo Form::input("ged_information", "amount", array("class" => "form-control", "type" => "text", "placeholder" => __("Amount"))); ?> 
    </div>
</div>


<div class="form-group">
    <label for="ged_information-amount" class="col-sm-2 control-label"><?= __('Tag') ?></label>
    <div class="col-sm-10">
        <?php echo Form::select("ged_information", "tag", $data['tag'], 3, array("class" => "form-control","multiple" => "multiple", "size"=>"10") ); ?> 
    </div>
</div>



<div class="form-group">
    <label for="ged_information-amount" class="col-sm-2 control-label"><?= __('File') ?></label>
    <div class="col-sm-10">
        <?php echo Form::input("ged_information", "file", array("type" => "file", "placeholder" => __("file"))); ?> 
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <textarea name="ged_information[description]" class="form-control" placeholder="<?= __('Description') ?>"></textarea>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> <?= __("Add") ?></button>
    </div>
</div>



<?php
echo '</form>';
?>


