<?= $this->extend('layout') ?>

<?= $this->section('main') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Views.Titles.DealNum', ['num' => $item->id]) ?></h5>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <div class="row">
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Refferal') ?></strong></span> : <span><?= $item->referral ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Source') ?></strong></span> : <span><?= $item->utm_source ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Medium') ?></strong></span> : <span><?= $item->utm_medium ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Campaign') ?></strong></span> : <span><?= $item->utm_campaign ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Content') ?></strong></span> : <span><?= $item->utm_content ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Term') ?></strong></span> : <span><?= $item->utm_term ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.Status') ?></strong></span> : <span><?= $item->status ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.AddedAt') ?></strong></span> : <span><?= $item->added_at->toDateString() ?></span>
            </div>
            <div class="col-4">
                <span><strong><?= lang('Tables.Th.StageChangeTime') ?></strong></span> : <span><?= $item->stage_change_time->toDateString() ?></span>
            </div>
        </div>
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Views.Titles.DealsStages') ?></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Tables.Th.StageId') ?></th>
                        <th><?= lang('Tables.Th.OrderNr') ?></th>
                        <th><?= lang('Tables.Th.StageName') ?></th>
                        <th><?= lang('Tables.Th.CnageTime') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.StageId') ?></th>
                        <th><?= lang('Tables.Th.OrderNr') ?></th>
                        <th><?= lang('Tables.Th.StageName') ?></th>
                        <th><?= lang('Tables.Th.CnageTime') ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($item->stages as $stage) : ?>
                        <tr>
                            <td><?= $stage->stage_id ?></td>
                            <td><?= $stage->order_nr ?></td>
                            <td><?= $stage->name ?></td>
                            <td><?= $item->stage_change_time->toDateString() ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>