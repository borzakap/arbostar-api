<?= $this->extend('layout') ?>

<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Users.Cards.Titles.TwilioApiUpdate') ?></h5>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?= form_open('', ['csrf_id' => 'csrf-id']) ?>
        <?= view('App\Views\contragents\_form') ?>
        <?= form_submit('update', lang('Forms.Buttons.Submit'), ['class' => 'btn btn-primary mt-3']) ?>
        <?= form_close() ?>    
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Users.Cards.Titles.TwilioApiUpdate') ?></h5>
    </div>
    <?= view('App\Views\conditions\insert') ?>
    <?= view('App\Views\conditions\index') ?>
</div>
<!-- Content Row -->
<?= $this->endSection() ?>