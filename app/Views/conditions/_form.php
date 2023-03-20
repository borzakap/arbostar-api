<div class="row">
    <div class="col-md-4">
        <?= form_label(lang('Forms.Labels.ConditionName'), 'field_name', ['class' => 'form-label']) ?>
        <?= form_dropdown('field_name', $fields, 0, ['class' => 'form-select', 'id' => 'field_name']) ?>
    </div>
    <div class="col-md-4">
        <?= form_label(lang('Forms.Labels.ConditionValue'), 'field_value', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'field_value', 'class' => 'form-control', 'id' => 'field_value', 'value' => '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_submit('create', lang('Forms.Buttons.Submit'), ['class' => 'btn btn-primary mt-3']) ?>
    </div>
</div>