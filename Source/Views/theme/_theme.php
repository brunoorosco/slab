<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?= $title; ?></title>
    <base href='<?= SITE['root'] . ("/Source/assests/") ?>'>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../Views/theme/style.css"/>
</head>

<body>
    <nav class="main_nav">
        <?php if ($v->section("sidebar")) :
            echo $v->section("sidebar");
        else :
            ?>
            <!-- <a title="" href="<?= url(); ?>">Home</a>
            <a title="" href="<?= url("contato"); ?>">Contato</a>
            <a title="" href="<?= url("teste"); ?>">Teste</a> -->
        <?php
        endif; ?>

    </nav>
    <main class="main_content">
        <?= $v->section("content"); ?>
    </main>
    <footer class="main_footer">
        <?= SITE['name'] ?> - Todos os Direitos Reservados

    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <?= $v->section("scripts"); ?>
</body>

</html>