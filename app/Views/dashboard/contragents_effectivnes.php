<?= $this->extend('layout') ?>
<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-1"></i><?= lang('Cards.Titles.ContragentsEffectivnes') ?></h5>
    </div>
    <div class="card-body">
        <?= form_open(route_to('contragents_effectivenes'), ['method' => 'get']) ?>
        <?= view('App\Views\dashboard\_dates_filter') ?>
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
                <?php foreach ($contragents as $contragent) : ?>
                <?php $contragent->withDealsMonthly($date_start->toDateTimeString(), $date_end->toDateTimeString()) ?>
                <?php $contragent->withPaymentsMonthly($date_start->toDateTimeString(), $date_end->toDateTimeString()) ?>
                    <tr>
                        <td colspan="<?= iterator_count($periods) + 1 ?>"><strong><?= $contragent->name?></strong></td>
                    </tr>
                    <tr>
                        <td><?= lang('Tables.Th.DealsCount') ?></d>
                        <?php foreach ($periods as $period) : ?>
                            <?php $deals[$period->format('m-Y')] = null ?>
                            <?php foreach($contragent->deals_monthly as $deal_monthly) : ?>
                            <?php if($deal_monthly->added_month == $period->format('m-Y')){ 
                                $deals[$period->format('m-Y')] = $deal_monthly->all_count;
                            }?>
                            <?php endforeach; ?>
                        <td><?= $deals[$period->format('m-Y')] ?></td>
                        
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><?= lang('Tables.Th.PaymentsSum') ?></d>
                        <?php foreach ($periods as $period) : ?>
                            <?php $payments[$period->format('m-Y')] = null ?>
                            <?php foreach($contragent->payments_monthly as $payment_monthly) : ?>
                            <?php if($payment_monthly->added_month == $period->format('m-Y')){ 
                                $payments[$period->format('m-Y')] = $payment_monthly->all_sum;
                            }?>
                            <?php endforeach; ?>
                        <td><?= $payments[$period->format('m-Y')] ?></td>
                        
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><?= lang('Tables.Th.DealsCost') ?></d>
                        <?php foreach ($periods as $period) : ?>
                        <td><?= round(($payments[$period->format('m-Y')] ?? 0) / ($deals[$period->format('m-Y')] ?? 1), 2) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
