<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="/assets/css/main.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <?= $this->renderSection('pagecss') ?>
    </head>
    <body class="sb-nav-fixed">
        <?= view('App\Views\_topnav') ?>
        <div id="layoutSidenav">
            <?= view('App\Views\_sidenav') ?>
            <div id="layoutSidenav_content">
                <main>
                    <?= view('App\Views\_messages') ?>
                    <?= $this->renderSection('main') ?>
                </main>
                <?= view('App\Views\_footer') ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/assets/js/main.min.js"></script>
        <?= $this->renderSection('pagescript') ?>
    </body>
</html>
