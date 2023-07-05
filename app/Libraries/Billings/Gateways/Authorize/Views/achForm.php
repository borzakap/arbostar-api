<?= form_input(['name' => 'method', 'id' => 'method', 'type' => 'hidden', 'value' => 'ach']) ?>
<?= form_input(['name' => 'gateway', 'id' => 'gateway', 'type' => 'hidden', 'value' => 'authorize']) ?>
<div class="row">
    <div>
        <?= form_label(lang('Invoice.Forms.Labels.RootingNumber'), 'routing_number', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'routing_number', 'class' => 'input-full', 'id' => 'routing_number', 'type' => 'number', 'step' => '1', 'min' => 0, 'value' => old('routing_number') ?? $item->routing_number ?? '']) ?>
    </div>
    <div>
        <?= form_label(lang('Invoice.Forms.Labels.AccountNumber'), 'account_number', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'account_number', 'class' => 'input-full', 'id' => 'account_number', 'type' => 'number', 'step' => '1', 'min' => 0, 'value' => old('routing_number') ?? $item->routing_number ?? '']) ?>
    </div>
    <div>
        <?= form_label(lang('Invoice.Forms.Labels.NameOnAccount'), 'name_on_account', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'name_on_account', 'class' => 'input-full', 'id' => 'name_on_account', 'type' => 'text', 'value' => old('name_on_account') ?? (isset($item->name_on_account) ? $item->name_on_account : null) ?? '']) ?>
    </div>
    <div>
        <?= form_label(lang('Invoice.Forms.Labels.BankName'), 'bank_name', ['class' => 'form-label']) ?>
        <?= form_input(['name' => 'bank_name', 'class' => 'input-full', 'id' => 'bank_name', 'type' => 'text', 'value' => old('bank_name') ?? (isset($item->bank_name) ? $item->bank_name : null) ?? '']) ?>
    </div>
</div>