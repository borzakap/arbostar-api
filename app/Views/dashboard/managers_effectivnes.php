<?= $this->extend('layout') ?>
<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-1"></i><?= lang('Cards.Titles.ContragentsEffectivnes') ?></h5>
    </div>
    <div class="card-body">
        <?= form_open(route_to('stages_effectivenes'), ['method' => 'get']) ?>
        <?= view('App\Views\dashboard\_dates_contragent_filter') ?>
        <?= form_close() ?>    
    </div>    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Tables.Th.Indicator') ?></th>
                        <?php foreach($periods as $period) : ?>
                        <th><?= $period->format('m.Y') ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Tables.Th.Indicator') ?></th>
                        <?php foreach($periods as $period) : ?>
                        <th><?= $period->format('m.Y') ?></th>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach ($stages as $stage_id => $name) : ?>
                    <tr>
                        <td><?= lang($name) ?></d>
                        <?php foreach ($periods as $period) : ?>
                            <?php $deals[$period->format('m-Y')] = null ?>
                            <?php foreach($items as $item) : ?>
                            <?php if($item->month == $period->format('m-Y') && $item->stage_id == $stage_id){ 
                                $deals[$period->format('m-Y')] = $item->deals;
                            }?>
                            <?php endforeach; ?>
                        <td><?= $deals[$period->format('m-Y')] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
