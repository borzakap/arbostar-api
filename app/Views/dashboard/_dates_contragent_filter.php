<div class="row">
    <div class="col-md-3">
        <?= form_label(lang('Forms.Labels.DateStart'), 'date_start', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'date_start', 'class' => 'form-control', 'id' => 'date_start', 'type' => 'date', 'value' => old('date_start') ?? $date_start->toDateString() ?? '']) ?>
    </div>
    <div class="col-md-3">
        <?= form_label(lang('Forms.Labels.DateEnd'), 'date_end', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'date_end', 'class' => 'form-control', 'id' => 'date_end', 'type' => 'date', 'value' => old('date_start') ?? $date_end->toDateString() ?? '']) ?>
    </div>
    <div class="col-md-3">
        <?= form_label(lang('Forms.Labels.ContragentName'), 'contragent_id', ['class' => 'form-label']) ?>
        <?= form_dropdown('contragent_id', $contragents, $filter['contragent_id'] ?? 0, ['class' => 'form-select', 'id' => 'contragent_id']) ?>
    </div>
    <div class="col-md-3 mt-3">
        <?= form_submit('search', lang('Forms.Buttons.Submit'), ['class' => 'btn btn-primary mt-3']) ?>
        <a class="btn btn-primary mt-3" href="<?= route_to('stages_effectivenes')?>"><?= lang('Forms.Buttons.Clear') ?></a>
    </div>
</div>