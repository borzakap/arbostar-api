<?= $this->extend('layout') ?>
<?= $this->section('main') ?>

<!-- DataTales Example -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-1"></i><?= lang('Users.Cards.Titles.Campaigns') ?></h5>
        <a class="btn btn-primary" href="<?= route_to('contragents_insert')?>"><?= lang('Forms.Buttons.New') ?></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Tables.Th.ContragentName') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.ContragentName') ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->summ ?></td>
                            <td><?= $item->currency ?></td>
                            <td><?= $item->username ?></td>
                            <td><?= $item->update_link ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= $pager->links() ?>
    </div>
</div>
<!-- Content Row -->

<?= $this->endSection() ?>