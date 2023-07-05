<?= $this->extend('layout') ?>

<?= $this->section('main') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Users.Cards.Titles.TwilioApiUpdate') ?></h5>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?php d($item) ?>
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold"><?= lang('Users.Cards.Titles.TwilioApiUpdate') ?></h5>
    </div>
    <?= view('App\Views\invoices\index') ?>
</div>
<!-- Content Row -->
<?= $this->endSection() ?>