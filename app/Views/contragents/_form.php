<div class="row">
    <div class="col-md-12 mt-3">
        <?= form_label(lang('Forms.Labels.ContragentName'), 'name', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => old('name') ?? $item->name ?? '']) ?>
    </div>
</div>