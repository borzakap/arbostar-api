<?php $segments = current_url(true)->getSegments() ?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link<?= count(array_intersect($segments, ['contragents-effectivenes'])) >= 1 ? ' active' : ''?>" href="<?= route_to('contragents_effectivenes') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    <?= lang('Sidenav.Reports') ?>
                </a>
                <a class="nav-link<?= count(array_intersect($segments, ['payments'])) >= 1 ? ' active' : ''?>" href="<?= route_to('payments_list') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    <?= lang('Sidenav.Payments') ?>
                </a>
                <a class="nav-link<?= count(array_intersect($segments, ['contragents'])) >= 1 ? ' active' : ''?>" href="<?= route_to('contragents_list') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    <?= lang('Sidenav.Contragents') ?>
                </a>
                <a class="nav-link<?= count(array_intersect($segments, ['currencies'])) >= 1 ? ' active' : ''?>" href="<?= route_to('currentcies_list') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    <?= lang('Sidenav.Currencies') ?>
                </a>
            </div>
        </div>
    </nav>
</div>
