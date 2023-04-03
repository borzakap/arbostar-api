<div class="row">
    <div class="col-md-6 mt-3">
        <?= form_label(lang('Forms.Labels.ContragentName'), 'contragent_id', ['class' => 'form-label']) ?>
        <?= form_dropdown('contragent_id', $contragents, $item->contragent_id ?? null, ['class' => 'form-select', 'id' => 'contragent_id']) ?>
    </div>
    <div class="col-md-6 mt-3">
        <?= form_label(lang('Forms.Labels.CurrencyName'), 'currency_id', ['class' => 'form-label']) ?>
        <?= form_dropdown('currency_id', $currencites, $item->currency_id ?? null, ['class' => 'form-select', 'id' => 'currency_id']) ?>
    </div>
    <div class="col-md-6 mt-3">
        <?= form_label(lang('Forms.Labels.Summ'), 'summ', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'summ', 'class' => 'form-control', 'id' => 'summ', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'value' => old('summ') ?? $item->summ ?? '']) ?>
    </div>
    <div class="col-md-6 mt-3">
        <?= form_label(lang('Forms.Labels.PaymentAt'), 'payment_at', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'payment_at', 'class' => 'form-control', 'id' => 'payment_at', 'type' => 'date', 'value' => old('payment_at') ?? (isset($item->payment_at) ? $item->payment_at->toDateString() : null) ?? '']) ?>
    </div>
</div>