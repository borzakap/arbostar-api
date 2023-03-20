<?= $this->extend('layout') ?>

<?= $this->section('main') ?>

<!-- DataTales Example -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-1"></i><?= lang('Users.Cards.Titles.Campaigns') ?></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Tables.Th.Iso') ?></th>
                        <th><?= lang('Tables.Th.Name') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.Iso') ?></th>
                        <th><?= lang('Tables.Th.Name') ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->iso ?></td>
                            <td><?= $item->name?></td>
                            <td><?= $item->switch_link ?></td>
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