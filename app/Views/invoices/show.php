<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Invoices</title>
        <link href="/assets/css/invoices.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <div id="left-col">
                    <div id="left-col-cont">
                        <h2>Summary</h2>
                        <div class="item">
                            <div class="meta-col">
                                <h3><?= lang('Invoice.User.FullName') ?></h3>
                                <p class="price"><?= $item->full_name ?></p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="meta-col">
                                <h3><?= lang('Invoice.Payment.Sum') ?></h3>
                                <p class="price"><?= $item->summ ?> <?= $item->iso ?></p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="meta-col">
                                <h3><?= lang('Invoice.Payment.Period') ?></h3>
                                <p class="price"><?= $item->period ?></p>
                            </div>
                        </div>			
                    </div>
                </div>
                <div id="right-col">
                    <div id="common"></div>
                    <?= form_open(route_to('invoices_pay'), ['id' => 'payment_form'], [
                        'sum' => $item->summ, 
                        'invice_number' => $item->invice_number,
                        'invice_desctiption' => '',
                    ]) ?>
                        <div id="invoice-form"></div>
                    <?= form_submit('pay', lang('Invoice.Forms.Buttons.Pay'), ['class' => 'btn']) ?>
                    <?= form_close() ?>    
                </div>
            </div>
        </div>
        <h1 id="dailyui"><img class="logo" src="https://arbostar.com/storage/app/uploads/public/615/d5d/d15/615d5dd1571e8492947260.svg" alt="ArboStar" style="opacity: 1;"></h1>
    </body>
    <script>
        var gateway = '<?= route_to('invoices_form') ?>';
    </script>
    <script src="/assets/js/invoices.min.js"></script>
</html>