<!DOCTYPE html>
<html lang="id">
<head>
    <?= $this->include('layouts/partials/head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?= $this->include('layouts/partials/navbar') ?>

    <?= $this->include('layouts/partials/sidebar') ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <?= $this->renderSection('header') ?>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <?= $this->include('layouts/partials/footer') ?>

</div>

<?= $this->include('layouts/partials/script') ?>

<?= $this->renderSection('js') ?>
</body>
</html>
