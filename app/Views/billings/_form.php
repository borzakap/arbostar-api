<div class="row">
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.Summ'), 'summ', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'summ', 'class' => 'form-control', 'id' => 'summ', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'value' => old('summ') ?? $item->summ ?? '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.CurrencyName'), 'currency_id', ['class' => 'form-label']) ?>
        <?= form_dropdown('currency_id', $currencies, $item->currency_id ?? null, ['class' => 'form-select', 'id' => 'currency_id']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.Period'), 'period', ['class' => 'form-label']) ?>
        <?= form_dropdown('period', $pariods, $item->period ?? null, ['class' => 'form-select', 'id' => 'period']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.ClientName'), 'full_name', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'full_name', 'class' => 'form-control', 'id' => 'full_name', 'value' => old('full_name') ?? $item->full_name ?? '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.ClientEmail'), 'email', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => old('email') ?? $item->email ?? '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.ClientPhone'), 'phone', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'phone', 'class' => 'form-control', 'id' => 'phone', 'value' => old('phone') ?? $item->phone ?? '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.DateStart'), 'date_start', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'date_start', 'class' => 'form-control', 'id' => 'date_start', 'type' => 'date', 'value' => old('date_start') ?? (isset($item->date_start) ? $item->date_start->toDateString() : null) ?? '']) ?>
    </div>
    <div class="col-md-4 mt-3">
        <?= form_label(lang('Forms.Labels.DateEnd'), 'date_end', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'date_end', 'class' => 'form-control', 'id' => 'date_end', 'type' => 'date', 'value' => old('date_end') ?? (isset($item->date_end) ? $item->date_end->toDateString() : null) ?? '']) ?>
    </div>
</div>