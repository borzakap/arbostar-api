<div class="collapse show card-body" id="collapseText">
    <?= form_open('conditions/insert',[],['contragent_id' => $item->id]) ?>
    <?= view('App\Views\conditions\_form') ?>
    <?= form_close() ?>    
</div>
