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
                        <th><?= lang('Tables.Th.Id') ?></th>
                        <th><?= lang('Tables.Th.AddedAt') ?></th>
                        <th><?= lang('Tables.Th.Refferal') ?></th>
                        <th><?= lang('Tables.Th.Source') ?></th>
                        <th><?= lang('Tables.Th.Medium') ?></th>
                        <th><?= lang('Tables.Th.Campaign') ?></th>
                        <th><?= lang('Tables.Th.Content') ?></th>
                        <th><?= lang('Tables.Th.Term') ?></th>
                        <th><?= lang('Tables.Th.Contragent') ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.Id') ?></th>
                        <th><?= lang('Tables.Th.AddedAt') ?></th>
                        <th><?= lang('Tables.Th.Refferal') ?></th>
                        <th><?= lang('Tables.Th.Source') ?></th>
                        <th><?= lang('Tables.Th.Medium') ?></th>
                        <th><?= lang('Tables.Th.Campaign') ?></th>
                        <th><?= lang('Tables.Th.Content') ?></th>
                        <th><?= lang('Tables.Th.Term') ?></th>
                        <th><?= lang('Tables.Th.Contragent') ?></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->added_at->toDateString() ?></td>
                            <td><?= $item->referral ?></td>
                            <td><?= $item->utm_source ?></td>
                            <td><?= $item->utm_medium ?></td>
                            <td><?= $item->utm_campaign ?></td>
                            <td><?= $item->utm_content ?></td>
                            <td><?= $item->utm_term ?></td>
                            <td><?= $item->contragent ?></td>
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