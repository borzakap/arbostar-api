<?= $this->extend('layout') ?>

<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Console.Cards.Titles.TwilioApiInsert') ?></h5>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?= form_open('billings/create') ?>
        <?= view('App\Views\billings\_form') ?>
        <?= form_submit('create', lang('Forms.Buttons.Submit'), ['class' => 'btn btn-primary mt-3']) ?>
        <?= form_close() ?>    
    </div>
</div>
<!-- Content Row -->
<?= $this->endSection() ?>
