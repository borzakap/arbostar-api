
<!-- DataTales Example -->
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th><?= lang('Tables.Th.InvoiceSum') ?></th>
                <th><?= lang('Tables.Th.PaymentAt') ?></th>
                <th><?= lang('Tables.Th.InvoiceStatus') ?></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><?= lang('Tables.Th.InvoiceSum') ?></th>
                <th><?= lang('Tables.Th.PaymentAt') ?></th>
                <th><?= lang('Tables.Th.InvoiceStatus') ?></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($item->invoices as $item) : ?>
                <tr>
                    <td><?= $item->summ ?></td>
                    <td><?= $item->payment_at ?></td>
                    <td><?= $item->status ?></td>
                    <td><?= $item->view_link ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>