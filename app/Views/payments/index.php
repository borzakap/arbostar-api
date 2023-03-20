<?= $this->extend('layout') ?>

<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-1"></i><?= lang('Users.Cards.Titles.Campaigns') ?></h5>
        <a class="btn btn-primary" href="<?= route_to('payments_insert')?>"><?= lang('Forms.Buttons.New') ?></a>
    </div>
    <div class="card-body">
        <?= form_open(route_to('payments_list'), ['method' => 'get']) ?>
        <?= view('App\Views\payments\_filter') ?>
        <?= form_close() ?>    
    </div>    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Tables.Th.PaymentDate') ?></th>
                        <th><?= lang('Tables.Th.ContragentName') ?></th>
                        <th><?= lang('Tables.Th.PaymentCurrency') ?></th>
                        <th><?= lang('Tables.Th.PaymentUsd') ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.PaymentDate') ?></th>
                        <th><?= lang('Tables.Th.ContragentName') ?></th>
                        <th><?= lang('Tables.Th.PaymentCurrency') ?></th>
                        <th><?= lang('Tables.Th.PaymentUsd') ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->payment_at->toDateString() ?></td>
                            <td><?= $item->contragent_name ?></td>
                            <td><?= $item->summ ?> (<?= $item->currency_iso ?>)</td>
                            <td><?= $item->converted_to_usd ?> (USD)</td>
                            <td><?= $item->update_link ?></td>
                            <td><?= $item->delete_link ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links() ?>
        </div>
    </div>
</div>
<!-- Content Row -->

<?= $this->endSection() ?>